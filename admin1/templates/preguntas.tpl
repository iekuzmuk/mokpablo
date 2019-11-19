<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Ingresar Pregunta</title>
</head>
<body>
  <h1>Ingresar Pregunta con {USERNAME}</h1>
  {MESSAGE}
  <form name="form1" method="POST" action="preguntas.php">
  <table>
    <tr>
      <input type="hidden" name="id" value="{PREGUNTAS_DETALLE_ID_VALUE}">
      <input type="hidden" name="action" value="{PREGUNTAS_DETALLE_ACTION_VALUE}">
      <td>Referencia:</td>
      <td><input type="text" size="20" name="preguntaReferencia" value="{PREGUNTAS_DETALLE_REFERENCIA_VALUE}"></td>
    </tr>
    <tr>
      <td>Pregunta:</td>
      <td><input type="text" size="200" name="preguntaTexto" value="{PREGUNTAS_DETALLE_TEXTO_VALUE}"></td>
    </tr>
    <tr>
      <td>Respuesta:</td>
      <td><input type="text" size="200" name="preguntaRespuesta" value="{PREGUNTAS_DETALLE_RESPUESTA_VALUE}"></td>
    </tr>
    <tr>
      <td>Fecha:</td>
      <td><input type="text" size="20" name="preguntaFecha" value="{PREGUNTAS_DETALLE_FECHA_VALUE}"></td>
    </tr>
    <tr>
      <td>Activo:</td>
      <td><input type="text" size="1" name="preguntaActivo" value="{PREGUNTAS_DETALLE_ACTIVO_VALUE}"></td>
    </tr>
    <tr>
      <td>PF:</td>
      <td><input type="text" size="1" name="preguntaPf" value="{PREGUNTAS_DETALLE_PF_VALUE}"></td>
    </tr>
  </table>
  <p>
    <INPUT TYPE="button" value="{BUTTON_VALUE}" onClick="{BUTTON_ACTION}">
   
  </form>
  <p><a href="index.php">Home</a>
  <p><a href="logout.php">Logout</a>

   <!-- BEGIN PREGUNTAS_LIST -->
    <table border="2" borderColor=red>
  <tr><th>Referencia</th><th>Texto</th><th>Respuesta</th><th>Fecha</th><th>Activo</th><th>pf</th><th>-</th></tr>
    <!-- BEGIN PREGUNTAS_DETALLE -->
      <tr>
        <td>{PREGUNTAS_DETALLE_REFERENCIA}</td>
        <td>{PREGUNTAS_DETALLE_TEXTO}</td>
        <td>{PREGUNTAS_DETALLE_RESPUESTA}</td>
        <td>{PREGUNTAS_DETALLE_FECHA}</td>
        <td>{PREGUNTAS_DETALLE_ACTIVO}</td>
        <td>{PREGUNTAS_DETALLE_PF}</td>
        <td>{PREGUNTAS_DETALLE_LINK}</td>
      </tr>
    <!-- END PREGUNTAS_DETALLE -->
  </table>  
  <!-- END PREGUNTAS_LIST -->
  
</body>
</html>
