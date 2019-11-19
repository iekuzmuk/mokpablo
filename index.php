<?php
    require_once "admin/includes/db.inc";
    require_once('admin/vendor/autoload.php');

    $connection = mysqli_connect($hostname, $username, $password, $databasename);
    if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
    if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);

    $template = new HTML_Template_ITX("admin/templates");
    $template->loadTemplatefile("front.tpl", true, true);

    function debug_to_console($data) {
      $output = $data;
      if (is_array($output))
        $output = implode(',', $output);

      echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    //debug_to_console("here");
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-152876953-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-152876953-1');
</script>

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Learn how to use the Firebase platform on the Web">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MALACATEOK.COM</title>

  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">

  <!-- Web Application Manifest -->
  <link rel="manifest" href="manifest.json">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="application-name" content="Friendly Chat">
  <meta name="theme-color" content="#303F9F">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Friendly Chat">
  <meta name="apple-mobile-web-app-status-bar-style" content="#303F9F">

  <!-- Tile icon for Win8 -->
  <meta name="msapplication-TileColor" content="#3372DF">
  <meta name="msapplication-navbutton-color" content="#303F9F">

  <!-- Material Design Lite -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-indigo.min.css" />
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

  <!-- App Styling -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
  <link rel="stylesheet" href="styles/main.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<title>Stock</title>

<script src="https://www.gstatic.com/firebasejs/5.11.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.11.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>

<!-- MALACATEOK -->
  <title>malacateweb.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"> 
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  (function($) {
    
    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 640,
            defaultH: 360
        }, options );
      
        $(settings.classBtn).on('click', function(e) {
          var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;
          

          var dataVideo = {
            'src': $(this).attr('data-bmdSrc'),
            'height': $(this).attr('data-bmdHeight') || settings.defaultH,
            'width': $(this).attr('data-bmdWidth') || settings.defaultW
          };

          if ( allowFullscreen ) dataVideo.allowfullscreen = "";
          
          // we print our data in the iframe
          $(self).find("iframe").attr(dataVideo);
        });
      
        // if we close the modal we reset the data of the iframe to prevent a video from continuing to reproduce even when the modal is closed
        this.on('hidden.bs.modal', function(){
          $(this).find('iframe').html("").attr("src", "");
        });
      
        return this;
    };
  
})(jQuery);




jQuery(document).ready(function(){
  jQuery("#myModal").bmdIframe();
});
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

   // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})

$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});
</script>
<style>
.flash-button{
  background:blue;
  padding:5px 10px;
  color:#fff;
  border:none;
  border-radius:5px;
  
  animation-name: flash;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  //Firefox 1+
  -webkit-animation-name: flash;
  -webkit-animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;

  //Safari 3-4
  -moz-animation-name: flash;
  -moz-animation-duration: 1s;
  -moz-animation-timing-function: linear;
  -moz-animation-iteration-count: infinite;
}

@keyframes flash {  
    0% { opacity: 1.0; }
    50% { opacity: 0.5; }
    100% { opacity: 1.0; }
}

//Firefox 1+
@-webkit-keyframes flash {  
    0% { opacity: 1.0; }
    50% { opacity: 0.5; }
    100% { opacity: 1.0; }
}

//Safari 3-4
@-moz-keyframes flash {  
    0% { opacity: 1.0; }
    50% { opacity: 0.5; }
    100% { opacity: 1.0; }
}
</style>
<style>
.navbar {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
}


.navbar li a, .navbar .navbar-brand {
    color: #fff !important;
}

.navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
}

.navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
}
.jumbotron { 
    background-color: #ffff; /* #f4511e Orange */
    color: black;
}
.bg-grey {
    background-color: #f6f6f6;
}
.logo {
    font-size: 200px;
}

 @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
.logo-small {
    color: #f4511e;
    font-size: 50px;
}

.logo {
    color: blue;//#f4511e;
    font-size: 200px;
}
.thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
}
.carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
}

.carousel-indicators li {
    border-color: #f4511e;
}

.carousel-indicators li.active {
    background-color: #f4511e;
}

.item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
}

.item span {
    font-style: normal;
}
.panel {
    border: 1px solid #f4511e; 
    border-radius:0;
    transition: box-shadow 0.5s;
}

.panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
}

.panel-footer .btn:hover {
    border: 1px solid #f4511e;
    background-color: #fff !important;
    color: #f4511e;
}

.panel-heading {
    color: #fff !important;
    background-color: #f4511e !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
}

.panel-footer {
    background-color: #fff !important;
}

.panel-footer h3 {
    font-size: 32px;
}

.panel-footer h4 {
    color: #aaa;
    font-size: 14px;
}

.panel-footer .btn {
    margin: 15px 0;
    background-color: #f4511e;
    color: #fff;
}
footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
}
body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
}

.jumbotron {
    font-family: Montserrat, sans-serif;
}

.navbar {
    font-family: Montserrat, sans-serif;
}
h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
}

h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
}
.slideanim {visibility:hidden;}
.slide {
    /* The name of the animation */
    animation-name: slide;
    -webkit-animation-name: slide; 
    /* The duration of the animation */
    animation-duration: 1s; 
    -webkit-animation-duration: 1s;
    /* Make the element visible */
    visibility: visible; 
}

/* Go from 0% to 100% opacity (see-through) and specify the percentage from when to slide in the element along the Y-axis */
@keyframes slide {
    0% {
        opacity: 0;
        transform: translateY(70%);
    } 
    100% {
        opacity: 1;
        transform: translateY(0%);
    } 
}
@-webkit-keyframes slide {
    0% {
        opacity: 0;
        -webkit-transform: translateY(70%);
    } 
    100% {
        opacity: 1;
        -webkit-transform: translateY(0%);
    }
}
.pregunta{
  background: #eee;
  padding:20px;
}
.respuesta{
  background: white;
}
</style>
<script>
function openWin() {
  window.open("https://www.malacateok.com/chatrobot.html");
}
</script>
</head>



<body>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="https://malacateok.com">malacateweb.com</a>



      <!--<a class="navbar-brand" href="https://malacateweb.com"><img src="malacateweb.jpg" alt="Logo"></a> --> 
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">INICIO</a></li>
  <li><a href="#services">PRODUCTOS</a></li>
  <!--   <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">PRODUCTOS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#services">INTRODUCCION</a></li>
            <li><a href="#malternativo">MALACATE ALTERNATIVO</a></li> 
            <li><a href="#mreparado">MALACATE REACONDICIONADO</a></li>
          </ul>
        </li> -->
        <!-- 
   <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">VIDEOS<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#video1">Explicacion</a></li> 
            <li><a href="#video2">Instalacion</a></li>
    <li><a href="#portfolio">IMAGENES</a></li>  
          </ul>
        </li> -->
  <li><a href="#buy">COMPRAR</a></li>
  <li><a href="#video1">VIDEOS</a></li>
        <li><a href="#pricing">PRECIOS</a></li>
        <li><a href="#faqs">PREGUNTAS FRECUENTES</a></li>
        <li><a href="#contact">CONTACTO</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">

  <div id="alert alert-warning user-container" class=" mdl-color--light-blue-700">
        <div hidden id="user-pic"></div>
        <div hidden id="user-name"></div>
        <button hidden id="sign-out" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
          Sign-out
        </button>
        <button hidden id="sign-in" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
          <i class="material-icons">account_circle</i>Sign-in with Google
        </button>
      </div>
    
</br>
<div id="imgContainer"></div>
  <h1>Malacates Alternativos</h1> 
<div class="alert alert-warning">
   <!-- <strong>Atencion! ultimos dias</strong> cerrado por vacaciones del: 25/1 al 15/2. -->
    <button type="button" class="flash-button bmd-modalButton" onclick="openWin()" value="Chat con Robot / Operador">Chat con Robot / Operador</button> 
  </div>
 <!-- <img src="https://marcoscordel.com/photo.php?s=meb" />
