<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Ingresar Escritor</title>
</head>
<body>
  <h1>Ingresar Escritor con {USERNAME}</h1>
  {MESSAGE}
  <form name="form1" method="POST" action="escritor.php">
  <table>
    <tr>
      <input type="hidden" name="id" value="{ESCRITORES_DETALLE_ID_VALUE}">
      <input type="hidden" name="action" value="{ESCRITORES_DETALLE_ACTION_VALUE}">
      <td>Apellido:</td>
      <td><input type="text" size="10" name="escritorApellido" value="{ESCRITORES_DETALLE_APELLIDO_VALUE}"></td>
    </tr>
    <tr>
      <td>Nombre:</td>
      <td><input type="text" size="10" name="escritorNombre" value="{ESCRITORES_DETALLE_NOMBRE_VALUE}"></td>
    </tr>
    <tr>
      <td>Edad:</td>
      <td><input type="text" size="10" name="escritorEdad" value="{ESCRITORES_DETALLE_EDAD_VALUE}"></td>
    </tr>
  </table>
  <p>
    <INPUT TYPE="button" value="{BUTTON_VALUE}" onClick="{BUTTON_ACTION}">
   
  </form>
  <p><a href="index.php">Home</a>
  <p><a href="logout.php">Logout</a>

   <!-- BEGIN ESCRITORES_LIST -->
    <table border="2" borderColor=red>
  <tr><th>Nombre</th><th>Apellido</th><th>Edad</th><th>-</th></tr>
    <!-- BEGIN ESCRITORES_DETALLE -->
      <tr>
        <td>{ESCRITORES_DETALLE_NOMBRE}</td>
        <td>{ESCRITORES_DETALLE_APELLIDO}</td>
        <td>{ESCRITORES_DETALLE_EDAD}</td>
        <td>{ESCRITORES_DETALLE_LINK}</td>
      </tr>
    <!-- END ESCRITORES_DETALLE -->
  </table>  
  <!-- END ESCRITORES_LIST -->
  
</body>
</html>
