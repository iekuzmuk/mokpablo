//https://www.youtube.com/watch?v=2Vf1D-rUMwE
const firebaseConfig = {
  apiKey: "AIzaSyBtzvmtYQFiUhTdvTYUOcG5NMkgVGRU0MM",
  authDomain: "ftmw0-f1f0e.firebaseapp.com",
  databaseURL: "https://ftmw0-f1f0e.firebaseio.com",
  projectId: "ftmw0-f1f0e",
  storageBucket: "ftmw0-f1f0e.appspot.com",
  messagingSenderId: "482334690883",
  appId: "1:482334690883:web:883d44489f74f0a6"
};

firebase.initializeApp(firebaseConfig);

var provider = new firebase.auth.GoogleAuthProvider();

var firestore = firebase.firestore();
var docRef = firestore.doc("articulos/item");
const colRef = firestore.collection("articulos");
const outputHeader = document.querySelector("#outputHeader");
const inputClasif = document.querySelector("#clasif");
const inputSubclasif = document.querySelector("#subclasif");
const inputCantidad = document.querySelector("#cantidad");
const inputPrecio = document.querySelector("#precio");
const inputDocId = document.querySelector("#docid");
const inputColor = document.querySelector("#color");
const addButtonX = document.querySelector("#addButtonX");
const guardarCambios = document.querySelector("#guardarCambios");
var userPicElement = document.getElementById('user-pic');
var userNameElement = document.getElementById('user-name');
var signInButtonElement = document.getElementById('sign-in');
var signOutButtonElement = document.getElementById('sign-out');
var data;
const loadallButton = document.querySelector("#loadallButton");
const loadFilteredButton = document.querySelector("#loadFilteredButton");

var LOADING_IMAGE_URL = 'https://www.google.com/images/spin-32.gif?a';

// Returns true if a user is signed-in.
function isUserSignedIn() {

 console.log('is user signed in: ');
 console.log(firebase.auth().currentUser);
 
  // TODO 6: Return true if a user is signed-in.
     console.log(firebase.auth().currentUser);
   return !!firebase.auth().currentUser;
}

function signIn() {
  
  firebase.auth().signInWithPopup(provider);
}

function signOut() {
  firebase.auth().signOut();
}

// Returns the signed-in user's profile Pic URL.
function getProfilePicUrl() {
  // TODO 4: Return the user's profile pic URL.
    return firebase.auth().currentUser.photoURL || '/images/profile_placeholder.png';

}

// Adds a size to Google Profile pics URLs.
function addSizeToGoogleProfilePic(url) {
  if (url.indexOf('googleusercontent.com') !== -1 && url.indexOf('?') === -1) {
    return url + '?sz=150';
  }
  return url;
}

function authStateObserver(user) {
  if (user) { // User is signed in!
    // Get the signed-in user's profile pic and name.
    var profilePicUrl = getProfilePicUrl();
    var userName = getUserName();

    // Set the user's profile pic and name.
    userPicElement.style.backgroundImage = 'url(' + addSizeToGoogleProfilePic(profilePicUrl) + ')';
    userNameElement.textContent = userName;

    // Show user's profile and sign-out button.
    userNameElement.removeAttribute('hidden');
    userPicElement.removeAttribute('hidden');
    signOutButtonElement.removeAttribute('hidden');

    // Hide sign-in button.
    signInButtonElement.setAttribute('hidden', 'true');

    // We save the Firebase Messaging Device token and enable notifications.
   // saveMessagingDeviceToken();
  } else { // User is signed out!
    // Hide user's profile and sign-out button.
    userNameElement.setAttribute('hidden', 'true');
    userPicElement.setAttribute('hidden', 'true');
    signOutButtonElement.setAttribute('hidden', 'true');

    // Show sign-in button.
    signInButtonElement.removeAttribute('hidden');
  }
}

function getUserName() {
  // TODO 5: Return the user's display name.
    return firebase.auth().currentUser.displayName;
}

// Initiate firebase auth.
function initFirebaseAuth() {
  if (isUserSignedIn()) {
    //return true;
    signOutButtonElement.removeAttribute('hidden');
     console.log('if');
  }else{
    // Show sign-in button.
    signInButtonElement.removeAttribute('hidden');
     signOutButtonElement.removeAttribute('hidden');
    //signOutButtonElement.setAttribute('hidden', 'true');
    console.log('else initFirebaseAuth' );
  }
  // TODO 3: Initialize Firebase.
  // Listen to auth state changes.
  firebase.auth().onAuthStateChanged(authStateObserver);
  //ESTA LINEA SOLA ERA
}

