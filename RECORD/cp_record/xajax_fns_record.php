<?php
// include_once('html_fns_menu.php');
include_once("../html_fns.php");
//inclu?s la clase ajax
// require ('../xajax/xajax_core/xajax.inc.php');
require ('../xajax/xajax_core/xajax.inc.php');
// require ('xajax_core/xajax.inc.php');
// header("Content-Type: text/html;charset=utf-8");

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 

	function Trae_Info_Sel($cat){
	$xajax->register(XAJAX_FUNCTION, "Buscar_Informacion");

//El objeto xajax tiene que procesar cualquier petici�n
	$xajax->processRequest();
	
?>