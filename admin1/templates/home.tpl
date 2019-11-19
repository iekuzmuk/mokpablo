<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>
<body>
<!-- BEGIN ESCRITORES_LIST -->
  <table border="2" borderColor=red>
    <tr><th>Escritor</th><th>Ultima Publicacion</th><th>Cantidad de Publicaciones</th><th>-</th></tr>
    <!-- BEGIN ESCRITORES_DETALLE -->
      <tr>
        <td>{ESCRITOR_NOMBRE_Y_APELLIDO}</td>
        <td>{ESCRITOR_PUBLICACIONES_ULTIMA}</td>
        <td>{ESCRITOR_PUBLICACIONES_CANTIDAD}</td>
        <td>{ESCRITORES_DETALLE_LINK}</td>
      </tr>
    <!-- END ESCRITORES_DETALLE -->
  </table>
<!-- END ESCRITORES_LIST -->
<!-- BEGIN NOTICIAS_LIST -->
  <H2>DETALLE</H2>
  <table border="2" borderColor=red>
  <tr><th>Escritor</th><th>Fecha</th><th>Titulo</th><th>Subtitulo</th><th>Tema</th><th>-</th></tr>
    <!-- BEGIN NOTICIAS_DETALLE -->
      <tr>
        <td>{NOTICIAS_DETALLE_AUTOR}</td>
        <td>{NOTICIAS_DETALLE_FECHA}</td>
        <td>{NOTICIAS_DETALLE_TITULO}</td>
        <td>{NOTICIAS_DETALLE_SUBTITULO}</td>
        <td>{NOTICIAS_DETALLE_TEMA}</td>
        <td>{NOTICIAS_DETALLE_LINK}</td>
      </tr>
    <!-- END NOTICIAS_DETALLE -->
  </table>
<!-- END NOTICIAS_LIST -->
</body>
</html>
