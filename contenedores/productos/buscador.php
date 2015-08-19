<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/genesis_bazar/modulos/negocio/vista/Vista.php");
	$cuerpo = "";
	$categoria = "";
	if(isset($_POST['text-search'])){
		$cdb = new base();
		$seleccion = array("id","titulo","descripcion");
		$limitantes[] = array("","descripcion","like","%".$_POST['text-search']."%");
		$limitantes[] = array("or","titulo","like","%".$_POST['text-search']."%");
		$limitantes[] = array("and","estatus","=","1");
		
		$respuesta = $cdb->seleccionar($seleccion,$limitantes,array("producto"));
		$vista = new Vista_producto();
		$cuerpo .= "<div class=c_productos>".$vista->traer_vista_miniatura($respuesta)."</div>";

	}
	
	encabezado("Resultado".$_POST['text-search'],"");
	echo $cuerpo;
	pie();	
?>
<link rel="stylesheet" type="text/css" href="http://bazarelectroplastico.com/genesis_bazar/modulos/negocio/vista/estilo_producto.css">