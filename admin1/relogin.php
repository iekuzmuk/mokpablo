<?php
require "includes/authentication.inc";
require_once "includes/db.inc";
require_once('./vendor/autoload.php');
session_start();
sessionAuthenticate("login.html");

$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) die ("Failed to connect to MySQL: ");
mysqli_select_db($connection, $databasename);

  $id = mysqlclean($_GET, "id", 10, $connection);
  $action = mysqlclean($_GET, "action", 10, $connection);

  $post_id = mysqlclean($_POST, "id", 10, $connection);
  $post_action = mysqlclean($_POST, "action", 10, $connection);
  
  if(!empty($post_action)){$action = $post_action; $id= $post_id;}
  

  $titulo = mysqlclean($_POST, "titulo", 10, $connection);
  $subtitulo = mysqlclean($_POST, "subtitulo", 10, $connection);
  $fecha = mysqlclean($_POST, "fecha", 10, $connection);
  $texto = mysqlclean($_POST, "texto", 10, $connection);
  $tema = mysqlclean($_POST, "tema", 10, $connection);
  $escritor = mysqlclean($_POST, "escritor", 10, $connection);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Login</title>
</head>
<!-- window.location = "http://m.domain.com"; -->
<script>
	function myFunction() {

    document.loginform.id.value = <?php if(empty($id))echo 0;else echo $id; ?>;
    document.loginform.action.value = '<?php echo $action; ?>';
    
    document.loginform.titulo.value =     '<?php echo $titulo; ?>';
    document.loginform.subtitulo.value =  '<?php echo $subtitulo; ?>';
    document.loginform.fecha.value =      '<?php echo $fecha; ?>';
    document.loginform.texto.value =      '<?php echo $texto; ?>';
    document.loginform.tema.value =       '<?php echo $tema; ?>';
    document.loginform.escritor.value =   <?php if(empty($escritor))echo 0;else echo $escritor; ?>;

    if (screen.width >= 800) {
			document.myform.loginPassword.focus();
		}
		else{
			document.myform.loginUsername.focus();
		}
	}
</script>


<body OnLoad="myFunction()">
<h1>Application Login Page</h1>
<form name="loginform" method="POST" name="myform" id="myform" action="relogincheck.php">
<table>
  <tr>
    <input type="hidden" name="id">
    <input type="hidden" name="action">
    <input type="hidden" name="titulo">
    <input type="hidden" name="subtitulo">
    <input type="hidden" name="fecha">
    <input type="hidden" name="texto">
    <input type="hidden" name="tema">
    <input type="hidden" name="escritor">

    <td>Usuario:</td>
    <td><input type="text" size="10" name="loginUsername" id="loginUsername"></td>
  </tr>
  <tr>
    <td>Clave:</td>
    <td><input type="password" size="10" name="loginPassword" id="loginPassword"></td>
  </tr>
</table>
<p><input type="submit" value="Log in">
</form>
</body>
</html>
