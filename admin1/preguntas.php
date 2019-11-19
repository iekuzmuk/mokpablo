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
$template->loadTemplatefile("preguntas.tpl", true, true);

$action = mysqlclean($_GET, "action", 10, $connection);
$id = mysqlclean($_GET, "id", 10, $connection);
$preguntaReferencia = mysqlclean($_POST, "preguntaReferencia", 20, $connection);
$preguntaTexto = mysqlclean($_POST, "preguntaTexto", 200, $connection);
$preguntaRespuesta = mysqlclean($_POST, "preguntaRespuesta", 200, $connection);
$preguntaFecha = mysqlclean($_POST, "preguntaFecha", 20, $connection);
$preguntaActivo = mysqlclean($_POST, "preguntaActivo", 1, $connection);
$preguntaPf = mysqlclean($_POST, "preguntaPf", 1, $connection);
$post_action = mysqlclean($_POST, "action", 10, $connection);
$post_id = mysqlclean($_POST, "id", 10, $connection);
//echo "nom: $preguntaNombre - foto: $preguntaFoto - texto: $preguntaTexto - clasif: $preguntaClasif - stock: $preguntaStock - activo: $preguntaActivo";
if(!empty($post_action)){$action = $post_action; $id= $post_id;}

$template->setVariable("BUTTON_VALUE", "AGREGAR");
$template->setVariable("BUTTON_ACTION", "document.form1.action.value='add';document.form1.submit();");
$template->setVariable("PREGUNTAS_DETALLE_FECHA_VALUE", date("Y-m-d H:i:s"));
switch ($action){
	case "del":
		if (!$result = @ $connection->query("DELETE FROM preguntas WHERE id=$id;"))   showerror("err: ".$connection->errno);
	break;
	case "sel":
		$resultado = $connection->query("SELECT * FROM preguntas where id=$id;");
		foreach ( $resultado as $r)
		$template->setVariable("PREGUNTAS_DETALLE_ID_VALUE", $id);
		$template->setVariable("BUTTON_VALUE", "ENVIAR CAMBIOS");
		$template->setVariable("BUTTON_ACTION", "document.form1.action.value='upd';document.form1.submit();");
		$template->setVariable("PREGUNTAS_DETALLE_REFERENCIA_VALUE", $r["referencia"]);
		$template->setVariable("PREGUNTAS_DETALLE_TEXTO_VALUE", $r["texto"]);
		$template->setVariable("PREGUNTAS_DETALLE_RESPUESTA_VALUE", $r["respuesta"]);
		$template->setVariable("PREGUNTAS_DETALLE_FECHA_VALUE", $r["fecha"]);
		$template->setVariable("PREGUNTAS_DETALLE_ACTIVO_VALUE", $r["activo"]);
		$template->setVariable("PREGUNTAS_DETALLE_PF_VALUE", $r["pf"]);
	break;
	case "add":
	$query = "INSERT INTO preguntas(referencia,texto,respuesta,fecha,activo,pf) VALUES ('$preguntaReferencia','$preguntaTexto','$preguntaRespuesta','$preguntaFecha',$preguntaActivo,$preguntaPf);";
	//echo $query;
		if (!$result = @ $connection->query($query)) showerror("err: ".$connection->errno);
	break;
	case "upd":
		if (!$result = @ $connection->query("UPDATE preguntas set referencia='$preguntaReferencia', texto='$preguntaTexto',respuesta='$preguntaRespuesta',fecha='$preguntaFecha',activo=$preguntaActivo, pf=$preguntaPf WHERE id=$id;")) showerror("err: ".$connection->errno);
	break;
}

$message = "";

$template->setVariable("USERNAME", $_SESSION["loginUsername"]);
$template->setVariable("MESSAGE", $message);

$resultado = $connection->query("SELECT * FROM preguntas;");
$template->setCurrentBlock("PREGUNTAS_LIST");
foreach ( $resultado as $rw){
	$template->setCurrentBlock("PREGUNTAS_DETALLE");
	$template->setVariable("PREGUNTAS_DETALLE_REFERENCIA", $rw["referencia"]);
	$template->setVariable("PREGUNTAS_DETALLE_TEXTO", $rw["texto"]);
	$template->setVariable("PREGUNTAS_DETALLE_RESPUESTA", $rw["respuesta"]);
	$template->setVariable("PREGUNTAS_DETALLE_FECHA", $rw["fecha"]);
	$template->setVariable("PREGUNTAS_DETALLE_ACTIVO", $rw["activo"]);
	$template->setVariable("PREGUNTAS_DETALLE_PF", $rw["pf"]);
	$template->setVariable("PREGUNTAS_DETALLE_LINK", "(<a href=\"preguntas.php?action=sel&id=".$rw["id"]."\">Editar</a>)"."(<a href=\"preguntas.php?action=del&id=".$rw["id"]."\">Borrar</a>)");
	$template->parseCurrentBlock("PREGUNTAS_DETALLE");
}
$template->parseCurrentBlock("PREGUNTAS_LIST");

$template->parseCurrentBlock();

$template->show();
?>