<?php
date_default_timezone_set('America/Guatemala');
include_once("html_fns_login.php");// include_once("../html_fns.php");
require_once ("xajax/xajax_core/xajax.inc.php");

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
$xajax->configure('decodeUTF8Input',true);

	
	// function Carga_Pendientes($oficina){
		// $respuesta = new xajaxResponse();
		
		// $contenido = pendientes($oficina);    // asigno el la informaci??e la tabla en la variable $contenido
		// $respuesta->assign("resultado_pendientes","innerHTML",$contenido);    // le asigno el contenido a respuesta para insertarlo en el elemento
		
		// $respuesta->script("xajax_Carga_Tramite($oficina);");
		
		// return $respuesta;
	// }
	
	// function Carga_Tramite($oficina){
		// $respuesta = new xajaxResponse();
		
		// $contenido = en_tramite($oficina);    // asigno el la informaci??e la tabla en la variable $contenido
		// $respuesta->assign("resultado_tramite","innerHTML",$contenido);    // le asigno el contenido a respuesta para insertarlo en el elemento
		
		// return $respuesta;
	// }

	//FUNCION PARA ELIMINAR UN REGISTRO O UN USUARIO DE LA TABLA cor_corr_seg
	function Verificar_Seguridad($formaction){
		$respuesta = new xajaxResponse();		$usu= $formaction['usu'];		$pas=$formaction['pass'];		$trae=$formaction['intentos'];		$user=$formaction['user'];		
		$ClsUsu = new ClsSeguridad();		
		$passwd=sha1(md5($pas));
		$result = $ClsUsu->verifica_login($usu,$passwd);
		 // $respuesta->alert($result);		 		 
		if (is_array($result)) {
			foreach($result as $row){
				$seguridad=$row['seg_seguridad'];
			}
			if($seguridad==0){
				$respuesta->script("document.getElementById('formaction').submit();");
			}else{
				$respuesta->call('xajax_Alert_Seguridad', 3);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
				
				    // ------------------------------$respuesta->alert('Su cuenta ha sido bloqueada por seguridad, Pongase en contacto con el Administrador!!');
			}
			
		}else{ 
			if((strlen($user))==0){
				 // ---------------------------$respuesta->alert($pass);
				$lleva=1;
				$respuesta->call('xajax_Alert_Seguridad', 1);
				// ---------------------------$respuesta->script("document.getElementById('msg_invalido').style='display:display'");
				$respuesta->assign("intentos","value",$lleva);
				$respuesta->assign("user","value",$usu);
				$respuesta->assign("usu","value","");
				$respuesta->assign("pass","value","");
			}else if($usu==$user){
				$lleva++;
				$respuesta->call('xajax_Alert_Seguridad', 1);
				     // ----------------------$respuesta->script("document.getElementById('msg_invalido').style='display:display'");
				$respuesta->assign("intentos","value",$lleva);
				$respuesta->assign("usu","value","");
				$respuesta->assign("pass","value","");
			}else{
				$lleva=1;
				$respuesta->call('xajax_Alert_Seguridad', 1);
				 // -------------------------------- $respuesta->script("document.getElementById('msg_invalido').style='display:display'");
				$respuesta->assign("intentos","value",$lleva);
				$respuesta->assign("user","value",$usu);
				$respuesta->assign("usu","value","");
				$respuesta->assign("pass","value","");
				
			}
			
			if ($lleva==6){
				$sql = $ClsUsu->deshabilita_usu($usu);
				
				$rs = $ClsUsu->exec_sql($sql);
				if ($rs==1){
					$respuesta->call('xajax_Alert_Seguridad', 2);
					$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
					
					  // -----------------------------$respuesta->alert('Usted ha excedido el limite de intentos permitidos, Su cuenta ha sido bloqueada temporalmente, Pongase en contacto con el Administrador !!!');
					  // -----------------------------$respuesta->script("document.getElementById('msg_invalido').style='display:none'");
				}
				
			}
		}
		return $respuesta;
	}
	
	

///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// ALERT SEGURIDAD /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

	function Alert_Seguridad($valor){
		$respuesta = new xajaxResponse();
		
		$alert_articulo = html_alert_seguridad($valor);
		if($valor == 2){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else if($valor == 3){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_articulo);
		}
		return $respuesta;
	}

	// $xajax->register(XAJAX_FUNCTION, "Carga_Pendientes");
	// $xajax->register(XAJAX_FUNCTION, "Carga_Tramite");
	$xajax->register(XAJAX_FUNCTION, "Verificar_Seguridad");
	$xajax->register(XAJAX_FUNCTION, "Alert_Seguridad");

//El objeto xajax tiene que procesar cualquier petici??	
	$xajax->processRequest();
	
?>