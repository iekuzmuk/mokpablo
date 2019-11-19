<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>NOTICIAS</title>
</head>
<body>
  <h1>Ingresar Escritor con {USERNAME}</h1>
  {MESSAGE}
  <form name="form1" method="POST" action="{SCRIPT}">
  <table>
    <tr>
      <input type="hidden" name="id" value="{id}">
      <input type="hidden" name="action" value="add">
      <td>Titulo:</td>
      <td><input type="text" size="150" name="titulo" value="{titulo}"></td>
    </tr>
    <tr>
      <td>Subtitulo:</td>
      <td><input type="text" size="150" name="subtitulo" value="{subtitulo}"></td>
    </tr>
    <tr>
      <td>Fecha:</td>
      <td><input type="text" size="10" name="fecha" value="{fecha}"></td>
    </tr>
    <tr>
      <td>Texto:</td>
      <td><input type="text" size="200" name="texto" value="{texto}"></td>
    </tr>
    <tr>
      <td>Tema:</td>
      <td><input type="text" size="50" name="tema" value="{tema}"></td>
    </tr>
    <tr>
      <td>Escritor:</td>
      <td>
        <select name="escritor">
          <!-- BEGIN optionescritor -->
            <option {SELECTEDescritor} value="{OPTIONVALUEescritor}">{OPTIONTEXTescritor}
          <!-- END optionescritor -->
        </select>
     </td>
    </tr>
  </table>
  <p>
  <INPUT TYPE="button" value="{BUTTON_VALUE}" onClick="{BUTTON_ACTION}">   
  </form>
  <p><a href="index.php">Home</a>
  <p><a href="logout.php">Logout</a>

<!-- BEGIN NOTICIAS_LIST -->
    <table border="2" borderColor=red>
  <tr><th>Escritor</th><th>Titulo</th><th>Subtitulo</th><th>-</th></tr>
    <!-- BEGIN NOTICIAS_DETALLE -->
      <tr>
        <td>{NOTICIAS_DETALLE_ESCRITOR}</td>
        <td>{NOTICIAS_DETALLE_TITULO}</td>
        <td>{ESCRITOR_DETALLE_SUBTITULO}</td>
        <td>{NOTICIAS_DETALLE_LINK}</td>
      </tr>
    <!-- END NOTICIAS_DETALLE -->
  </table>
<!-- END NOTICIAS_LIST -->
  

</body>
</html>
