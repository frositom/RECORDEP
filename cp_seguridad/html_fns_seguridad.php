<?php
	include_once("../html_fns.php");
	
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    FUNCIONES PARA LA TABLA DE CORR_SEG         XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// FUNCION PARA LLENAR LA TABLA DE CORR_SEG
	function tabla_seguridad($gra, $nom, $ape, $pue,$usu,$niv,$seg,$hab,$sit){
		$ClsSeg= new ClsSeguridad();
		
		$result = $ClsSeg->get_seguridad($gra, $nom, $ape, $pue,$usu,$niv,$seg,$hab,$sit);
		// $salida=$result;		// return $salida;
		
		$i=1;
		// $salida='cantidad del result='.count($result);
		// return $salida;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			// $salida = "<h4 align='center'>usuario=".$usu."</h4>";
			$salida="<table class='table table-hover table-bordered table-condensed ' align='center'>";			// $salida="<table class='table '>";
			$salida.= "<tr>";
				$salida.= "<td style='width:25px' class='text-center'><strong>No.</strong></td>";
				$salida.= "<td class='text-center'><strong>Nombres y Apellidos</strong></td>";
				// $salida.= "<td class='text-center'><strong>Usuario</strong></td>";
				$salida.= "<td class='text-center'><strong>Nivel Seg.</strong></td>";
				$salida.= "<td class='text-center'><strong>Situación</strong></td>";
				$salida.= "<td  class='text-center'><strong>Ver</strong></td>";
			$salida.= "</tr>";
			foreach($result as $row){
				$sn=$row['seg_nivel'];
				if($sn==1){
					$nivel='Administrador';
				}else if($sn==2){
					$nivel='Oficial';
				}else if($sn==3){
					$nivel='Galonista';
				}else if($sn==4){
					$nivel='Cadete';
				}
				
				$s=$row['seg_situacion'];
				if($s==1){
					$sit='Activo';
				}else{
					$sit='Inactivo';
				}
				$salida.= "<tr>";
					$salida.= "<td>".$i."</td>";
					$salida.= "<td>".TRIM($row['seg_apellidos']).", ".TRIM($row['seg_nombres'])."</td>";
					// $salida.= "<td>".$row['seg_usuario']."</td>";
					$salida.= "<td>".$nivel."</td>";
					$salida.= "<td>".$sit."</td>";																										// <a class="btn btn-mini" href="#"><i class="icon-star"></i> Star</a>
					$salida.= "<td class='text-center' ><a class='btn btn-mini' onclick='buscar_seguridad_sel(".$row['seg_codigo'].")' value='Modificar'><i class='icon-search'></i></a></td>";					//$salida.= "<td class='text-center' style='width:25px'><button type='btn' class='btn btn-inverse' style='width:30px; height:30px' onclick='buscar_seguridad_sel(".$row['seg_codigo'].")' value='Modificar'><i class='icon-search icon-white'></i></button></td>";
				// $salida.= "<td class='text-center'><button type='btn' class='btn btn-danger' style='width:30px; height:30px' onclick='xajax_Eliminar_Parte(".$row['par_codigo'].")' value='Eliminar'><i class='icon-remove '></i></button></td>";
				$salida.= "</tr>";
				$i++;
			}
			$salida.="</table>";
			// $salida.="<div align='center'></br><input class='btn input-mini btn-inverse' onclick='limpiar_seguridad()' value='Limpiar'></input></br></br></div>";
			
		}else{
			$salida= "<h4 align='center'>No se encontraron registros en la busqueda</h4>";
		}
		return $salida;
	}
	

	function tabla_corrseg_mod($ofi,$pla,$niv){
		$ClsCor= new ClsCorrseg();
		
		$result = $ClsCor->get_corrseg('',$ofi,$pla,$niv);
		
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			$salida = "<h4 align='center'>Registro de Usuarios de Correspondencia</h4>";
			$salida.="<table class='table table-striped table-bordered table-condensed' style='background-color:#D8D8D8; width:100%' align='center'>";
			$salida.= "<tr>";
				$salida.= "<td style='width:10%' class='text-center'><strong>No.</strong></td>";
				$salida.= "<td class='text-center'><strong>Catálogo</strong></td>";
				$salida.= "<td class='text-center'><strong>Grado</strong></td>";
				$salida.= "<td class='text-center'><strong>Nombres </strong></td>";
				$salida.= "<td class='text-center'><strong>Dependencia</strong></td>";
				$salida.= "<td class='text-center'><strong>Oficina</strong></td>";
				$salida.= "<td class='text-center'><strong>Plaza</strong></td>";
				$salida.= "<td class='text-center'><strong>Nivel Seg.</strong></td>";
				$salida.= "<td  class='text-center'><img src='../img/database-process.gif'></img ></td>";
			$salida.= "</tr>";
			foreach($result as $row){
				$salida.= "<tr>";
					$salida.= "<td>".$i."</td>";
					$salida.= "<td>".$row['seg_usuario']."</td>";
					$salida.= "<td>".TRIM($row['gra_desc_ct'])."</td>";
					$salida.= "<td>".TRIM($row['per_ape1'])." ".TRIM($row['per_ape2']).", ".TRIM($row['per_nom1'])."</td>";
					$salida.= "<td>".TRIM($row['dep_desc_ct'])."</td>";
		$salida.= "<td>".TRIM($row['of_descripcion'])."</td>";
				$salida.= "<td>".$row['seg_plaza']."</td>";
				$salida.= "<td>".$row['seg_nivel']."</td>";
				$salida.= "<td class='text-center' style='width:25px'><button type='btn' class='btn btn-inverse' style='width:30px; height:30px' onclick='buscar_emp_sel(".$row['emp_codigo'].")' value='Modificar'><i class='icon-pencil icon-white'></i></button></td>";
				// $salida.= "<td class='text-center'><button type='btn' class='btn btn-danger' style='width:30px; height:30px' onclick='xajax_Eliminar_Parte(".$row['par_codigo'].")' value='Eliminar'><i class='icon-remove '></i></button></td>";
				$salida.= "</tr>";
				$i++;
			}
			$salida.="</table>";
			
			}else{
			$salida= "<h4 align='center'>No se encontraron registros en la busqueda</h4>";
		}
		return $salida;
	}
	
	
	// METODO PARA CAMBIAR EL FORMATO DE FECHA Y HORA
	function cambia_fecha($fecha){
		if(empty($fecha)){
			return "";
			}else{
			$var = explode(' ',$fecha);
			$fecha=explode('-',$var[0]);
			$fec= $fecha[2].'-'.$fecha[1].'-'.$fecha[0].' '.$var[1];
			return $fec;
		}
	}
	
	//<!--================== FUNCIÓN PARA LLENAR EL COMBO DE GRADOS ====================================-->
	function combo_grados(){
		$ClsSeg= new ClsSeguridad();
		
		$result = $ClsSeg->get_grados();

		// return $result;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			$salida = "<select name='cmb_seg_grados' id='cmb_seg_grados' class='span11' >";
			$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$salida.= "<option  value=".$row['gra_codigo'].">".$row['gra_desc_lg']."</option>";
			}
			$salida.="</select>";
			
			}else{
			$salida= "No se encontraron registros con estos parametros";
		}
		return $salida;
	}

	
   // ALERTS
