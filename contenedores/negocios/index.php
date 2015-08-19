<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/negocio/vista/Vista.php");
	$cuerpo="";
	$categoria = "";
	if(isset($_GET['ct']) && desencripta($_GET['ct'])>0){
		$categoria = desencripta($_GET['ct']);
		$titulo_categoria = traer_titulo($categoria,"categoria");
		if($titulo_categoria['codigo']==1)
			$titulo_categoria = $titulo_categoria['mensaje'];
		else
			$cuerpo .= $titulo_categoria['mensaje'];
	}
	$vista = new Vista_producto($categoria);
	if(isset($_GET['pr'])){
		if(desencripta($_GET['pr'])>0)
			$cuerpo .= $vista->traer_vista_grande(desencripta($_GET['pr']));
		else
			$cuerpo .=  "No existe el negocio";
	}else{

		$cuerpo .= "<div class=c_productos>".$vista->traer_vista_miniatura()."</div>";
	}

	encabezado($titulo_categoria,"");
	echo $cuerpo;
	pie();	
?>
<link rel="stylesheet" type="text/css" href="http://gtcompra.com/modulos/negocio/vista/estilo_producto.css">