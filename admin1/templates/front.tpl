<!-- BEGIN PRODUCTOS_LIST -->
 <div class="text-center">
    <h2>Productos</h2>
    <h4>Distintas opciones disponibles</h4>
 </div>
 <div class="row">
<!-- BEGIN PRODUCTOS_DETALLE -->
<div class="col-sm-4"><div class="panel panel-default text-center">
    <div class="panel-heading"><h1>{PRODUCTOS_DETALLE_NOMBRE}</h1></div>
    <div class="panel-body"><a href="admin/photosStock/{PRODUCTOS_DETALLE_FOTO}" target="_new"><img src="admin/thumbsStock/{PRODUCTOS_DETALLE_FOTO}" width="108" height="81" border="2"></a></div>
      <div class="panel-body">{PRODUCTOS_DETALLE_TEXTO}</div>
      <div class="panel-footer">
        <h3>{PRODUCTOS_DETALLE_PRECIO}</h3>
        <h4>en efectivo o transf. bancaria CBU</h4>
        <h4>o tarjeta - Rapipago/Pagofacil</h4>
        {PRODUCTOS_DETALLE_MP}
        <script type="text/javascript">(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();</script>
        <a href="#contact" class="btn btn-lg" role="button">Contactar</a>
      </div>
  </div> 
</div>  
<!-- END PRODUCTOS_DETALLE --></div>
<!-- END PRODUCTOS_LIST -->

<!-- BEGIN PREGUNTAS_LIST -->
<div id="faqs" class="container-fluid bg-grey jumbotron">
 <h1>Preguntas Frecuentes</h1>
  <!-- BEGIN PREGUNTAS_DETALLE -->
    <p class="pregunta">{PREGUNTAS_DETALLE_TEXTO}</p>
    <p class="respuesta">{PREGUNTAS_DETALLE_RESPUESTA}</p>
  <!-- END PREGUNTAS_DETALLE -->
  </div>
<!-- END PREGUNTAS_LIST -->