<?php 
require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
function actualizar_multiple($id,$datos,$tabla){
	$cdb = new base();
	$dt_base = [];
	$respuesta = $cdb->seleccionar(array("categoria","estatus"),array(array("","negocio","=",$id)),array($tabla));
	if($respuesta['codigo']==1){
		foreach ($respuesta['mensaje'] as $value) {
			$dt_base[] = $value['categoria'];
		}
	}
	foreach($datos as $dato){
		if(!in_array($dato,$dt_base)){
			$respuesta = $cdb->insertar(array("negocio"=>$id,"categoria"=>$dato,"estatus"=>"1"),$tabla,"0");		
		}
	}
	$datos = json_decode(json_encode($datos), true);
	foreach ($dt_base as $dt) {
		if(!in_array($dt,$datos)){
			$respuesta = $cdb->eliminar(array(array("","negocio","=",$id),array("and","categoria","=",$dt)),$tabla);
		}
	}
	return $respuesta;
}
?>