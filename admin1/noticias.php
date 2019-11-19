<?php
require "includes/authentication.inc";
require_once "includes/db.inc";
require_once('./vendor/autoload.php');
session_start();
sessionAuthenticate("login.html");

$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) die ("Failed to connect to MySQL: ");
mysqli_select_db($connection, $databasename);

$template = new HTML_Template_ITX("./templates");
$template->loadTemplatefile("noticias.tpl", true, true);

$action = mysqlclean($_GET, "action", 10, $connection);
$id = mysqlclean($_GET, "id", 10, $connection);
$titulo = mysqlclean($_POST, "titulo", 10, $connection);
$subtitulo = mysqlclean($_POST, "subtitulo", 10, $connection);
$fecha = mysqlclean($_POST, "fecha", 10, $connection);
$texto = mysqlclean($_POST, "texto", 10, $connection);
$tema = mysqlclean($_POST, "tema", 10, $connection);
$escritor = mysqlclean($_POST, "escritor", 10, $connection);
$post_action = mysqlclean($_POST, "action", 10, $connection);
$post_id = mysqlclean($_POST, "id", 10, $connection);

if(!empty($post_action)){$action = $post_action; $id= $post_id;}

$template->setVariable("BUTTON_VALUE", "AGREGAR");
$template->setVariable("BUTTON_ACTION", "document.form1.action.value='add';document.form1.submit();");

//$template->setVariable("SCRIPT", "noticias.php");
$template->setVariable("SCRIPT", "relogin.php");
$template->setVariable("fecha", date("Y-m-d") );

switch ($action){
	case "del":
		//relogin
		header("Location: relogin.php?action=$action&id=$id");
		//if (!$result = @ $connection->query("DELETE FROM noticias WHERE id=$id;"))   showerror("err: ".$connection->errno);
	break;
	case "sel":
		$resultado = $connection->query("SELECT * FROM noticias where id=$id;");
		foreach ( $resultado as $r)
		$template->setVariable("id", $id);
		$template->setVariable("BUTTON_VALUE", "ENVIAR CAMBIOS");
		$template->setVariable("BUTTON_ACTION", "document.form1.action.value='upd';document.form1.submit();");
		$template->setVariable("titulo", $r["titulo"]);
		$template->setVariable("subtitulo", $r["subtitulo"]);
		$template->setVariable("fecha", $r["fecha"]);
		$template->setVariable("texto", $r["texto"]);
		$template->setVariable("tema", $r["tema"]);
		$template->setVariable("escritor", $r["escritor"]);$escritor = $r["escritor"];
		$template->setVariable("SCRIPT", "relogin.php");
	break;
	case "add":
		$sql = "INSERT INTO noticias(titulo,subtitulo,fecha,texto, tema, escritor) VALUES ('$titulo','$subtitulo','$fecha','$texto','$tema',$escritor);";
		if (!$result = @ $connection->query($sql)) showerror("Add err: ".$connection->errno);
	break;
	case "upd":
		$sql = "UPDATE noticias set titulo='$titulo', subtitulo='$subtitulo', fecha='$fecha', texto = '$texto', tema = '$tema', escritor=$escritor WHERE id=$id;";
		echo $sql;
		if (!$result = @ $connection->query($sql)) showerror("err: ".$connection->errno);
	break;
}
$sel_escritor = "";



$message = "NOTICIAS";

$template->setVariable("USERNAME", $_SESSION["loginUsername"]);
$template->setVariable("MESSAGE", $message);

$resultado = $connection->query("SELECT * FROM escritores;");
foreach ( $resultado as $rowType){
	$template->setCurrentBlock("optionescritor");
	if(strlen($escritor)>0){
		if($escritor==$rowType["id"])
			$template->setVariable("SELECTEDescritor", " selected");
	}
	$template->setVariable("OPTIONVALUEescritor", $rowType["id"]);
	$template->setVariable("OPTIONTEXTescritor", $rowType["nombre"]);
	$template->parseCurrentBlock("optionescritor");
}

$resultado = $connection->query("SELECT * FROM noticias ORDER by escritor;");
$template->setCurrentBlock("NOTICIAS_LIST");
foreach ( $resultado as $rw){
	$template->setCurrentBlock("NOTICIAS_DETALLE");
	$template->setVariable("NOTICIAS_DETALLE_ESCRITOR", $rw["escritor"]);
	$template->setVariable("NOTICIAS_DETALLE_TITULO", $rw["titulo"]);
	$template->setVariable("NOTICIAS_DETALLE_SUBTITULO", $rw["subtitulo"]);
	#$template->setVariable("ESCRITOR_PUBLICACIONES_ULTIMA", $rw["apellido"]);
	#$template->setVariable("ESCRITOR_PUBLICACIONES_CANTIDAD", $rw["apellido"]);
	
	$template->setVariable("NOTICIAS_DETALLE_LINK", "(<a href=\"noticias.php?action=sel&id=".$rw["id"]."\">Editar</a>)"."(<a href=\"noticias.php?action=del&id=".$rw["id"]."\">Borrar</a>)");
	$template->parseCurrentBlock("NOTICIAS_DETALLE");
}
$template->parseCurrentBlock("NOTICIAS_LIST");

$template->parseCurrentBlock();

$template->show();


?>