<button type="button" class="flash-button bmd-modalButton" data-toggle="modal" data-bmdSrc="https://desolate-cove-81396.herokuapp.com/customer" data-bmdWidth=800 data-bmdHeight="800" data-target="#myModal">Chat con Robot / Operador</button> 

 -->
  <img src="chevrolet.png" style="width:6%"/>
  <img src="chrysler.png" style="width:6%"/>
  <img src="fiat.png" style="width:6%"/>
  <img src="ford.png" style="width:6%"/>
  <img src="kia.png" style="width:6%"/>
  <img src="mercedes.png" style="width:6%"/>
  <img src="mitsubishi.png" style="width:6%"/>
  <img src="nissan.png" style="width:6%"/>
  <img src="renault.png" style="width:6%"/>
  <img src="toyota.png" style="width:6%"/>
  <img src="vw.png" style="width:6%"/>
  <p>Reparacion y Venta de equipos Originales y Alternativos</p>
<p>para rueda de auxilio - Instalacion sin cargo - envios a todo el pais</p>
<!--<form class="form-inline">
    <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Email Address" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-danger">Subscribite</button>
      </div> 
    </div>
  </form>-->
</div></div>
<div id="about" class="container-fluid">
 <div class="row">
    <div class="col-sm-8">  
<h2>Quienes somos?</h2>
  <h4>Somos una empresa dedicada a fabricacion y venta de malacates alternativos para vehiculos.</h4>
  <p>Tenemos una amplia variedad de aparatos listos para colocar y en el caso de no estar el suyo en la lista se puede tomar las medidas y confeccionar por el mismo precio. Tambien realizamos reparaciones.</p>
<p>Todo con seguridad antirobo</p>
 <!-- <button class="btn btn-default btn-lg">Ponte en Contacto</button> -->
 </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
<div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo"></span> 
    </div>
    <div class="col-sm-8">
  <h2>Nuestros Valores</h2>
  <h4><strong>MISION:</strong> Llegar a producir una variedad de productos alternativos cada vez mayor para una variedad cada vez mas grande de vehiculos.</h4> 
  <h4><strong>VISION:</strong> A traves de una trayectoria de excelencia llegaremos a  crecer en el mercado.</h4>
</div>
  </div>
</div>
<div id="services" class="container-fluid text-center">
  <h2>PRODUCTOS Y SERVICIOS</h2>
  <h4>Que ofrecemos?</h4>
  <p>Si su vehiculo no esta en la lista, no se preocupe se hacen en el momento tarda 2 / 3 horas mismo precio!</p>
  <p>comunicarse a traves del area de contacto al final de la pagina, cel/wsp o email</p>
  <div id="root"></div>
  <div  id="divClasif" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="clasif">
    <label class="mdl-textfield__label" for="clasif">Marca</label>
  </div>
<input type="hidden" id="docid">
<input type="file" id="myFile"  hidden=true  multiple size="50" >
<button id="guardarCambios" hidden=true class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Guardar Cambios</button>
<button id="addButtonX"  hidden=true  >Agregar</button>
<button id="loadFilteredButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Cargar Filtrados</button>
<button id="loadallButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Cargar Todos</button>
<div class="table-responsive">
<table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp container-fluid" id="tablecool">
  <tbody id="tbody" align="center"></tbody>
</table></div>

  <br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off"></span>
      <h4>Malacates Alternativos</h4>
      <p>Para una lista larga de vehiculos tenemos malacates alternativos listos para instalar o enviar por encomienda a todo el pais </p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart"></span>
      <h4>Reparacion de Malacates</h4>
      <p>En muchos casos es posible reparar el malacate original</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock"></span>
      <h4>Malacates Originales Reacondicionados</h4>
      <p>A veces contamos con malacates originales acondicionados a nuevos listos para entregar</p>
    </div>
    </div>
    <br><br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf"></span>
      <h4>CUIDANDO AL MEDIO AMBIENTE</h4>
      <p></p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate"></span>
      <h4>GARANTIA</h4>
      <p>Trabajo de acuerdo a principios tecnicos y de ingenieria nos permite junto con la compra una garantia escrita de 6 meses</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench"></span>
      <h4>TRABAJO DE CALIDAD</h4>
      <p>Ya sean los aparatos nuevos o reacondicionados, siempre ofrecemos un trabajo que esta por arriba de los requerimientos y con controles de calidad ensayos de esfuerzo mecanico no destructivos.</p>
    </div>
  </div>
