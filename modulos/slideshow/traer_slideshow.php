<?php	require_once("$_SERVER[DOCUMENT_ROOT]/genesis_bazar/granlibreria.php");
	function traer_slideshow(){
		$cdb = new base();
		$cdb->set_referencia("s.posicion");
		$cdb->set_forma("asc");
		$respuesta = $cdb->seleccionar(array("i.url","s.posicion","s.titulo"),array(array("","s.estatus","!=","0"),array("and","s.imagen","=","i.id")),array("slideshow s","imagen i"));
		if($respuesta['codigo']==1){
			echo "<img src=\"".$respuesta['mensaje'][(count($respuesta['mensaje'])-1)]['url']."\" />";
			for($i=0;$i<(count($respuesta['mensaje'])-1);$i++){
				echo "<img src=\"".$respuesta['mensaje'][$i]['url']."\" />";
			}
		}else
			echo $respuesta['mensaje'];
	}
	
?>