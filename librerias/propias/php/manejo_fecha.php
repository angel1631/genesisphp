<?php 
function voltear_fecha($fecha){
		
	$arr 			= explode("-",$fecha);
	$fecha_volteada = $arr['2']."-".$arr['1']."-".$arr['0'];
	return $fecha_volteada;
}
?>