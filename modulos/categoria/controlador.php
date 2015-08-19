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
				$respuesta 	= traer_formulario($codigo,$estructura,array($tabla));
				break;
			default:
				$respuesta = array("codigo"=>"0","mensaje"=>"Error interno");
				break;
		}
		echo json_encode($respuesta);
	}
?>