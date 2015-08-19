<?php 
function verificar_acceso($usuario,$acceso){
	$cdb = new base();
	if($acceso!=""){
		/*$seleccionar	= array("id_rol");
		$limitantes[]	= array("","") 
		$respuesta = $cdb->seleccionar();;
		$sql = "SELECT id_rol FROM rol_acceso
			where id_rol = (SELECT rol FROM usuario where id = '$usuario' and estatus != '0')
			and id_acceso = (SELECT id FROM acceso where palabra = '$acceso') and estatus != '0'";
		$exe = $db->query($sql);
		if($exe->num_rows>0){
			return 1;
		}else{
			return 0;
		}*/
	}else{
		return 1;
	}	
}
?>