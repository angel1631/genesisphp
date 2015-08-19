<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/negocio/vista/Vista.php");
	$cuerpo = "";
	$categoria = "";
	if(isset($_POST['text-search'])){
		$cdb = new base();
		$seleccion = array("n.id","n.titulo","n.descripcion","n.direccion","n.horarios","n.telefonos");
		$limitantes[] = array("","n.descripcion","like","%".$_POST['text-search']."%");
		$limitantes[] = array("or","n.titulo","like","%".$_POST['text-search']."%");
		$limitantes[] = array("and","estatus","=","1");
		
		$respuesta = $cdb->seleccionar($seleccion,$limitantes,array("negocio n"));
		$vista = new Vista_producto();
		$cuerpo .= "<div class=c_productos>".$vista->traer_vista_miniatura($respuesta)."</div>";

	}
	
	encabezado("Resultado".$_POST['text-search'],"");
	echo $cuerpo;
	pie();	
?>
<link rel="stylesheet" type="text/css" href="http://gtcompra.com/modulos/negocio/vista/estilo_producto.css">