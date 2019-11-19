<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Ingresar Producto</title>
</head>
<body>
<SCRIPT language="JavaScript">
function after_upd_select(val){
  if ((val.name=="imagefile0")){
    document.form1.productoFoto.value=val.name;
    document.form1.action.value="loadImgs";
  }
  document.form1.submit();
}
</SCRIPT>
  <h1>Ingresar Producto con {USERNAME}</h1>
  {MESSAGE}
  <form name="form1" id="form1" method=post action="productos.php"  enctype="multipart/form-data">
  <table>
    <tr>
      <input type="hidden" name="id" value="{PRODUCTOS_DETALLE_ID_VALUE}">
      <input type="hidden" name="action" value="{PRODUCTOS_DETALLE_ACTION_VALUE}">
      <td>Nombre:</td>
      <td><input type="text" size="50" name="productoNombre" value="{PRODUCTOS_DETALLE_NOMBRE_VALUE}"></td>
    </tr>
    <tr>
      <td>Foto:</td>
      <td><input type="text" size="50" name="productoFoto" value="{PRODUCTOS_DETALLE_FOTO_VALUE}"><input type="file" name="imagefile0" onChange=after_upd_select(this)>{THUMBSTOCK0e}</td>
    </tr>
    <tr>
      <td>Texto:</td>
      <td><input type="text" size="400" name="productoTexto" value="{PRODUCTOS_DETALLE_TEXTO_VALUE}"></td>
    </tr>
    <tr>
      <td>Clasif:</td>
      <td><input type="text" size="10" name="productoClasif" value="{PRODUCTOS_DETALLE_CLASIF_VALUE}"></td>
    </tr>
    <tr>
      <td>Stock:</td>
      <td><input type="text" size="3" name="productoStock" value="{PRODUCTOS_DETALLE_STOCK_VALUE}"></td>
    </tr>
    <tr>
      <td>Precio:</td>
      <td><input type="text" size="10" name="productoPrecio" value="{PRODUCTOS_DETALLE_PRECIO_VALUE}"></td>
    </tr>
    <tr>
      <td>Activo:</td>
      <td><input type="text" size="1" name="productoActivo" value="{PRODUCTOS_DETALLE_ACTIVO_VALUE}"></td>
    </tr>
    <tr>
      <td>MercadoPago:</td>
      <td><input type="text" size="100" name="productoMp" value="{PRODUCTOS_DETALLE_MP_VALUE}"></td>
    </tr>
  </table>
  <p>
    <INPUT TYPE="button" value="{BUTTON_VALUE}" onClick="{BUTTON_ACTION}">
   
  </form>
  <p><a href="index.php">Home</a>
  <p><a href="logout.php">Logout</a>

   <!-- BEGIN PRODUCTOS_LIST -->
    <table border="2" borderColor=red>
  <tr><th>Nombre</th><th>Foto</th><th>Texto</th><th>Clasif</th><th>Stock</th><th>Precio</th><th>Activo</th><th>Mp</th><th>-</th></tr>
    <!-- BEGIN PRODUCTOS_DETALLE -->
      <tr>
        <td>{PRODUCTOS_DETALLE_NOMBRE}</td>
        <td>

        <a href="photosStock/{PRODUCTOS_DETALLE_FOTO}" target="_new"><img src="thumbsStock/{PRODUCTOS_DETALLE_FOTO}" width="108" height="81" border="2"></a></td>

        <td>{PRODUCTOS_DETALLE_TEXTO}</td>
        <td>{PRODUCTOS_DETALLE_CLASIF}</td>
        <td>{PRODUCTOS_DETALLE_STOCK}</td>
        <td>{PRODUCTOS_DETALLE_PRECIO}</td>
        <td>{PRODUCTOS_DETALLE_ACTIVO}</td>
        <td>{PRODUCTOS_DETALLE_MP}</td>
        <td>{PRODUCTOS_DETALLE_LINK}</td>
      </tr>
    <!-- END PRODUCTOS_DETALLE -->
  </table>  
  <!-- END PRODUCTOS_LIST -->
  
</body>
</html>
