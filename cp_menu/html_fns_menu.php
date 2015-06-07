<?php
include_once("../html_fns.php");
	
	function pendientes_recibir($oficina){
		$ClsRec= new ClsRecibe();
		$result = $ClsRec->get_pendientes_oficina($oficina);
		// echo $result;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			foreach($result as $row){
				$pendientes=$row['pendientes'];
				
				if($pendientes==0){
					$salida.="<span class='badge pull-right'>".$pendientes."</span>";
				}elseif ($pendientes<10){
					$salida.="<span class='badge badge-info pull-right'>".$pendientes."</span>";
				}elseif($pendientes>10 && $pendientes<=20){
					$salida.="<span class='badge badge-warning pull-right'>".$pendientes."</span>";
				}else{
					$salida.="<span class='badge badge-important pull-right'>".$pendientes."</span>";
				}
			}
		}else{
			$salida.="<span class='badge pull-righ'>0</span>";
		}
		return $salida;
	}
	
	function pendientes($oficina){
		$ClsRec= new ClsRecibe();
		$result = $ClsRec->get_pendientes_oficina($oficina);
		// echo $result;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			foreach($result as $row){
				$pendientes=$row['pendientes'];
				if($pendientes==0){
					$salida.="<a><span class='badge pull-right'>".$pendientes."</span>Pendientes de recibir &nbsp </a>";
					}elseif ($pendientes<=10){
					$salida.="<a href='CPRECIBE/FRMrecibe.php'><span class='badge badge-info pull-right'>".$pendientes."</span>Pendientes de recibir &nbsp </a>";
					}elseif($pendientes>10 && $pendientes<=20){
					$salida.="<a href='CPRECIBE/FRMrecibe.php'><span class='badge badge-warning pull-right'>".$pendientes."</span>Pendientes de recibir &nbsp </a>";
					}else{
					$salida.="<a href='CPRECIBE/FRMrecibe.php'><span class='badge badge-important pull-right'>".$pendientes."</span>Pendientes de recibir &nbsp </a>";
				}
			}
		}
		return $salida;
	}


	function en_tramite($oficina){
		$ClsRec= new ClsRecibe();
		$result = $ClsRec->get_tramite_oficina($oficina);
		// echo $result;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			foreach($result as $row){
				$pendientes=$row['tramite'];
				if($pendientes>0){
					$salida.="<a><span class='badge badge-info pull-right'>".$pendientes."</span>En trámite &nbsp </a>";
					}else{
					$salida.="<a><span class='badge badge-info pull-right'>".$pendientes."</span>En trámite &nbsp </a>";
				}
			}
		}
		return $salida;
	}
	
	
	// ALERTS
	function html_alert_seguridad($valor){
		
		$salida = "";
		
		if($valor == 1){  // alerta de contraseña invalida
			$salida.= "<div class='alert danger danger'>";
			$salida.= "	<button type='button' id='btn_alert' class='close' data-dismiss='alert'>&times;</button>";
			$salida.= "<strong>Usuario</strong> y/o <strong>Contraseña</strong> inválida, intenta de nuevo";
			$salida.= "</div>";
			
		}else if($valor == 2){  // info al bloquear cuenta
			//modal header//
			$salida.=		"<div class='modal-header'>";
			$salida.=			"<h3 id='myModalLabel' class='warning'>Alerta...</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>Usted excedió el límite de intentos,</br> la cuenta ha sido <strong>Bloqueada</strong> por su seguridad </br> Póngase en contacto con el Administrador!!!</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar'></input>";
			$salida.=		"</div>";
		}else if($valor == 3){  // info al bloquear cuenta
			//modal header//
			$salida.=		"<div class='modal-header'>";
			$salida.=			"<h3 id='myModalLabel' class='info'>Información...</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>Su cuenta se encuentra <strong>bloqueada</strong></br> Póngase en contacto con el Administrador!!!</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar'></input>";
			$salida.=		"</div>";
		}
		return $salida;
	}
?>