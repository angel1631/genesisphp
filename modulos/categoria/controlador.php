<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_lista.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_titulo.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_formulario.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/general/guardar.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/general/maquetear_busqueda.php");
	//require_once("../general/enviar.php");
	//require_once("traer.php");
	//require_once("")
	
	if(isset($_POST['acc'])){
		$cdb = new base();
		$tabla = "categoria";
		switch ($_POST['acc']) {
			case '1':
				$datos 			= json_decode($_POST['datos']);
				$datos->estatus = '1'; 
				$respuesta 		= $cdb->insertar($datos,$tabla,"1");
				if($respuesta['codigo']==1)
					$respuesta['mensaje']="Guardado con exito";
				break;
			case '2':
				$datos 		= json_decode($_POST['datos']);
				$codigo 	= $_POST['codigo'];
				$limitantes[] = array("","id","=",$codigo);
				$respuesta 	= $cdb->actualizar($datos,$limitantes,$tabla);
				if($respuesta['codigo']==1)
					$respuesta['mensaje']="Actualizado con exito";
				break;
			case '3':
				$datos 		= array("estatus"=>"0");
				$codigo 	= $_POST['codigo'];
				$limitantes[] = array("","id","=",$codigo);
				$respuesta 	= $cdb->actualizar($datos,$limitantes,$tabla);
				if($respuesta['codigo']==1)
					$respuesta['mensaje']="Eliminacion correcta";
				break;
			case '4':
				$texto 			= $_POST['texto'];
				$seleccion 		= array("ca.id","ca.titulo","cate.titulo as padre");
				$limitantes[] 	= array("","ca.titulo","like","%".$texto."%");
				$limitantes[] 	= array("and","ca.estatus","!=","0");
				$tabla 			= array("categoria ca LEFT OUTER JOIN categoria cate ON ca.padre = cate.id");
				$respuesta 		= $cdb->seleccionar($seleccion,$limitantes,$tabla);
				if($respuesta['codigo']==1){
					$mensaje = "";
					for($i=0;$i<count($respuesta['mensaje']);$i++){
						$mensaje .= "<div class=\"linea_busqueda\">";
						$mensaje .= "<label class=\"cod\">".$respuesta['mensaje'][$i]['id']."</label>";
						$mensaje .= "<label class=\"texto\">";
							$mensaje .= "<label>".$respuesta['mensaje'][$i]['padre']."</label>";
							$mensaje .= "<label>".$respuesta['mensaje'][$i]['titulo']."</label>";	
						$mensaje .="</label></div>";
					}
					$respuesta = array("codigo"=>"1","mensaje"=>$mensaje);
				}
				break;
			case '5':
				$codigo = $_POST['codigo'];
				$seleccion 		= array("ca.titulo","cate.titulo as padre");
				$limitantes[] 	= array("","ca.id","=",$codigo);
				$limitantes[] 	= array("and","ca.estatus","!=","0");
				$tabla 			= array("categoria ca LEFT OUTER JOIN categoria cate ON ca.padre = cate.id");
				$respuesta 		= $cdb->seleccionar($seleccion,$limitantes,$tabla);
				if($respuesta['codigo']==1)
					$respuesta['mensaje'] = $respuesta['mensaje'][0]['padre']." -- ".$respuesta['mensaje'][0]['titulo']; 
				
				break;
			case '6':
				$estructura = $_POST['estructura'];
				$codigo		= $_POST['codigo'];
				$respuesta 	= traer_formulario($codigo,$estructura,array($tabla));
				break;
			case '7':
				$codigo 	= $_POST['codigo'];
				$respuesta 	= array("codigo"=>"1","mensaje"=>encripta($codigo));
				break;
			default:
				$respuesta = array("codigo"=>"0","mensaje"=>"Error interno");
				break;
		}
		echo json_encode($respuesta);
	}
?>