<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_lista.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_titulo.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_formulario.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/producto/guardar.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/producto/actualizar_multiple.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/genesis_bazar/general/guardar.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/genesis_bazar/general/maquetear_busqueda.php");
	//require_once("../general/enviar.php");
	//require_once("traer.php");
	//require_once("")
	
	if(isset($_POST['acc'])){
		$cdb = new base();
		$tabla = "producto";
		switch ($_POST['acc']) {
			case '1':
				$datos 				= json_decode($_POST['datos']);
				$datos->estatus 	= '1'; 

				$foraneas_multiple 	= $datos->foranea_multiple;
				unset($datos->foranea_multiple);
				$respuesta 		= $cdb->insertar($datos,$tabla,"1");
				if($respuesta['codigo']==1){
					foreach($foraneas_multiple as $valor){
						$tb_foranea = $valor->tb;
						unset($valor->tb);
						$respuesta = guardar_multiple($respuesta['mensaje'],$valor,"producto_imagen");
					}
					if($respuesta['codigo']==1)
						$respuesta['mensaje']="Guardado con exito";
				}
				break;
			case '2':
				$datos 				= json_decode($_POST['datos']);
				$foraneas_multiple = array();
				if(isset($datos->foranea_multiple)){
					$foraneas_multiple 	= $datos->foranea_multiple;
					unset($datos->foranea_multiple);
				}
				$codigo 	= $_POST['codigo'];
				$limitantes[] = array("","id","=",$codigo);
				$respuesta 	= $cdb->actualizar($datos,$limitantes,$tabla);
				if($respuesta['codigo']!=0){
					foreach($foraneas_multiple as $valor){
						$tb_foranea = $valor->tb;
						unset($valor->tb);
						$respuesta = actualizar_multiple($codigo,$valor,"producto_imagen");
					}
					if($respuesta['codigo']!="0"){
						$respuesta['mensaje']="Actualizado con exito";	
					}
				}
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
				$texto = $_POST['texto'];
				$respuesta = traer_lista($texto,"titulo",array("titulo"),$tabla);
				break;
			case '5':
				$codigo = $_POST['codigo'];
				$respuesta = traer_titulo($codigo,$tabla);
				break;
			case '6':
				$estructura = $_POST['estructura'];
				$codigo		= $_POST['codigo'];
				$tablas_foraneas[] 	=  array("principal"=>"producto_imagen","secundaria"=>"imagen");
				$parametros_foraneas = array("col_principal"=>"producto","col_respuesta"=>array("imagen"));
				$respuesta 	= traer_formulario($codigo,$estructura,array($tabla),$tablas_foraneas,$parametros_foraneas);
				break;
			default:
				$respuesta = array("codigo"=>"0","mensaje"=>"Error interno");
				break;
		}
		echo json_encode($respuesta);
	}
?>