<?php
require_once 'includes/authentication.inc';
require_once "includes/db.inc";
require_once('./vendor/autoload.php');

session_start();
sessionAuthenticate("login.html");
$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);

$template = new HTML_Template_ITX("./templates");
$template->loadTemplatefile("home.tpl", true, true);

$action = mysqlclean($_GET, "action", 10, $connection);
$id = mysqlclean($_GET, "id", 10, $connection);

PrintMessages($connection, $template,$action,$id);

$template->show();

function PrintMessages($connection, $template,$action,$id){	
	print "You are logged on as <font color=\"#ff0000\"><n>" . $_SESSION["loginUsername"]."</font></n>";
	print "<p><a href=\"password.php\">Change Password</a>";
	print "<p><a href=\"productos.php\">Productos</a>";
	print "<p><a href=\"preguntas.php\">Preguntas</a>";
	print "<p><a href=\"index.php\">Home</a>";
	print "<p align=left><a href=\"logout.php\">Logout</a>";
/*
	$resultado = $connection->query("SELECT concat(escritores.nombre, ' ', escritores.apellido) as autor,noticias.fecha as fecha,count(*) as cantidad, noticias.escritor as escritorid FROM `noticias` inner join escritores on noticias.escritor = escritores.id GROUP by escritores.id ORDER BY `noticias`.`escritor`,`noticias`.`id` DESC");
	$template->setCurrentBlock("ESCRITORES_LIST");
	foreach ($resultado as $rw){
		$template->setCurrentBlock("ESCRITORES_DETALLE");
		$template->setVariable("ESCRITOR_NOMBRE_Y_APELLIDO", $rw["autor"]);
		$template->setVariable("ESCRITOR_PUBLICACIONES_ULTIMA", $rw["fecha"]);
		$template->setVariable("ESCRITOR_PUBLICACIONES_CANTIDAD",$rw["cantidad"]);
		$template->setVariable("ESCRITORES_DETALLE_LINK", "(<a href=\"index.php?action=show&id=".$rw["escritorid"]."\">Ver mas...</a>)");
		$template->parseCurrentBlock("ESCRITORES_DETALLE");
	}
	$template->parseCurrentBlock("ESCRITORES_LIST");
	switch ($action){
		case "show":
			$res = $connection->query("SELECT noticias.*,date(noticias.fecha) as fecha1, concat(escritores.nombre, ' ', escritores.apellido) as autor,noticias.fecha as fecha, noticias.escritor as escritorid FROM `noticias` inner join escritores on noticias.escritor = escritores.id where escritores.id=$id ORDER BY noticias.id DESC");
			$template->setCurrentBlock("NOTICIAS_LIST");
			foreach ($res as $r){
				$template->setCurrentBlock("NOTICIAS_DETALLE");
				$template->setVariable("NOTICIAS_DETALLE_AUTOR", $r["autor"]);
				$template->setVariable("NOTICIAS_DETALLE_FECHA", $r["fecha1"]);
				$template->setVariable("NOTICIAS_DETALLE_TITULO", $r["titulo"]);
				$template->setVariable("NOTICIAS_DETALLE_SUBTITULO", $r["subtitulo"]);
				$template->setVariable("NOTICIAS_DETALLE_TEMA", $r["tema"]);
				$template->setVariable("NOTICIAS_DETALLE_LINK", "(<a href=\"index.php?action=shownot&id=".$r["id"]."\">Ver mas...</a>)");
				$template->parseCurrentBlock("NOTICIAS_DETALLE");
			}
			$template->parseCurrentBlock("NOTICIAS_LIST");
			$action='';
		break;
	}
	$template->parseCurrentBlock();
	*/
}
?>