</div>
<div id="malternativo" class="container-fluid text-center bg-grey">
  <div class="jumbotron">
    <h1>MALACATE ALTERNATIVO</h1> 
    <p>Se coloca en el mismo lugar del aparato original. Incluye seguridad antirobo.</p> 
    <p>Se encuentra desarrollado y listo para instalar para una lista de vehiculos.</p> 
    <p>Si tu vehiculo no esta en la lista, no te preocupes al comienzo habia un solo auto ahora son mas de 20 y la lista crece cada dia, con cada caso nuevo.</p> 
  </div>
<div class="jumbotron">
    <h1>Como funciona?</h1> 
    <p>Se coloca una parte en el vehiculo, otra parte se coloca en la rueda y  luego levantando la rueda se unen ambas partes. Se gira la rueda hasta que quede firme en su lugar. Finalmente se pone la cadena y el candado. La mejor forma de entender como funciona es verlo! a tal fin hay dos videos en Youtube y se muestran mas abajo en esta pagina tambien. Todos los clientes hasta la fecha estan conformes o sea calificaron de forma positiva,mas de 150 solo en mercadolibre!!</p> 
  </div>
</div>


<div id="buy" class="container-fluid text-center bg-grey">
<div class="jumbotron">
    <h1>Como Comprar?</h1> 
    <p>Se puede pagar en efectivo en el momento. Instalacion sin cargo. O a traves de transferencia bancaria o pago electronico usando mercadolibre.<a href= "https://listado.mercadolibre.com.ar/_CustId_47227486" target="_new" > enlace a pago electronico</a></p> 
<p>Se realizan encomiendas a todo el pais</p>
  </div>
</div>



<div id="video1" class="container text-center bg-grey">
      <h3>Youtube -  Como funciona?</h3>
       <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/QZ2aGn2BHLY"></iframe>
    </div>
</div>
<div id="video2" class="container text-center bg-grey">
<h3>Una instalacion de una 4x4</h3>
<div class="embed-responsive embed-responsive-16by9"> 
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/FDzvO5cOVZI"></iframe>
    </div>
</div>

<div id="mreparado" class="container-fluid text-center bg-grey">
  <div class="jumbotron">
    <h1>MALACATE REACONDICIONADO</h1> 
    <p>Usualmente cortan el cable de acero que sostiene la rueda y la reparacion consiste en poner una pieza de metal que van en la rueda, reparar el cable y/o cambiarlo agregar seguridad antirobo. Y por ultimo hacer pruebas de esfuerzo mecanico para asegurarnos que quedo bien fuerte - todo de acuerdo a lo que corresponde segun la ingenieria mecanica y la tecnica.</p> 
    <p>Vehiculos tipicos de esta reparacion: VW Amarok, Saveiro, Palio</p> 
  </div>
<div class="jumbotron">
    <h1>Como funciona?</h1> 
    <p>La pieza que va en la rueda esta desarrollada para calzar justo en un sistema de seguridad propio que consta de una cadena y un candado. Las trabas de seguridad convencionales las suelen romper. aca no. Proximamente video de muestra!. Abajo dice Ver imagenes estan fotos de un ejemplo una VW Amarok!. Tene en consideracion que todos los clientes hasta la fecha estan conformes califaciones 100% positivas,mas de 150 solo en mercadolibre!!</p> 
<!--<p>Imagenes de reparacion:
<a href="amarok1.html"  target="_new">REPARACIONES</a></p> -->
<!-- imagenes reparacion -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Imagenes de reparacion</a>
        </h4>
      </div>
  <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">Fotos de Ejemplo: VW Amarok - La reparacion se basa en tres pilares basicos: </div>
<p>1) Verificar si el aparato original esta en condiciones de ser reparado. </p>
<p>2) Tomar las medidas para realizar las piezas de forma que calcen perfectamente con las medidas del aparato.</p>
  <p> 3) Control de calidad. Basado en el asesoramiento de ingenieros mecanicos. Se realizan ensayos de esfuerzo mecanico para asegurar que el aparato reparado cumple con las condiciones. O sea esta en optimo estado.</p>
  <p>Haz Click para agrandar la imagen</p>
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="/rep/amarokreacond0.jpg" target="_blank">
          <img src="/rep/amarokreacond0.jpg" alt="Aparato instalado VW AMAROK" style="width:100%">
          <div class="caption">
            <p>Foto de un malacate de Amarok 2016 instalado.</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="/rep/amarokreacond1.jpg" target="_blank">
          <img src="/rep/amarokreacond1.jpg" alt="Rueda Amarok" style="width:100%">
          <div class="caption">
            <p>Foto de la rueda de aleacion de una Amarok</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="/rep/amarokreacond2.jpg" target="_blank">
          <img src="/rep/amarokreacond2.jpg" alt="Amarok 2016" style="width:100%">
          <div class="caption">
            <p>Camioneta Amarok 4x4 con la rueda en su lugar. Solo falta la foto con la proteccion para el candado</p>
          </div>
        </a>
      </div>
    </div>
  </div>
      </div>
    </div>
  </div> 