function html_alert_seguridad($valor){
	
	$salida = "";
	
	if($valor == 1){
		$salida.= "<div class='alert alert-danger'>";
		$salida.= "	<button type='button' id='btn_alert'class='close' data-dismiss='alert'>&times;</button>";
		$salida.= "	Ya existe este nombre de <strong>Usuario</strong>, vuelve a intentarlo ";
		$salida.= "</div>";
		
	}else if($valor == 2){  // info al guardar un usuario con exito
		//modal header//
		$salida.=		"<div class='modal-header'>";
		$salida.=			"<h3 id='myModalLabel' class='info'>Información...</h3>";
		$salida.=		"</div>";
		//modal body//
		$salida.=		"<div class='modal-body'>";
		$salida.=			"<p class='text-left'>El <strong>Usuario</strong> fue creado con Éxito</p>";
		$salida.=		"</div>";
		//modal footer//
		$salida.=		"<div class='modal-footer'>";
		$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar' onclick='reload();'></input>";
		$salida.=		"</div>";
	}else if($valor == 3){  // info al guardar un usuario con exito
	//modal header//
	$salida.=		"<div class='modal-header'>";
	$salida.=			"<h3 id='myModalLabel' class='info'>Información...</h3>";
	$salida.=		"</div>";
	//modal body//
	$salida.=		"<div class='modal-body'>";
	$salida.=			"<p class='text-left'>El Usuario se <strong>Modificó</strong> con Éxito</p>";
	$salida.=		"</div>";
	//modal footer//
	$salida.=		"<div class='modal-footer'>";
	$salida.=		"<input class='btn btn-info' type='button' id='btn_alert_modal' data-dismiss='modal' value='Aceptar' onclick='reload();'></input>";
	$salida.=		"</div>";
	}else if($valor == 5){
	//modal header//
	$salida.=		"<div class='modal-header modal-info'>";
	$salida.=			"<h3 id='myModalLabel'>Aviso</h3>";
	$salida.=		"</div>";
	//modal body//
	$salida.=		"<div class='modal-body'>";
	$salida.=			"<p class='text-left'>El Usuario no esta disponible</p>";
	$salida.=		"</div>";
	//modal footer//
	$salida.=		"<div class='modal-footer'>";
	$salida.=		"<button class='btn btn-info' id='btn_alert_modal' data-dismiss='modal' onclick='reload();'>OK</button>";
	$salida.=		"</div>";
}
	return $salida;
}

?>