<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	function traer_lista($texto,$columna,$seleccion,$tabla){
		$cdb = new base();
		
		$seleccion_sql		= $seleccion;
		$seleccion_sql[] 	= "id";

		$limitantes[] 	= array("",$columna,"like","%".$texto."%");
		$limitantes[] 	= array("and","estatus","!=","0");
		$tabla			= array($tabla);
		$respuesta 		= $cdb->seleccionar($seleccion_sql,$limitantes,$tabla);

		if($respuesta['codigo']==1){
			$mensaje = "";
			for($i=0;$i<count($respuesta['mensaje']);$i++){
				$mensaje .= "<div class=\"linea_busqueda\">";
				$mensaje .= "<label class=\"cod\">".$respuesta['mensaje'][$i]['id']."</label>";
				$mensaje .= "<label class=\"texto\">";
				for($j=0;$j<count($seleccion);$j++)
					$mensaje .= "<label>".$respuesta['mensaje'][$i][$seleccion[$j]]."</label>";	
				$mensaje .="</label></div>";
			}
			$respuesta = array("codigo"=>"1","mensaje"=>$mensaje);
		}
		
		return $respuesta;
	}
?>