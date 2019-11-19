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
var docRef = firestore.doc("preguntas/item");
const colRef = firestore.collection("preguntas");
const outputHeader = document.querySelector("#outputHeader");

const inputques_ref = document.querySelector("#ques_ref");
const inputques_act = document.querySelector("#ques_act");
const inputques_pf =  document.querySelector("#ques_pf");
const inputques_q =   document.querySelector("#ques_q");
const inputques_a =   document.querySelector("#ques_a");
const inputDocId =    document.querySelector("#docid");

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
  outputHeader.innerHTML = 'Guardando pregunta...';
  console.log('Guardando pregunta...');
  docRef = firestore.doc("preguntas/"+inputDocId.value);
  const ques_ref = inputques_ref.value;
  const ques_act = inputques_act.value;
  const ques_pf =  inputques_pf.value;
  const ques_q =   inputques_q.value;
  const ques_a =   inputques_a.value;

  docRef.set({
    ques_ref: ques_ref,
    ques_act: ques_act,
    ques_pf: ques_pf,
    ques_q: ques_q,
    ques_a: ques_a
  }, {merge: true})
  .then(function(messageRef){
  outputHeader.innerHTML = 'Datos actualizados: ';
  console.log('datos actualizados en base de datos'+inputDocId.value);
  });
});

addButtonX.addEventListener("click",async function(){//AGREGA ARTICULO CON FOTO
  outputHeader.innerHTML = 'Agregando pregunta...';
  console.log('Agregando pregunta...');
  
  const ques_ref = inputques_ref.value;
  const ques_act = inputques_act.value;
  const ques_pf =  inputques_pf.value;
  const ques_q =   inputques_q.value;
  const ques_a =   inputques_a.value;

  firebase.firestore().collection('preguntas')
  .add({
    name: getUserName(),
    ques_ref: ques_ref,
    ques_act: ques_act,
    ques_pf: ques_pf,
    ques_q: ques_q,
    ques_a: ques_a,
    timestamp: firebase.firestore.FieldValue.serverTimestamp()
  })
  .then(function(messageRef){
      outputHeader.innerHTML = 'cargado en base de datos';
      return console.log('cargado en base de datos');
  })
   .catch(function(error) {
    console.error('There was an error uploading a file to Cloud Storage:', error);
  });
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
  inputques_ref.value = res[0];
  $('#divques_ref')[0].MaterialTextfield.checkDirty();
  inputques_act.value = res[1];
  $('#divques_act')[0].MaterialTextfield.checkDirty();
  inputques_pf.value = res[2];
  $('#divques_pf')[0].MaterialTextfield.checkDirty();
  inputques_q.value = res[3];
  $('#divques_q')[0].MaterialTextfield.checkDirty();
  inputques_a.value = res[4];
  $('#divques_a')[0].MaterialTextfield.checkDirty();
  inputDocId.value = docid;
}

function clickBorrar(docid,img) {
  console.log(docid);
  //delete document:
  firestore.collection("preguntas").doc(docid).delete().then( function() {
      console.log("Document successfully deleted!"+docid);
  }).catch(function(error) {
      console.error("Error removing document: "+docid+ ' '+ error);
  });
}

loadallButton.addEventListener("click",function(){
  //const colRef = firestore.collection("preguntas");
  $("#tablecool tr").remove();

  //  colRef.where('clasif', '==', inputClasif.value).get().then((querySnapshot) => {
  colRef.orderBy('timestamp','desc').get().then((querySnapshot) => {
    var table = document.getElementById("tablecool").getElementsByTagName('tbody')[0];
   
    var row, celQ,celA,celPFA,celAcciones;
    var linkimage, valuehf,borrarbutton, hiddenField,selectbutton;

    querySnapshot.forEach((doc) => {
      row = table.insertRow(0);
      celQ = row.insertCell(0);
      celA = row.insertCell(1);
      celPFA = row.insertCell(2);
      celAcciones = row.insertCell(3);
      
      borrarbutton = "<button type=\"button\" onclick=\"confirm(clickBorrar('"+doc.id+"','"+doc.data().filePath+"'),'')\">Borrar</button>";
      selectbutton = "<button type=\"button\" onclick=\"clickSeleccionar('"+doc.id+"')\">Editar</button>";
     
      valuehf = doc.data().ques_ref +"/"+doc.data().ques_act +"/"+doc.data().ques_pf+"/"+doc.data().ques_q+"/"+doc.data().ques_a;
      hiddenField = "<input type=\"hidden\" id=\""+doc.id+"\" value=\""+valuehf+"\">";
      
      celQ.innerHTML = doc.data().ques_q + "<br>"+doc.data().ques_a;
      celQ.style.textAlign = "center";
      celA.innerHTML = "";//doc.data().ques_a;
      celPFA.innerHTML = doc.data().ques_pf + "/" + doc.data().ques_act;
      celAcciones.innerHTML = hiddenField+borrarbutton+selectbutton ;
    });
  })
  .catch(function(error){
    console.log("got an error:",error);
  });
});

signOutButtonElement.addEventListener('click', signOut);
signInButtonElement.addEventListener('click', signIn);
initFirebaseAuth();
