<?php
require "./includes/authentication.inc";
require_once "./includes/db.inc";
session_start();
sessionAuthenticate("login.html");
$connection = mysqli_connect($hostname, $username, $password, $databasename);
if (mysqli_connect_errno($connection)) showerror("err: ".$connection->errno);
if (!mysqli_select_db($connection, $databasename))showerror("err: ".$connection->errno);

// Clean the data collected from the user
$oldPassword = mysqlclean($_POST, "oldPassword", 10, $connection);
$newPassword1 = mysqlclean($_POST, "newPassword1", 10, $connection);
$newPassword2 = mysqlclean($_POST, "newPassword2", 10, $connection);


if (strcmp($newPassword1, $newPassword2) == 0 &&
  authenticateUser($connection, $_SESSION["loginUsername"], $oldPassword))
{
  // OK to update the user password

  // Create the digest of the password
  $digest = md5(trim($newPassword1));

  // Update the user row
  $update_query = "UPDATE users SET password = '{$digest}'
                   WHERE user_name = '{$_SESSION["loginUsername"]}'";

  if (!$result = @ $connection->query($update_query))
      showerror("err: ".$connection->errno);

  $_SESSION["passwordMessage"] =
    "Password changed for '{$_SESSION["loginUsername"]}'";
}
else
{
  $_SESSION["passwordMessage"] =
    "Could not change password for '{$_SESSION["loginUsername"]}'";
}

// Relocate to the password form
header("Location: password.php");
?>
