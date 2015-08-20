<?php 
	require_once("$_SERVER[DOCUMENT_ROOT]/granlibreria.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/modulos/menu/traer_opciones_menu.php");
function encabezado($titulo,$acceso = ""){
	if($acceso ==""){
		$cdb 	= new base();
		$user 	= 1;
		$ahora	= date('Y-m-d H:i:s');
		$navegador 	= $_SERVER['HTTP_USER_AGENT'];
		$datos 	= array("url"=>$titulo,"ip"=>IpReal(),"navegador"=>$navegador,"momento"=>$ahora,"usuario"=>$user);
		$cdb->insertar($datos,"visita","1");
	}
	$documento = "";
	$gestor = fopen("http://$_SERVER[SERVER_NAME]/temas/gtcompra/vista.html","r");
	
	while(!feof($gestor)){
		$documento .= fgets($gestor);
	}
	$notificacion = "<div class=sintio_notificacion><input id=correo_usuario type=text placeholder=\"Inscribete ingresando tu correo\" /><input id=enviar_suscripcion type=button value=Enviar></div>";
	$documento = str_replace("Titulo Pagina", $titulo, $documento);
	$documento = str_replace("Menu Pagina", traer_opciones_menu(), $documento);
	echo $documento;
	if(!isset($_GET['ds']))
		echo $notificacion;
}

function pie(){
	$documento = "";
	$gestor = fopen("http://$_SERVER[SERVER_NAME]/temas/gtcompra/pie.html","r");
	
	while(!feof($gestor)){
		$documento .= fgets($gestor);
	}
	echo $documento;			
}
?>