<!-- imagenes reparacion -->
  </div>
</div>

<div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>CASOS DE EXITO</h2>
  <h4>que hemos tenido</h4>
  <div class="row text-center">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="amarok.jpg" alt="VW">
        <p><strong>Amarok</strong></p>
        <p>Sin duda uno de los vehiculos que mas viene es la VW Aamarok</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="saveiro.jpg" alt="VW">
        <p><strong>Saveiro</strong></p>
        <p>VW Saveiro, de las que tienen la rueda abajo todos los modelos</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="qubo.jpg" alt="Fiat">
        <p><strong>Qubo</strong></p>
        <p>Fiat Qubo, un excelente vehiculo que por lo gral le roban la rueda de auxilio o se rompe</p>
      </div>
    </div>
</div>
<h2>Que dicen nuestros clientes?</h2>
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
    <li data-target="#myCarousel" data-slide-to="5"></li>
    <li data-target="#myCarousel" data-slide-to="6"></li>
    <li data-target="#myCarousel" data-slide-to="7"></li>
    <li data-target="#myCarousel" data-slide-to="8"></li>
    <li data-target="#myCarousel" data-slide-to="9"></li>
    <li data-target="#myCarousel" data-slide-to="10"></li>
  </ol>

<!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      
  <div class="item active">
    <h4>"MUY BUENA ATENCIÓN Y PREDISPOSICION"<br><span>usuario mercadolibre: Norma (NABAIT) - 25/02/19</span></h4>
  </div>

  <div class="item">
    <h4>"EXCELNTE MUY CORDIAL Y TODO TAL CUAL HABLAMOS CONFIABLE 100 X100"<br><span>usuario mercadolibre: Salomon (SHALYK2006) - 11/01/19</span></h4>
  </div>

  <div class="item">
    <h4>"Excelente vendedor producto servicio y persona"<br><span>usuario mercadolibre: Ncy (NCY NEUMATICOS) - 18/10/18</span></h4>
  </div>

  <div class="item">
    <h4>"Excelente atención, totalmente recomendable Compre y el mismo día despacho el producto"<br><span>usuario mercadolibre: Ricardo A. (RICIBACETA) - 08/10/18</span></h4>
  </div>

  <div class="item">
    <h4>"Excelente vendedor. Muy atento. Lo recomiendo"<br><span>usuario mercadolibre: Andrea (BELTRANANDREA31) - 10/07/18</span></h4>
  </div>
  <div class="item">
    <h4>"Impecable , la verdad un placer comprarle ."<br><span>usuario mercadolibre: Facundo (FACUNDOGMEZOMIL) - 26/04/18</span></h4>
  </div>

  <div class="item">
        <h4>"Excelente cumplio en tiempo y forma"<br><span>usuario mercadolibre: Enrique (CHALFOUNENRIQUE) - 19/02/18</span></h4>
      </div>

     <div class="item">
        <h4>"Buen vendedor, lo mando rapidísimo y ya lo tengo instalado en el auto. Recomendable 100%"<br><span>usuario mercadolibre: Mauro (MAUROCABUS) - 14/02/18</span></h4>
      </div>

      <div class="item">
        <h4>"vendedor amable y atento, muy recomendable, el producto 10 puntos"<br><span>usuario mercadolibre: ELBRASILERO - 25/10/2017</span></h4>
      </div>

      <div class="item">
        <h4>"todo muy bien. buena atención y muy amable. cumplió con lo que dijo y es un buen producto. lo recomiendo"<br><span>usuario mercadolibre: FAQ_BOSTERO_2007 - 22/10/2017</span></h4>
      </div>
      <div class="item">
        <h4>"Muy buena atención. Llegó todo como se había acordado. Recomiendo al vendedor."<br><span>usuario mercadolibre: YYAMILM - 31/07/17</span></h4>
      </div>
    </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <?php
    debug_to_console("here ini ");
    $resultado = $connection->query("SELECT * FROM productos where activo=1;");
    $template->setCurrentBlock("PRODUCTOS_LIST");
    foreach ( $resultado as $rw){
      $template->setCurrentBlock("PRODUCTOS_DETALLE");
      $template->setVariable("PRODUCTOS_DETALLE_NOMBRE", $rw["nombre"]);
      $template->setVariable("PRODUCTOS_DETALLE_FOTO",strlen($rw["foto"]<3)?"11dot.gif":$rw["foto"]);
      $template->setVariable("PRODUCTOS_DETALLE_TEXTO", $rw["texto"]);
      //$template->setVariable("PRODUCTOS_DETALLE_CLASIF", $rw["clasif"]);
      $template->setVariable("PRODUCTOS_DETALLE_STOCK", $rw["stock"]);
      $template->setVariable("PRODUCTOS_DETALLE_PRECIO", $rw["precio"]);
      if(strlen($rw["mp"])>3)
      $template->setVariable("PRODUCTOS_DETALLE_MP", "<a mp-mode=\"dftl\" href=\"https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=".$rw["mp"]."\" name=\"MP-payButton\" class='blue-ar-l-rn-none'>Pagar</a>");
      $template->parseCurrentBlock("PRODUCTOS_DETALLE");
    }
    $template->parseCurrentBlock("PRODUCTOS_LIST");

    $template->parseCurrentBlock();
    $template->show();
    debug_to_console("here fin");
