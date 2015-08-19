<?php
function verificar_texto($texto){
	$texto=str_replace("á", "&aacute;", $texto);
	$texto=str_replace("é", "&eacute;", $texto);
	$texto=str_replace("í", "&iacute;", $texto);
	$texto=str_replace("ó", "&oacute;", $texto);
	$texto=str_replace("ú", "&uacute;", $texto);
	$texto=str_replace("Á", "&Aacute;", $texto);
	$texto=str_replace("É", "&Eacute;", $texto);
	$texto=str_replace("Í", "&Iacute;", $texto);
	$texto=str_replace("Ó", "&Oacute;", $texto);
	$texto=str_replace("Ú", "&Uacute;", $texto);
	$texto=str_replace("ñ", "&ntilde;", $texto);
	$texto=str_replace("Ñ", "&Ntilde;", $texto);
	$texto=str_replace("?", "&#63;", $texto);
	$texto=str_replace("¿", "&iquest;", $texto);
	$texto=str_replace("insert", "",$texto);
	$texto=str_replace("update", "",$texto);
	$texto=str_replace("delete", "",$texto);
	$texto=str_replace("select", "",$texto);
	$texto=str_replace("(", "",$texto);
	$texto=str_replace("'", "",$texto);
	return $texto;
}
function regresar_acento($texto){
	$texto=str_replace("&aacute;", "á", $texto);
	$texto=str_replace("&eacute;", "é", $texto);
	$texto=str_replace("&iacute;", "í", $texto);
	$texto=str_replace("&oacute;", "ó", $texto);
	$texto=str_replace("&uacute;", "ú", $texto);
	$texto=str_replace("&Aacute;", "Á", $texto);
	$texto=str_replace("&Eacute;", "É", $texto);
	$texto=str_replace("&Iacute;", "Í", $texto);
	$texto=str_replace("&Oacute;", "Ó", $texto);
	$texto=str_replace("&Uacute;", "Ú", $texto);
	$texto=str_replace("&ntilde;", "ñ", $texto);
	$texto=str_replace("&Ntilde;", "Ñ", $texto);
	$texto=str_replace("&#63;", "?", $texto);
	$texto=str_replace("&iquest;", "¿", $texto);
	return $texto;
}
?>