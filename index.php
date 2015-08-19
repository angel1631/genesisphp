<?php 
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	$cdb = new base();
	$salida = "";
	$respuesta = $cdb->seleccionar(array("titulo","id","imagen"),array(array("","estatus","=","1")),array("categoria"));
	if($respuesta['codigo']=="1"){
		$mensaje = $respuesta['mensaje'];
		for($i=0;$i<count($mensaje);$i++){
			$salida .="<a href=\"http://gtcompra.com/contenedores/negocios/?ct=".encripta($mensaje[$i]['id'])."\">".
						"<div class=contenedor_categoria>".
						"<div class=imagen_categoria><img src=\"".$mensaje[$i]['imagen']."\"></div>".
						"<label>".$mensaje[$i]['titulo']."</label>".
					   "</div></a>";
		}
	}else{
		$salida .= $respuesta['mensaje'];
	}
	$cdb->insertar();
	encabezado("Directorio");
	echo $salida;
	pie();
?>
<link rel="stylesheet" type="text/css" href="http://gtcompra.com/modulos/categoria/css/inicio.css">