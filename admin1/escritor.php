<?php
require "includes/authentication.inc";
require_once "includes/db.inc";
require_once('./vendor/autoload.php');
session_start();
sessionAuthenticate("login.html");
$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);


$template = new HTML_Template_ITX("./templates");
$template->loadTemplatefile("escritor.tpl", true, true);

$action = mysqlclean($_GET, "action", 10, $connection);
$id = mysqlclean($_GET, "id", 10, $connection);
$escritorApellido = mysqlclean($_POST, "escritorApellido", 10, $connection);
$escritorNombre = mysqlclean($_POST, "escritorNombre", 10, $connection);
$escritorEdad = mysqlclean($_POST, "escritorEdad", 10, $connection);
$post_action = mysqlclean($_POST, "action", 10, $connection);
$post_id = mysqlclean($_POST, "id", 10, $connection);

if(!empty($post_action)){$action = $post_action; $id= $post_id;}

$template->setVariable("BUTTON_VALUE", "AGREGAR");
$template->setVariable("BUTTON_ACTION", "document.form1.action.value='add';document.form1.submit();");

switch ($action){
	case "del":
		if (!$result = @ $connection->query("DELETE FROM escritores WHERE id=$id;"))   showerror("err: ".$connection->errno);
	break;
	case "sel":
		$resultado = $connection->query("SELECT * FROM escritores where id=$id;");
		foreach ( $resultado as $r)
		$template->setVariable("ESCRITORES_DETALLE_ID_VALUE", $id);
		$template->setVariable("BUTTON_VALUE", "ENVIAR CAMBIOS");
		$template->setVariable("BUTTON_ACTION", "document.form1.action.value='upd';document.form1.submit();");
		$template->setVariable("ESCRITORES_DETALLE_NOMBRE_VALUE", $r["nombre"]);
		$template->setVariable("ESCRITORES_DETALLE_APELLIDO_VALUE", $r["apellido"]);
		$template->setVariable("ESCRITORES_DETALLE_EDAD_VALUE", $r["edad"]);
	break;
	case "add":
		if (!$result = @ $connection->query("INSERT INTO escritores(nombre,apellido,edad) VALUES ('$escritorNombre','$escritorApellido',$escritorEdad);")) showerror("err: ".$connection->errno);
	break;
	case "upd":
		if (!$result = @ $connection->query("UPDATE escritores set apellido='$escritorApellido', nombre='$escritorNombre', edad=$escritorEdad WHERE id=$id;")) showerror("err: ".$connection->errno);
	break;
}

$message = "";

$template->setVariable("USERNAME", $_SESSION["loginUsername"]);
$template->setVariable("MESSAGE", $message);

$resultado = $connection->query("SELECT * FROM escritores;");
$template->setCurrentBlock("ESCRITORES_LIST");
foreach ( $resultado as $rw){
	$template->setCurrentBlock("ESCRITORES_DETALLE");
	$template->setVariable("ESCRITORES_DETALLE_NOMBRE", $rw["nombre"]);
	$template->setVariable("ESCRITORES_DETALLE_APELLIDO", $rw["apellido"]);
	$template->setVariable("ESCRITORES_DETALLE_EDAD", $rw["edad"]);
	$template->setVariable("ESCRITORES_DETALLE_LINK", "(<a href=\"escritor.php?action=sel&id=".$rw["id"]."\">Editar</a>)"."(<a href=\"escritor.php?action=del&id=".$rw["id"]."\">Borrar</a>)");
	$template->parseCurrentBlock("ESCRITORES_DETALLE");
}
$template->parseCurrentBlock("ESCRITORES_LIST");

$template->parseCurrentBlock();

$template->show();
?>
