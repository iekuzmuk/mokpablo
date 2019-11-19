<?php
require "includes/authentication.inc";
require_once "includes/db.inc";
require_once('./vendor/autoload.php');
ini_set('memory_limit', '100M'); 
session_start();
sessionAuthenticate("login.html");
$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);

$template = new HTML_Template_ITX("./templates");
$template->loadTemplatefile("productos.tpl", true, true);

$action = mysqlclean($_GET, "action", 10, $connection);
$id = mysqlclean($_GET, "id", 10, $connection);
$productoNombre = mysqlclean($_POST, "productoNombre", 50, $connection);
$productoFoto = mysqlclean($_POST, "productoFoto", 50, $connection);
$productoTexto = mysqlclean($_POST, "productoTexto", 400, $connection);
$productoClasif = mysqlclean($_POST, "productoClasif", 20, $connection);
$productoStock = mysqlclean($_POST, "productoStock", 3, $connection);
$productoPrecio = mysqlclean($_POST, "productoPrecio", 10, $connection);
$productoActivo = mysqlclean($_POST, "productoActivo", 1, $connection);
$productoMp = mysqlclean($_POST, "productoMp", 100, $connection);
$post_action = mysqlclean($_POST, "action", 10, $connection);
$post_id = mysqlclean($_POST, "id", 10, $connection);
$imagefile = "imagefile0";

if(!empty($post_action)){$action = $post_action; $id= $post_id;}

$template->setVariable("BUTTON_VALUE", "AGREGAR");
$template->setVariable("BUTTON_ACTION", "document.form1.action.value='add';document.form1.submit();");

function re_farm_image($fname,$pisarono=0,$Ref=0,$upd=0){
	$imagefile = "imagefile0";
	if($upd){
	//2
	if($debug_mode)echo("refarm image 2copy ...<br>");
		copy("hotosStock/$fname", "photosStock/$fname") || die ("copy Could not copy");
	//3
	if($debug_mode)echo("refarm image 3resample ...<br>");
		list($width) = getimagesize ("photosStock/$fname");
		if($width>600) resample_picfile( "photosStock/$fname","photosStock/$fname", $width/600,864,648);
	//4
	if($debug_mode)echo("refarm image 4pissimage ...<br>");
		if($pisarono==1) pissImage("photosStock/$fname",$Ref);
		if($pisarono==2) pissImageOLXAM("photosStock/$fname",$Ref);
	//5
		resample_picfile( "photosStock/$fname", "thumbsStock/$fname",0,108,81);//resample o create tumb?
	}
	else{
	//2
		copy("hotosStock/$fname", "photosStock/$fname") || die ("copy Could not copy");
	//3
		if(($_FILES["{$imagefile}"]["size"]/1024)>600) resample_picfile( "photosStock/$fname","photosStock/$fname", $_FILES["{$imagefile}"]["size"]/600,864,648);
	//5
		resample_picfile( "photosStock/".$fname, "thumbsStock/".$fname,0,108,81);//resample o create tumb?
	}
}

