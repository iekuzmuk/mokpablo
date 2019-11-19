<?php
    require_once "admin/includes/db.inc";

    $connection = mysqli_connect($hostname, $username, $password, $databasename);
    if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
    if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);

    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d h:i");
    $name = mysqlclean($_POST, "name", 200, $connection);
    $email = mysqlclean($_POST, "email", 500, $connection);
    $comments = mysqlclean($_POST, "comments", 2500, $connection);
    $insert = 1;
    if (empty($comments)) $insert = 0;
    if ((strcmp($comments,"-")==0) || empty($name) || empty($email)) $insert = 0;
	
    $query = "INSERT INTO contacto_malacateweb VALUES (0,DATE_ADD(NOW(), INTERVAL 4 HOUR),'$ip','$comments','$name','$email',1,DATE_ADD(NOW(), INTERVAL 4 HOUR))";
    if ($insert)
        if (!$result = @ $connection->query($query)) showerror("err: ".$connection->errno);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>malacateweb.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head><body>
<?php
if ($insert)
    echo("<h1>enviado correctamente</h1>");
else
	echo("<h1>NO enviado - completo mal los campos</h1>");
    echo("<a href=\"https://www.malacateok.com/\">Volver</a>");
?>
</body>
</html>