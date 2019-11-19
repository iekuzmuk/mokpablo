# mokpablo
tp final pablo ifts16 3ro

# La informacion esta guardada en una base de datos de firestore y en una de mysql.
# Cloud Function
- para hacer los thumbnails de los articulos en firestore utiliza una cloud function
una para cuando se crean imagenes (createMessage)
y 
otra cuando se actualizan imagenes (createMessage-update)
tienen distinto trigger
hechas en node8

/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for t`he specific language governing permissions and
 * limitations under the License.
 */
'use strict';

const functions = require('firebase-functions');
const mkdirp = require('mkdirp-promise');
const admin = require('firebase-admin');
admin.initializeApp();
const spawn = require('child-process-promise').spawn;
const path = require('path');
const os = require('os');
const fs = require('fs');

// Max height and width of the thumbnail in pixels.
const THUMB_MAX_HEIGHT = 200;
const THUMB_MAX_WIDTH = 200;
// Thumbnail prefix added to file names.
const THUMB_PREFIX = 'thumb_';


//deploy --only functions

/**
 * When an image is uploaded in the Storage bucket We generate a thumbnail automatically using
 * ImageMagick.
 * After the thumbnail has been generated and uploaded to Cloud Storage,
 * we write the public URL to the Firebase Realtime Database.
 */
//exports.generateThumbnail1 = functions.storage.object().onFinalize(async (object) => {
exports.messageCreate = functions.firestore.document('/articulos/{documentId}')
  .onCreate(async (snap, context) => {
    const filePath = snap.data().filePath;
   // console.log('articulo ', context.params.documentId , image);
  
  // File and directory paths.
  //const filePath = object.name;
  console.log('filePath ('+filePath+')');
  //const contentType = object.contentType; // This is the image MIME type
  const fileDir = path.dirname(filePath);
  const fileName = path.basename(filePath);
  const thumbFilePath = path.normalize(path.join(fileDir, `${THUMB_PREFIX}${fileName}`));

  console.log('thumbFilePath ('+thumbFilePath+')');
  const tempLocalFile = path.join(os.tmpdir(), filePath);
  const tempLocalDir = path.dirname(tempLocalFile);
  const tempLocalThumbFile = path.join(os.tmpdir(), thumbFilePath);

  // Exit if this is triggered on a file that is not an image.
  //if (!contentType.startsWith('image/')) {
    //return console.log('This is not an image.');
  //}

  // Exit if the image is already a thumbnail.
  if (fileName.startsWith(THUMB_PREFIX)) {
    return console.log('Already a Thumbnail.');
  }

  // Cloud Storage files.
  const bucket = admin.storage().bucket();
  const file = bucket.file(filePath);
  const thumbFile = bucket.file(thumbFilePath);
  // Create a reference with an initial file path and name
//var storage = firebase.storage();
//var pathReference = storage.ref('images/stars.jpg');
 // const metadata = {
  //  contentType: contentType,
    // To enable Client-side caching you can set the Cache-Control headers here. Uncomment below.
     //'Cache-Control': 'public,max-age=3600',
  //};
  
  // Create the temp directory where the storage file will be downloaded.
  await mkdirp(tempLocalDir)
  // Download file from bucket.
  await file.download({destination: tempLocalFile});
  console.log('The file has been downloaded to', tempLocalFile);
  // Generate a thumbnail using ImageMagick.
  await spawn('convert', [tempLocalFile, '-thumbnail', `${THUMB_MAX_WIDTH}x${THUMB_MAX_HEIGHT}>`, tempLocalThumbFile], {capture: ['stdout', 'stderr']});
  console.log('Thumbnail created at', tempLocalThumbFile);
  // Uploading the Thumbnail.
  await bucket.upload(tempLocalThumbFile, {destination: thumbFilePath});
  console.log('Thumbnail uploaded to Storage at', thumbFilePath);
  // Once the image has been uploaded delete the local files to free up disk space.
   console.log('BEFORE UNLINK');
  fs.unlinkSync(tempLocalFile);
  fs.unlinkSync(tempLocalThumbFile);
  console.log('Erased temporals files');
  // Get the Signed URLs for the thumbnail and original image.
  const config = {
    action: 'read',
    expires: '03-01-2500',
  };
  console.log('start: signed promise.all');
  const results = await Promise.all([
    thumbFile.getSignedUrl(config),
    file.getSignedUrl(config),
  ]);
  console.log('end: signed promise.all');
  console.log('Got Signed URLs.');
  const thumbResult = results[0];
  const originalResult = results[1];
  const thumbFileUrl = thumbResult[0];
  const fileUrl = originalResult[0];
  // Add the URLs to the Database
  //await admin.database().ref('images').push({path: fileUrl, thumbnail: thumbFileUrl});
  //return 
  await snap.ref.set({thumbnail: thumbFileUrl}, {merge: true});
  //console.log('fileurl: '+ fileUrl);
  //console.log('thumbnail: '+ thumbFileUrl);
  return console.log('Thumbnail URLs saved to database.');
});

**existen distintas reglas de seguridad:
-la informacion solo la puede actualizar en administrador
-los usuarios anonimas pueden dejar mensajes pero no pueden editar o borrar
-la informacion compartida publica es leible por todos
-la privada por los autorizados en las rules de firestore de la base de datos.

**las preguntas, mensajes, y articulos de firestore se acceden por la parte:
malacateok.com/tp/admin

**tiene otra base de datos de mysql
para la informacion de precios con 
malacateok.com/admin
ahi se accede con usuario y clave

# El asistente virtual con AI esta codeado en node y es el repositorio:
https://github.com/iekuzmuk/agent-human-handoff-nodejs

