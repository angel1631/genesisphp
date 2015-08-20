<?php require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
function traer_opciones_menu($padre = "",$nivel = 0){
	$cdb = new base();

	$salida = "";
	$seleccion = array("id","url","titulo","acceso");
	$limitantes[] = array("","estatus","!=","0");
	if($padre != "")
		$limitantes[] = array("and","padre","=",$padre);
	else
		$limitantes[] = array("and","padre","IS",$padre);
	$tabla[] = "menu";
	$cdb->set_referencia("posicion");
	$cdb->set_forma("asc");
	$respuesta = $cdb->seleccionar($seleccion,$limitantes,$tabla);
	if($respuesta['codigo'] == 1){ 
		if($padre == "")
			$salida .= "<ul class=nav >";
		else
			$salida .= "<ul>";
		for($i=0;$i<count($respuesta['mensaje']);$i++){
			$salida .= "<li><a href=\"".$respuesta['mensaje'][$i]['url']."\" >".$respuesta['mensaje'][$i]['titulo']."</a>";
			$salida .= traer_opciones_menu($respuesta['mensaje'][$i]['id'],($nivel+1));
			$salida .= "</li>";		
		}
		$salida .="</ul>";
		return $salida;
	}
}
?>