guardarCambios.addEventListener("click", async function(){
	var filex = document.getElementById("myFile");
	var file = filex.files[0];
	docRef = firestore.doc("articulos/"+inputDocId.value);
	if (file){
		outputHeader.innerHTML = 'Guardando Cambios'+ file.name ;
		console.log('Guardando Cambios');
		var filePath = firebase.auth().currentUser.uid + '/1/' + file.name;
		var url1 = '';
		//load de image in firebase storage
		await firebase.storage().ref(filePath).put(file)
		.then(function(fileSnapshot){
			return fileSnapshot.ref.getDownloadURL().then((url) => {
				url1 = url;
				console.log('imageUrl: '+ url+' filePath: '+filePath)
			});
		});
		docRef.set({
			clasif: inputClasif.value,
			subclasif: inputSubclasif.value,
			color: inputColor.value,
			cantidad: inputCantidad.value,
			precio: inputPrecio.value,
			filePath: filePath,
			imageUrl: url1
		}, {merge: true})
		.then(function(messageRef){
			outputHeader.innerHTML = 'Datos actualizados: ';
			console.log('datos actualizados en base de datos'+inputDocId.value);
		});
	}
	else{
		docRef.set({
			clasif: inputClasif.value,
			subclasif: inputSubclasif.value,
			color: inputColor.value,
			cantidad: inputCantidad.value,
			precio: inputPrecio.value
		}, {merge: true})
		.then(function(messageRef){
			outputHeader.innerHTML = 'Datos actualizados: ';
			console.log('datos actualizados en base de datos'+inputDocId.value);
			cleanArticlesForm();
		});
	}
});


addButtonX.addEventListener("click",async function(){//AGREGA ARTICULO CON FOTO
  var filex = document.getElementById("myFile");
  var file = filex.files[0];
 // docRef = firestore.doc("articulos/"+inputDocId.value);
  
  outputHeader.innerHTML = 'Agregando articulo';
  console.log('Agregando articulo');
  
  const clasif = inputClasif.value;
  const subclasif = inputSubclasif.value;
  const cantidad = inputCantidad.value;
  const precio = inputPrecio.value;
  const color = inputColor.value;
  
  if (file){
    var filePath = firebase.auth().currentUser.uid + '/1/' + file.name;
    var url1 = '';
    await firebase.storage().ref(filePath).put(file)
    .then(function(fileSnapshot){
        return fileSnapshot.ref.getDownloadURL().then((url) => {
        url1 = url;
        console.log('imageUrl: '+ url+' filePath: '+filePath)
      });
    });
  }
  else {
    outputHeader.innerHTML = 'agregando articulo Sin imagen';
    console.log('agregando articulo Sin imagen');
    filePath = 'images/noimage.jpg'; 
    url1 = 'images/noimage.jpg';
  }
  
  firebase.firestore().collection('articulos')
  .add({
    name: getUserName(),
    filePath: filePath,
    imageUrl: url1,
    color: color,
    clasif: clasif,
    subclasif: subclasif,
    cantidad: cantidad,
    precio: precio,
    timestamp: firebase.firestore.FieldValue.serverTimestamp()
  })
  .then(function(messageRef){
      outputHeader.innerHTML = 'cargado en base de datos';
      return console.log('cargado en base de datos');//'imageUrl: '+ url+' filePath: '+filePath)
      cleanArticlesForm();
  });
  //.catch(function(error) {
  //  console.error('There was an error uploading a file to Cloud Storage:', error);
  //});
});

loadFilteredButton.addEventListener("click",function(){
  $("#tablecool tr").remove(); 
  colRef.where('clasif', '==', inputClasif.value).get().then((querySnapshot) => {
    var table = document.getElementById("tablecool").getElementsByTagName('tbody')[0];
      var row, cell0,cell1,cell2,cell3;
      var linkimage, valuehf,borrarbutton, hiddenField,selectbutton;

      querySnapshot.forEach((doc) => {
          row = table.insertRow(0);
          celImagen = row.insertCell(0);
          celNombre = row.insertCell(1);
          celCantidad = row.insertCell(2);
          celPrecio = row.insertCell(3);
          celAcciones = row.insertCell(4);
          celImagen.classList.add("mdl-data-table__cell--non-numeric");
          celNombre.classList.add("mdl-data-table__cell--non-numeric");
          
          borrarbutton = "<button type=\"button\" onclick=\"clickBorrar('"+doc.id+"','"+doc.data().filePath+"')\">Borrar</button>";
          selectbutton = "<button type=\"button\" onclick=\"clickSeleccionar('"+doc.id+"')\">Editar</button>";
          valuehf = doc.data().clasif +"/"+doc.data().subclasif +"/"+doc.data().color +"/"+doc.data().cantidad+"/"+doc.data().precio;   
          hiddenField = "<input type=\"hidden\" id=\""+doc.id+"\" value=\""+valuehf+"\">";
          linkimage = "<a href='" + doc.data().imageUrl + "' target='_new'><img src='" + doc.data().thumbnail + "'></a>";
          
          celImagen.innerHTML = linkimage;   
          celNombre.innerHTML = doc.data().clasif +"/"+doc.data().subclasif +"/"+doc.data().color+"/"+doc.data().precio;
          celCantidad.innerHTML = doc.data().cantidad;
          celPrecio.innerHTML = doc.data().precio;
          celAcciones.innerHTML = hiddenField+borrarbutton+selectbutton ;
      });
  }).catch(function(error){
    console.log("got an error:",error);
  });
});

