<?php
	function buscar($tabla, $dato, $columna = "titulo"){
		$cdb = new base();
		$seleccion 	= array("id","titulo");
		$limitante[] 	= array("","$columna","=","%$dato%");
		$limitante[] 	= array("and","estatus","=","1");
		$tabla 			= array($tabla);
		$respuesta = $cdb->seleccionar($seleccion,$limitante,$tabla);
		return $respuesta;
	}
?>