switch ($action){
	case "del":
		if (!$result = @ $connection->query("DELETE FROM productos WHERE id=$id;"))   showerror("err: ".$connection->errno);
	break;
	case "sel":
		$resultado = $connection->query("SELECT * FROM productos where id=$id;");
		foreach ( $resultado as $r)
		$template->setVariable("PRODUCTOS_DETALLE_ID_VALUE", $id);
		$template->setVariable("BUTTON_VALUE", "ENVIAR CAMBIOS");
		$template->setVariable("BUTTON_ACTION", "document.form1.action.value='upd';document.form1.submit();");
		$template->setVariable("PRODUCTOS_DETALLE_NOMBRE_VALUE", $r["nombre"]);
		$template->setVariable("PRODUCTOS_DETALLE_FOTO_VALUE",$r["foto"]);
		$template->setVariable("PRODUCTOS_DETALLE_TEXTO_VALUE", $r["texto"]);
		$template->setVariable("PRODUCTOS_DETALLE_CLASIF_VALUE", $r["clasif"]);
		$template->setVariable("PRODUCTOS_DETALLE_STOCK_VALUE", $r["stock"]);
		$template->setVariable("PRODUCTOS_DETALLE_PRECIO_VALUE", $r["precio"]);
		$template->setVariable("PRODUCTOS_DETALLE_ACTIVO_VALUE", $r["activo"]);
		$template->setVariable("PRODUCTOS_DETALLE_MP_VALUE", $r["mp"]);
	break;
	case "add":
	$query = "INSERT INTO productos(nombre,foto,texto,clasif,stock,activo) VALUES ('$productoNombre','$productoFoto','$productoTexto','$productoClasif',$productoStock,$productoPrecio,$productoActivo,'$productoMp');";
	//echo $query;
		if (!$result = @ $connection->query($query)) showerror("err: ".$connection->errno);
	break;
	case "upd":
		if (!$result = @ $connection->query("UPDATE productos set nombre='$productoNombre', foto='$productoFoto',texto='$productoTexto',clasif='$productoClasif',stock=$productoStock,precio=$productoPrecio, activo=$productoActivo, mp='$productoMp' WHERE id=$id;")) showerror("err: ".$connection->errno);
	break;
	case "loadImgs":
		//0
		//$imagefile = $productoFoto;
		$fname = $_FILES["$imagefile"]['name'];
		//echo "fname: ".$fname. "productoFoto: ".$productoFoto;
		//1
		$fname= date("dmyHi").strtolower(str_replace(str_split_iv(preg_replace("/([[:alnum:]_\.-]*)/","",$fname)),"",$fname));//validation of field

		move_uploaded_file($_FILES["$imagefile"]['tmp_name'], "hotosStock/$fname") || die ("moveupload Could not copy");
		re_farm_image($fname,0);
		
		//6
		$t = "thumbStock".substr($imagefile,-1);
		$$t ="$fname";
	 
		$t = "thumbStock".substr($imagefile,-1)."enable";
		$$t =1;
		$template->setVariable("PRODUCTOS_DETALLE_FOTO_VALUE", $fname);

		$template->setVariable("PRODUCTOS_DETALLE_ID_VALUE", $id);
		$template->setVariable("BUTTON_VALUE", "ENVIAR CAMBIOS");
		$template->setVariable("BUTTON_ACTION", "document.form1.action.value='upd';document.form1.submit();");
		$template->setVariable("PRODUCTOS_DETALLE_NOMBRE_VALUE", $productoNombre);
		$template->setVariable("PRODUCTOS_DETALLE_TEXTO_VALUE", $productoTexto);
		$template->setVariable("PRODUCTOS_DETALLE_CLASIF_VALUE", $productoClasif);
		$template->setVariable("PRODUCTOS_DETALLE_STOCK_VALUE", $productoStock);
		$template->setVariable("PRODUCTOS_DETALLE_PRECIO_VALUE", $productoPrecio);
		$template->setVariable("PRODUCTOS_DETALLE_ACTIVO_VALUE", $productoActivo);
		$template->setVariable("PRODUCTOS_DETALLE_MP_VALUE", $productoMp);
	break;
}

$message = "";

$template->setVariable("USERNAME", $_SESSION["loginUsername"]);
$template->setVariable("MESSAGE", $message);

$resultado = $connection->query("SELECT * FROM productos;");
$template->setCurrentBlock("PRODUCTOS_LIST");
foreach ( $resultado as $rw){
	$template->setCurrentBlock("PRODUCTOS_DETALLE");
	$template->setVariable("PRODUCTOS_DETALLE_NOMBRE", $rw["nombre"]);
	$template->setVariable("PRODUCTOS_DETALLE_FOTO",strlen($rw["foto"]<3)?"11dot.gif":$rw["foto"]);
	$template->setVariable("PRODUCTOS_DETALLE_TEXTO", $rw["texto"]);
	$template->setVariable("PRODUCTOS_DETALLE_CLASIF", $rw["clasif"]);
	$template->setVariable("PRODUCTOS_DETALLE_STOCK", $rw["stock"]);
	$template->setVariable("PRODUCTOS_DETALLE_PRECIO", $rw["precio"]);
	$template->setVariable("PRODUCTOS_DETALLE_ACTIVO", $rw["activo"]);
	$template->setVariable("PRODUCTOS_DETALLE_MP", $rw["mp"]);
	$template->setVariable("PRODUCTOS_DETALLE_LINK", "(<a href=\"productos.php?action=sel&id=".$rw["id"]."\">Editar</a>)"."(<a href=\"productos.php?action=del&id=".$rw["id"]."\">Borrar</a>)");
	$template->parseCurrentBlock("PRODUCTOS_DETALLE");
}
$template->parseCurrentBlock("PRODUCTOS_LIST");

$template->parseCurrentBlock();

$template->show();
?>