<?php 
require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
function guardar_multiple($id,$datos,$tabla){
	$cdb = new base();
	foreach($datos as $dato)
		$respuesta = $cdb->insertar(array("negocio"=>$id,"categoria"=>$dato,"estatus"=>"1"),$tabla,"0");
	return $respuesta;
}
?>