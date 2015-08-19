<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");

	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/buscador/traer_formulario.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/general/guardar.php");
	//require_once("$_SERVER[DOCUMENT_ROOT]/general/maquetear_busqueda.php");
	//require_once("../general/enviar.php");
	//require_once("traer.php");
	//require_once("")
	
	if(isset($_POST['acc'])){
		$cdb = new base();
		$tabla = "imagen";
		switch ($_POST['acc']) {
			case '1':
				$extension = "";
				$imagen			= $_FILES['archivo'];
				$array_nombre   = explode(".", $imagen['name']);
    			$extension      = end($array_nombre);
				if($extension!=""){
					$datos 				= json_decode($_POST['datos']);
					$datos->estatus 	= '1'; 
					
					$respuesta 		= $cdb->insertar($datos,$tabla,"1");
					if($respuesta['codigo']==1){
						$destino        =  "repositorio/".encripta($respuesta['mensaje']).".".$extension;
						$url            = "http://$_SERVER[HTTP_HOST]/modulos/imagen/".$destino;
						$respuesta = $cdb->actualizar(array("url"=>$url),array(array("","id","=",$respuesta['mensaje'])),$tabla);
						if($respuesta['mensaje']==1){
							if(move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)){
								chmod($destino,0755);
								$respuesta= array("codigo"=>"1", "mensaje"=>"URL imagen: ".$url);
							}else
								$respuesta= array("codigo"=>"0", "mensaje"=>"Error al cargar imagen");	
						}else
							$respuesta['mensaje'] = "Inconsistencias en la imagen por favor actualizar";
					}
				}else
					$respuesta = array("codigo"=>"0","mensaje"=>"No fue enviada imagen al servidor");
				break;
			case '2':
				$extension 		= "";
				@$imagen			= $_FILES['archivo'];
				$array_nombre   = explode(".", $imagen['name']);
    			$extension      = end($array_nombre);
				$datos 			= json_decode($_POST['datos']);
				$codigo 			= $_POST['codigo'];
				if($extension != "")
					$datos->url 	= "http://$_SERVER[HTTP_HOST]/modulos/imagen/repositorio/".encripta($codigo).".".$extension;
				$datos->estatus 	= '1'; 
				
				$limitantes[] 		= array("","id","=",$codigo);
				$respuesta 			= $cdb->actualizar($datos,$limitantes,$tabla);
				if($respuesta['codigo']!=0){
					$destino        =  "repositorio/".encripta($codigo).".".$extension;
					if($extension != ""){
						if(move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)){
							chmod($destino,0755);
							$respuesta= array("codigo"=>"1", "mensaje"=>"Actualizacion Ok");
						}else
							$respuesta= array("codigo"=>"0", "mensaje"=>"Error no se actualizo la imagen");	
					}else{
						$respuesta['mensaje'] = "Actualizacion de datos ok";
					}
				}
				//
				
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

				$seleccion_sql		= array("titulo","id","url");

				$limitantes[] 	= array("","titulo","like","%".$texto."%");
				$limitantes[] 	= array("and","estatus","!=","0");
				$tabla			= array($tabla);
				$respuesta 		= $cdb->seleccionar($seleccion_sql,$limitantes,$tabla);
				if($respuesta['codigo']==1){
					$mensaje = "";
					for($i=0;$i<count($respuesta['mensaje']);$i++){
						$mensaje .= "<div class=\"linea_busqueda\">";
						$mensaje .= "<label class=\"cod\">".$respuesta['mensaje'][$i]['id']."</label>";
						$mensaje .= "<label class=\"texto\">";
						$mensaje .= "<label>".$respuesta['mensaje'][$i]['titulo']."</label>".
									"<label><img src=\"".$respuesta['mensaje'][$i]['url']."\" /></label>";	
						$mensaje .="</label></div>";
					}
					$respuesta = array("codigo"=>"1","mensaje"=>$mensaje);
				}
				break;
			case '5':
				$codigo = $_POST['codigo'];
				$mensaje = "";
				$seleccion_sql	= array("titulo","url");
				$limitantes[] 	= array("","id","=",$codigo);
				$tabla			= array($tabla);
				$respuesta 		= $cdb->seleccionar($seleccion_sql,$limitantes,$tabla);
				if($respuesta['codigo']==1){
					$mensaje .= "<label>".$respuesta['mensaje'][0]['titulo']."</label>".
								"<label><img src=\"".$respuesta['mensaje'][0]['url']."\" /></label>";	
					$respuesta['mensaje'] = $mensaje;
				}
				break;
			case '6':
				$estructura = $_POST['estructura'];
				$codigo		= $_POST['codigo'];
				$respuesta 	= traer_formulario($codigo,$estructura,array($tabla));
				if($respuesta['codigo']==1) {
					$res 		= $cdb->seleccionar(array("url"),array(array("","id","=",$codigo)),array($tabla));
					if($res['codigo']=="1"){
						$respuesta['mensaje'][0]['archivo'] = $res['mensaje'][0]['url']; 
					}
						
				} 
				break;
			default:
				$respuesta = array("codigo"=>"0","mensaje"=>"Error interno");
				break;
		}
		echo json_encode($respuesta);
	}
?>