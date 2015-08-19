<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	$pt = "";
	$salida = "";
	if(isset($_GET['pt'])){
		$pt = $_GET['pt'];
		$salida  = "<div id=pt pat=".$_GET['pt']." ></div>";
	}else{
		echo "Error en Web ";
		exit;
	}
	encabezado(ucwords($pt),"");
	echo $salida;
		?>
			<div class="contenedor_buscador"> </div>
			
			<div class="formulario container" id="formulario_categoria">
				
			</div>
		<?php
	pie();
?>

<link rel="stylesheet" type="text/css" href="http://gtcompra.com/apariencia/css/formulario.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://gtcompra.com/librerias/propias/js/funcionalidad_formulario.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.traer_vista_formulario();
	});
</script>
			