?>
</div>
  </div><!-- final php -->

<div id="faqs" class="container-fluid bg-grey jumbotron">
  <h1>Preguntas Frecuentes</h1>
  <button id="loadPFButton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Preguntas Frecuentes</button>
<table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp container-fluid" id="tablecoolPF">
  <tbody id="tbodyPF" align="center"></tbody>
</table>
<!--
  <p class="pregunta">Hay que hacer agujeros en el vehiculo o alguna modificacion para colocarlo?</p>
  <p class="respuesta">No. Se coloca en el mismo lugar del aparato original.
  <p class="pregunta">Es un articulo Nuevo?</p>
  <p class="respuesta">Si</p>
  <p class="pregunta">Tiene Garantia?</p>
  <p class="respuesta">Si</p>
  <p class="pregunta">Es dificil de instalar?</p>
  <p class="respuesta">No, es completamente facil como se puede ver en los videos</p>
  <p class="pregunta">Es seguro?</p>
  <p class="respuesta">Absolutamente, tiene un sistema de proteccion antirobo propio, muchisimo mas seguro que las trabas comerciales.</p>
  <p class="pregunta">Es realmente tan seguro?</p>
  <p class="respuesta">Completamente, tiene la cadena tan escondida que se vuelve muy dificil maniobrar una herramienta para cortarla, en cambio las trabas comerciales se rompen. (ver fotos)</p>
  <p class="pregunta">Hacen envios?</p>
  <p class="respuesta">Si. a todo el territorio Argentino.</p>
  <p class="pregunta">Formas de pago?</p>
  <p class="respuesta">Todas, en efectivo personalmente o a traves de mercadolibre todas las que ofrece mercadolibre</p>
-->
</div>



<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACTO</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Escribinos - respuestas en menos de 24hs</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Miranda 3879 - CAPITAL FEDERAL, AR</p>
      <p><span class="glyphicon glyphicon-phone"></span> +54 11 5589 0644</p>
      <p><span class="glyphicon glyphicon-envelope"></span> info@malacateweb.com</p> 
    </div>
<div class="col-sm-7">
  <div class="row">
     <div  id="divcontact_nombre" class="col-sm-6 form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="contact_nombre">
    <label class="mdl-textfield__label" for="contact_nombre">Nombre</label>
  </div>

   <div  id="divcontact_email" class="col-sm-6 form-group mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="email" id="contact_email">
    <label class="mdl-textfield__label" for="contact_email">Email</label>
  </div></div>
    <div id="divcontact_comment" class="row mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea class="mdl-textfield__input" type="text" rows="3" id="contact_comment"></textarea>
    <label class="mdl-textfield__label" for="contact_comment">Comentario</label>
  </div>
