<?php
	require_once 'includes/authentication.inc';
	require_once "includes/db.inc";

	$connection = mysqli_connect($hostname, $username, $password, $databasename);

	if (mysqli_connect_errno($connection))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	else echo "connection ok";

	// Clean the data collected in the <form>
	$loginUsername = mysqlclean($_POST, "loginUsername", 20, $connection);
	$loginPassword = mysqlclean($_POST, "loginPassword", 20, $connection);
	
	$id = mysqlclean($_POST, "id", 10, $connection);
	$action = mysqlclean($_POST, "action", 10, $connection);
	$titulo = mysqlclean($_POST, "titulo", 10, $connection);
	$subtitulo = mysqlclean($_POST, "subtitulo", 10, $connection);
	$fecha = mysqlclean($_POST, "fecha", 10, $connection);
	$texto = mysqlclean($_POST, "texto", 10, $connection);
	$tema = mysqlclean($_POST, "tema", 10, $connection);
	$escritor = mysqlclean($_POST, "escritor", 10, $connection);
	
	//	echo "actionpost: (".$post_action.")";
	
	$loginUsername = "admin";

	session_start();
	// Authenticate the user
	if (authenticateUser($connection, $loginUsername, $loginPassword)){

		$_SESSION["loginUsername"] = $loginUsername;
		$_SESSION["home"] = $home;
		$_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];
	
		authenticateUser($connection, $loginUsername, $loginPassword);
		switch ($action){
		case "del":
			if (!$result = @ $connection->query("DELETE FROM noticias WHERE id=$id;"))   showerror("err: ".$connection->errno);
			header("Location: noticias.php");
		break;
		case "upd":
			$sql = "UPDATE noticias set titulo='$titulo', subtitulo='$subtitulo', fecha='$fecha', texto = '$texto', tema = '$tema', escritor=$escritor WHERE id=$id;";
			if (!$result = @ $connection->query($sql)) showerror("err: ".$connection->errno);
			header("Location: noticias.php");
		break;
		case "add":
			$sql = "INSERT INTO noticias(titulo,subtitulo,fecha,texto, tema, escritor) VALUES ('$titulo','$subtitulo','$fecha','$texto','$tema',$escritor);";
			echo $sql;
			if (!$result = @ $connection->query($sql)) showerror("Add err: ".$connection->errno);
			header("Location: noticias.php");
		break;
		}
	}
	else{
		// The authentication failed: setup a logout message
		$_SESSION["message"] = "Could not connect to the application as '{$loginUsername}'";
		//echo "connection NO - deberia mostrar home"; exit;
		header("Location: logout.php");
	}
?>