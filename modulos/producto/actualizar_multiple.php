<?php 
require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
function actualizar_multiple($id,$datos,$tabla){
	$cdb = new base();
	$dt_base = [];
	$respuesta = $cdb->seleccionar(array("imagen","estatus"),array(array("","producto","=",$id)),array($tabla));
	if($respuesta['codigo']==1){
		foreach ($respuesta['mensaje'] as $value) {
			$dt_base[] = $value['imagen'];
		}
	}
	foreach($datos as $dato){
		if(!in_array($dato,$dt_base)){
			$respuesta = $cdb->insertar(array("producto"=>$id,"imagen"=>$dato,"estatus"=>"1"),$tabla,"0");		
		}
	}
	$datos = json_decode(json_encode($datos), true);
	foreach ($dt_base as $dt) {
		if(!in_array($dt,$datos)){
			$respuesta = $cdb->eliminar(array(array("","producto","=",$id),array("and","imagen","=",$dt)),$tabla);
		}
	}
	return $respuesta;
}
?>