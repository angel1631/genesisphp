<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	function traer_titulo($codigo,$tabla,$columna = "titulo"){
		$cdb = new base();
		$seleccion 		= array($columna);
		$limitantes[] 	= array("","id","=",$codigo);
		$limitantes[] 	= array("and","estatus","!=","0");
		$tabla			= array($tabla);
		$respuesta = $cdb->seleccionar($seleccion,$limitantes,$tabla);
		$respuesta['mensaje'] = $respuesta['mensaje'][0][0];
		return $respuesta;
	}
?>