<?php
function encripta($numero){
	$nuevo = $numero+2;
	if($nuevo%2==0){
		$nuevo=$nuevo/2;
		$nuevo="a".$nuevo;
	}
	else{
		$nuevo=$nuevo*3;		
		$nuevo="b".$nuevo;
	}
	return $nuevo;
}
function desencripta($texto){
	$resto=substr($texto,1);
	$resultado=0;
	if(substr($texto,0,1)=="a"){
		$resultado=$resto*2;
	}else if(substr($texto,0,1)=="b"){
		$resultado=$resto/3;
	}else{
		$resultado=2;
	}
	$resultado=$resultado-2;
	return $resultado;
}
?>