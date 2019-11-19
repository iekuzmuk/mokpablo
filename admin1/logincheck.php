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
	$loginUsername = "admin";

	session_start();
	// Authenticate the user
	if (authenticateUser($connection, $loginUsername, $loginPassword)){

		$_SESSION["loginUsername"] = $loginUsername;
		$_SESSION["home"] = $home;
		$_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];
	//	session_start();
		authenticateUser($connection, $loginUsername, $loginPassword);
		header("Location: index.php");
		//echo "connection ok - deberia mostrar home";
	}
	else{
		// The authentication failed: setup a logout message
		$_SESSION["message"] = "Could not connect to the application as '{$loginUsername}'";
		//echo "connection NO - deberia mostrar home"; exit;
		header("Location: logout.php");
	}
?>