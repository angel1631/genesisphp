<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/producto/vista/Vista.php");
	
	$cuerpo="";
	$categoria = "";
	$vista = "";
	$titulo_pagina = "Productos";
	if(isset($_GET['pr'])){
		$pr = desencripta($_GET['pr']); 
		if($pr >0){
			$respuesta = traer_titulo($pr,"producto");
			$mensaje = $respuesta['mensaje'];
			$vista = new Vista_producto();
			$cuerpo .= $vista->traer_vista_grande($pr);
		}
		else
			$cuerpo .=  "No existe el producto";
	}elseif(isset($_GET['ct'])){
		$ct = desencripta($_GET['ct']); 
		if($ct >0){
			$respuesta = traer_titulo($ct,"categoria");
			$titulo_pagina = $respuesta['mensaje'];
			$vista = new Vista_producto($ct);
			$cuerpo .= "<div class=c_productos>".$vista->traer_vista_miniatura()."</div>";	
		}else
			$cuerpo .="No existe la categoria";
	}else{
            $cuerpo .= "Error en productos";
        }
       
	encabezado($titulo_pagina,"");
	echo $cuerpo;
	pie();	
?>
<link rel="stylesheet" type="text/css" href="http://gtcompra.com/modulos/producto/vista/estilo_producto.css">