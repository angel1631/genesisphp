<?php
	function maquetear_busqueda($respuesta){
		$columnas = count($respuesta[0]);
		$str = "";
		for($x=0;$x<count($respuesta);$x++){
			$str .= "<div class=linea_busqueda >";
			foreach($respuesta[$x] as $valor) {
				if($valor=='id')
					$str .="<label class=identificador >$valor</label>";
				else
					$str .="<label>$valor</label>";
			}
			$str .= "</div>";
		};
		$str = array("codigo"=>"1","mensaje"=>$str);
		return $str;		
	}
?>