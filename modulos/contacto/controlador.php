<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");

	if(isset($_POST['acc'])){
		$cdb = new base();
		$tabla = "negocio";
		$ahora = date('Y-m-d');
		$respuesta 			= array("codigo"=>"0","mensaje"=>"Error al enviar contacto");
		switch ($_POST['acc']) {
			case '1': //enviar
				$datos 				= json_decode($_POST['datos']);
				if($datos->nombre !="" && $datos->consulta !="" && $datos->correo !=""){
					$cabeceras = 'From: web@gtcompra.com' . "\r\n" .'Reply-To: aguillen@solucionclic.com' . "\r\n";
					if(mail('aguillen@solucionclic.com', 'Contacto desde GTcompra', "la persona: ".$datos->nombre.", se contacto por GTcompra \n escribio: ".$datos->consulta."\n\n Telefono: ".$datos->telefono." \n Correo electronico es: ".$datos->correo."", $cabeceras))
						$respuesta = array("codigo"=>"1", "mensaje"=>"Gracias por contactarse");
				}else
					$respuesta['mensaje'] = "No todos los campos fueron ingresados";
				break;
			case '2': //suscribir
				$correo 			= $_POST['correo'];
				if($correo !=""){
					$datos = array("correo"=>$correo,"password"=>md5(""),"nombre"=>"","rol"=>"2","fecha"=>$ahora,"estatus"=>"1");
					$respuesta = $cdb->insertar($datos,"usuario","1");
					if($respuesta['codigo']=="1"){
						$respuesta['mensaje']= "Gracias por suscribirse";
					}
				}else
					$respuesta['mensaje'] = "No todos los campos fueron ingresados";
				break;
			default:
				$respuesta['mensaje'] = "Error interno, no existe opcion";
				break;
		}	
	}else
		$respuesta = array("codigo"=>"0","mensaje"=>"Error interno, no existe opcion");
	echo json_encode($respuesta);
?>