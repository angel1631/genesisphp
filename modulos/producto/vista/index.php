<?php
	require_once("Vista.php");
	encabezado("","");
	$vista = new Vista_producto();
	if(isset($_GET['pr'])){
		if(regresar_numero($_GET['pr'])>0)
			echo $vista->traer_vista_grande(regresar_numero($_GET['pr']));
		else
			echo "No existe el producto";
	}else
		echo "<div class=c_productos>".$vista->traer_vista_miniatura()."</div>";
	pie();	
?>
<link rel="stylesheet" type="text/css" href="estilo_producto.css">