$('#tbody').click(function(event){
  //  alert("hola");
  });

function clickSeleccionar(docid) {
  var res = document.getElementById(docid).value.split("/");
  var imgt = res[0]+'/'+res[1]+'/'+'thumb_'+res[2];

  inputClasif.value = res[0];
  $('#divClasif')[0].MaterialTextfield.checkDirty();
  inputSubclasif.value = res[1];
  $('#divSubclasif')[0].MaterialTextfield.checkDirty();
  inputColor.value = res[2];
  $('#divColor')[0].MaterialTextfield.checkDirty();
  inputCantidad.value = res[3];
   $('#divCantidad')[0].MaterialTextfield.checkDirty();

  inputPrecio.value = res[4];
  $('#divPrecio')[0].MaterialTextfield.checkDirty();
  inputDocId.value = docid;
}

function cleanArticlesForm() {
	inputClasif.value = "";
	$('#divClasif')[0].MaterialTextfield.checkDirty();
	inputSubclasif.value = "";
	$('#divSubclasif')[0].MaterialTextfield.checkDirty();
	inputColor.value = "";
	$('#divColor')[0].MaterialTextfield.checkDirty();
	inputCantidad.value = "";
	$('#divCantidad')[0].MaterialTextfield.checkDirty();
	inputPrecio.value = "";
	$('#divPrecio')[0].MaterialTextfield.checkDirty();
	document.getElementById("myFile").value = "";
}

function clickBorrar(docid,img) {
  
  var res = img.split("/");
  var imgt = res[0]+'/'+res[1]+'/'+'thumb_'+res[2];
  console.log(docid+' / '+img +' / '+imgt);
  
  var did = docid;
  //delete document:
  firestore.collection("articulos").doc(docid).delete().then( function() {
      console.log("Document successfully deleted!"+docid);
  }).catch(function(error) {
      console.error("Error removing document: "+docid+ ' '+ error);
  });

  var desertRef = firebase.storage().ref().child(img);
  desertRef.delete().then( function() {
    console.log("deleted: ", img);
  })
  .catch(function(error) {
      console.error("Error deleting: ("+img+ ') '+ error);
  });

  desertRef = firebase.storage().ref().child(imgt);
  desertRef.delete().then( function() {
      console.log("deleted: ", imgt);
  })
  .catch(function(error) {
      console.error("Error deleting: ("+imgt+ ') '+ error);
  });
}

loadallButton.addEventListener("click",function(){

 $("#tablecool tr").remove(); 
   colRef.get().then((querySnapshot) => {
      var table = document.getElementById("tablecool").getElementsByTagName('tbody')[0];
      var row, cell0,cell1,cell2,cell3;
      var linkimage, valuehf,borrarbutton, hiddenField,selectbutton;

      querySnapshot.forEach((doc) => {
          row = table.insertRow(0);
          celImagen = row.insertCell(0);
          celNombre = row.insertCell(1);
          celCantidad = row.insertCell(2);
          celPrecio = row.insertCell(3);
          celAcciones = row.insertCell(4);
          celImagen.classList.add("mdl-data-table__cell--non-numeric");
          celNombre.classList.add("mdl-data-table__cell--non-numeric");
          
          borrarbutton = "<button type=\"button\" onclick=\"confirm(clickBorrar('"+doc.id+"','"+doc.data().filePath+"'),'')\">Borrar</button>";
          selectbutton = "<button type=\"button\" onclick=\"clickSeleccionar('"+doc.id+"')\">Editar</button>";
          valuehf = doc.data().clasif +"/"+doc.data().subclasif +"/"+doc.data().color +"/"+doc.data().cantidad+"/"+doc.data().precio;   
          hiddenField = "<input type=\"hidden\" id=\""+doc.id+"\" value=\""+valuehf+"\">";
          linkimage = "<a href='" + doc.data().imageUrl + "' target='_new'><img src='" + doc.data().thumbnail + "'></a>";
          
          celImagen.innerHTML = linkimage;   
          celNombre.innerHTML = doc.data().clasif +"/"+doc.data().subclasif +"/"+doc.data().color+"/"+doc.data().precio;
          celCantidad.innerHTML = doc.data().cantidad;
          celPrecio.innerHTML = doc.data().precio;
          celAcciones.innerHTML = hiddenField+borrarbutton+selectbutton ;
      });
  }).catch(function(error){
    console.log("got an error:",error);
  });
});

signOutButtonElement.addEventListener('click', signOut);
signInButtonElement.addEventListener('click', signIn);
initFirebaseAuth();
