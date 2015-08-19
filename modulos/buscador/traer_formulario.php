<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	function traer_formulario($codigo,$estructura,$tabla,$tablas_foraneas = "",$parametros_foranea 	= ""){ //los parametros tablas foraneas pide un array de 2 dimensiones que tiene
		$cdb 			= new base();
		$limitantes[]	= array("","id","=",$codigo);
		$limitantes[] 	= array("and","estatus","!=","0");
		$respuesta 		= $cdb->seleccionar($estructura,$limitantes,$tabla);
		if($respuesta['codigo'] == 1){
			if($tablas_foraneas != ""){
				foreach($tablas_foraneas as $tabla_foranea){
					$limitantes 	= [];
					$limitantes[] 	= array("",$parametros_foranea['col_principal'],"=",$codigo);
					$limitantes[] 	= array("and","estatus","!=","0");
					$respuesta_foranea = $cdb->seleccionar($parametros_foranea['col_respuesta'],$limitantes,array($tabla_foranea['principal']));
					if($respuesta_foranea['codigo']==1){
						$respuesta_foranea['mensaje']['tb'] = $tabla_foranea['secundaria'];
						$respuesta['mensaje'][0]['foraneo_multiple'][] = $respuesta_foranea['mensaje'];
					}
				}
			}
			
		}
		return $respuesta;
	}
?>