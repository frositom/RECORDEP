<?php
date_default_timezone_set('America/Guatemala');
include_once("html_fns.php");
	
	// ALERTS
	function html_alert_seguridad($valor){
		
		$salida = "";
		
		if($valor == 1){  // alerta de contrase�a invalida
			$salida.= "<div class='alert danger danger'>";
			$salida.= "	<button type='button' id='btn_alert' class='close' data-dismiss='alert'>&times;</button>";
			$salida.= "<strong>Usuario</strong> y/o <strong>Contrase�a</strong> inv�lida, intenta de nuevo";
			$salida.= "</div>";
			
		}else if($valor == 2){  // info al bloquear cuenta
			//modal header//
			$salida.=		"<div class='modal-header'>";
			$salida.=			"<h3 id='myModalLabel' class='warning'>Alerta...</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>Usted excedi� el l�mite de intentos,</br> la cuenta ha sido <strong>Bloqueada</strong> por su seguridad </br> P�ngase en contacto con el Administrador!!!</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar'></input>";
			$salida.=		"</div>";
		}else if($valor == 3){  // info al bloquear cuenta
			//modal header//
			$salida.=		"<div class='modal-header'>";
			$salida.=			"<h3 id='myModalLabel' class='info'>Informaci�n...</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>Su cuenta se encuentra <strong>bloqueada</strong></br> P�ngase en contacto con el Administrador!!!</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar'></input>";
			$salida.=		"</div>";
		}
		return $salida;
	}
	
	// function en_tramite($oficina){
		// $ClsRec= new ClsRecibe();
		// $result = $ClsRec->get_tramite_oficina($oficina);
		// echo $result;
		// if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			// foreach($result as $row){
				// $pendientes=$row['tramite'];
				// if($pendientes>0){
					// $salida.="<a><span class='badge badge-info pull-right'>".$pendientes."</span>En tr�mite &nbsp </a>";
					// }else{
					// $salida.="<a><span class='badge badge-info pull-right'>".$pendientes."</span>En tr�mite &nbsp </a>";
				// }
			// }
		// }
		// return $salida;
	// }
?>