<input type="hidden" id="docid">
 <div class="row"><div class="col-sm-12 form-group">
<button id="addButtonContact" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Enviar</button>
</div></div>
</div></div>
    <div class="alert alert-warning">
    <button type="button" class="flash-button bmd-modalButton" onclick="openWin()" value="Chat con Robot / Operador">Chat con Robot / Operador</button> 
    </div>
  
</div>


<script>
function SendMail(){
alert ("NO SE ENVIO - Funcion deshabilitada!!! - por favor anote la direccion de email divertechnology@gmail.com y envie la informacion a traves de su correo electronico - gracias");
}</script>
<!-- Add Google Maps -m->
<div id="googleMap" style="height:400px;width:100%;"></div>
<script>
function myMap() {
var myCenter = new google.maps.LatLng(-34.6147507,-58.4946916);
var mapProp = {center:myCenter, zoom:12, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({position:myCenter});
marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->
<footer class="container-fluid text-center">
<a href="https://api.whatsapp.com/send?phone=5491155890644" target="_blank" style="position: fixed;top: auto;bottom: 20px;right: 15px;color: white;background-color: #4dc247;box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);border-radius: 50%;padding: 5px;font-size: 18px;z-index: 9999999999;"><svg baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" viewBox="300 -476.1 1792 1792" style="width: 39px; height: 40px; padding: 5px 2px; fill: white; vertical-align: middle; "><path d="M1413 497.9c8.7 0 41.2 14.7 97.5 44s86.2 47 89.5 53c1.3 3.3 2 8.3 2 15 0 22-5.7 47.3-17 76-10.7 26-34.3 47.8-71 65.5s-70.7 26.5-102 26.5c-38 0-101.3-20.7-190-62-65.3-30-122-69.3-170-118s-97.3-110.3-148-185c-48-71.3-71.7-136-71-194v-8c2-60.7 26.7-113.3 74-158 16-14.7 33.3-22 52-22 4 0 10 .5 18 1.5s14.3 1.5 19 1.5c12.7 0 21.5 2.2 26.5 6.5s10.2 13.5 15.5 27.5c5.3 13.3 16.3 42.7 33 88s25 70.3 25 75c0 14-11.5 33.2-34.5 57.5s-34.5 39.8-34.5 46.5c0 4.7 1.7 9.7 5 15 22.7 48.7 56.7 94.3 102 137 37.3 35.3 87.7 69 151 101a44 44 0 0 0 22 7c10 0 28-16.2 54-48.5s43.3-48.5 52-48.5zm-203 530c84.7 0 165.8-16.7 243.5-50s144.5-78 200.5-134 100.7-122.8 134-200.5 50-158.8 50-243.5-16.7-165.8-50-243.5-78-144.5-134-200.5-122.8-100.7-200.5-134-158.8-50-243.5-50-165.8 16.7-243.5 50-144.5 78-200.5 134S665.3 78.7 632 156.4s-50 158.8-50 243.5a611 611 0 0 0 120 368l-79 233 242-77a615 615 0 0 0 345 104zm0-1382c102 0 199.5 20 292.5 60s173.2 93.7 240.5 161 121 147.5 161 240.5 60 190.5 60 292.5-20 199.5-60 292.5-93.7 173.2-161 240.5-147.5 121-240.5 161-190.5 60-292.5 60a742 742 0 0 1-365-94l-417 134 136-405a736 736 0 0 1-108-389c0-102 20-199.5 60-292.5s93.7-173.2 161-240.5 147.5-121 240.5-161 190.5-60 292.5-60z"></path></svg></a>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content bmd-modalContent">

        <div class="modal-body">
          
          <div class="close-button">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="embed-responsive embed-responsive-4by3">
                      <iframe class="embed-responsive-item"  scrolling="yes"></iframe>
          </div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Todos los derechos reservados 2019 </p> 
</footer>
</body>


<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
<script src="./app.js"></script>
<script>
</script>
</body>
</html>