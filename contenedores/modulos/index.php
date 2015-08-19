<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	encabezado("Administrador","");
	if(isset($_GET['pt'])){
		echo "<div id=pt pat=".$_GET['pt']." ></div>";
	}else{
		echo "Error en Web ";
		exit;
	}
		?>
			<div class="contenedor_buscador"> </div>
			<div class="container navbar-inverse">
				<div class="opcion_abc btn btn-default" acc="1"><label>Insertar</label></div>
				<div class="opcion_abc btn btn-default" acc="2"><label>Actualizar</label></div>
				<div class="opcion_abc btn btn-default" acc="3"><label>Eliminar</label></div>
			</div>
			<div class="formulario container" id="formulario_categoria">
				
			</div>
		<?php
	pie();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://gtcompra.com/librerias/propias/js/buscador.js"></script>

<script type="text/javascript" src="http://gtcompra.com/librerias/propias/js/funcionalidad_formulario.js"></script>
<link rel="stylesheet" type="text/css" href="http://gtcompra.com/apariencia/css/formulario.css">
