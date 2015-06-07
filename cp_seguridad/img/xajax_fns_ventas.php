<?php
	date_default_timezone_set('America/Guatemala');
	include_once('html_fns_ventas.php');
	
	//incluimos la clase ajax
	require ('../xajax/xajax_core/xajax.inc.php');

	//instanciamos el objeto de la clase xajax
	$xajax = new xajax();
	$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
	$xajax->configure('decodeUTF8Input',true);  // para corregir 


	//========================================================================================================
	//============================================START WORK AREA=============================================
	//========================================================================================================

	//=====================================GRABA LA FACTURA==========================OC
	
	function grabar($form){
		$respuesta = new xajaxResponse();
	
		//==========DATOS DEL ENCABEZADO DE FACTURA =========
		$emp_codigo 	= $form['emp_codigo'];
		$ven_factura 	= $form['ven_factura'];
		$ven_cliente 	= $form['ven_cliente'];
		$tipo_pago 		= $form['tipo_pago'];
		$filas_detalle 	= $form['filas_detalle'];
		
		//========VALIDACIONES=====================//
		
		if($emp_codigo == ''){
			$respuesta->script("alert('Error de Base de Datos, Contacte a su Administrador');");
			return $respuesta;
		}
		
		if($ven_cliente == ''){
			$respuesta->script("alert('Ingrese el Numero de Nit del Cliente !!!');");
			$respuesta->script("document.getElementById('ven_cliente').focus();");
			return $respuesta;
		}
		
		if($filas_detalle == '' or $filas_detalle == 0){
			$respuesta->script("alert('Ingrese un Producto !!!');");
			$respuesta->script("document.getElementById('pro_barra').focus();");
			return $respuesta;
		}
		
		
		//===== INSERT ENCABEZADO DE FACTURA ================//
		
		// $emp_codigo		=	$_SESSION["emp_codigo"];
		$ClsVentas = new ClsVentas();
		$ven_codigo = $ClsVentas->max_ven_codigo($emp_codigo);
		$ven_fecha = date("Y/m/d H:i:s");
		$ven_situacion = 1;
		
		//=====AUDITORIA========//
		$aud_user_create = 9;
		$aud_fecha_create = date("Y/m/d H:i:s");
		$aud_user_update  = '';
		$aud_fecha_update = '';
		
		$sql_grabar = $ClsVentas->query_insert_ventas($emp_codigo, $ven_codigo, $ven_factura, $ven_fecha, $ven_cliente, $tipo_pago, $ven_situacion, $aud_user_create, $aud_fecha_create, $aud_user_update, $aud_fecha_update);
		
		$detv_codigo = 1;
		//==========DATOS DEL DETALLE DE FACTURA ============
		for($i = 1; $i <= $filas_detalle; $i++){
			$detv_ven_codigo = $ven_codigo;
					
			$detv_producto 			= $form["pro_barra_$i"];
			$detv_cantidad 			= $form["pro_cantidad_$i"];
			$detv_precio 			= $form["pro_precio_$i"];
			$detv_descuento = 0;
			$detv_subtotal 			= $form["pro_subtotal_$i"];
			$detv_situacion = 1;
			
			$sql_grabar.= $ClsVentas->query_insert_detalle_ventas($emp_codigo, $detv_ven_codigo, $detv_codigo, $detv_producto, $detv_cantidad, $detv_precio, $detv_descuento, $detv_subtotal, $detv_situacion, $aud_user_create, $aud_fecha_create, $aud_user_update, $aud_fecha_update);
			
			$detv_codigo++;
		}
		
		$rs = $ClsVentas->exec_sql($sql_grabar);
		
		if($rs==1){
			$respuesta->alert("Registro Grabado Satisfactoriamente !!!");
			$respuesta->script("location.reload();");
			return $respuesta;
		}else{
			$respuesta->alert("Error de Base de Datos, Contacte a su Administrador !!!");
			$respuesta->script("location.reload();");
			return $respuesta;
		}
		
		return $respuesta;
	}
	
	//======================GRABA NUEVO CLIENTE DESDE VENTAS============================OC
	
	function grabar1($form){
		$respuesta = new xajaxResponse();
	
		$emp_codigo 	= $form['emp_codigo'];
		$usu_codigo 	= $form['usu_codigo'];
		$cli_nit 		= $form['cli_nit'];
		$cli_nombre 	= $form['cli_nombre'];
		$cli_direccion 	= $form['cli_direccion'];
		$cli_telefono	= $form['cli_telefono'];
		$cli_correo 	= $form['cli_correo'];
		
		if($cli_nit == ''){
			$respuesta->script("alert('Ingrese el Numero de Nit del Cliente !!!');");
			$respuesta->script("document.getElementById('cli_nit').focus();");
			return $respuesta;
		}
		if($cli_direccion == ''){
			$respuesta->script("alert('Ingrese la Direccion del Cliente !!!');");
			$respuesta->script("document.getElementById('cli_direccion').focus();");
			return $respuesta;
		}
		if($cli_telefono == ''){
			$respuesta->script("alert('Ingrese el Numero de Telefono del Cliente !!!');");
			$respuesta->script("document.getElementById('cli_telefono').focus();");
			return $respuesta;
		}
		if($cli_correo == ''){
			$respuesta->script("alert('Ingrese lel Correo Electronico del Cliente !!!');");
			$respuesta->script("document.getElementById('cli_correo').focus();");
			return $respuesta;
		}
		
		
		$cli_empresa 	= $emp_codigo;
		//========AUDITORIA==========//
		$cli_situacion 	= 1;
		$aud_user_create 	= $usu_codigo;
		$aud_fecha_create 	= date("Y/m/d H:i:s");
		$aud_user_update 	= '';
		$aud_fecha_update 	= '';
		
		$ClsClientes = new ClsClientes();
		$sql = $ClsClientes->insert_clientes($cli_empresa, $cli_nit, $cli_nombre, $cli_direccion, $cli_telefono, $cli_correo, $cli_situacion, $aud_user_create, $aud_fecha_create, $aud_user_update, $aud_fecha_update);
		
		$rs = $ClsClientes->exec_sql($sql);
		
		if($rs==1){
			$respuesta->alert("Registro Grabado Satisfactoriamente !!!");
			$respuesta->script("$('#div_alert_modal').modal('hide')");
			$ClsVen = new ClsVentas();
			$result = $ClsVen->get_cliente($emp_codigo, $cli_nit);
			
			if(is_array($result)){
				$cont = 0;
				foreach($result as $row){
					
					$nombre 	= $row['cli_nombre'];
					$direccion 	= $row['cli_direccion'];
					
				}
				$contenido = html_cliente($nombre, $direccion);
				$respuesta->assign("ven_cliente", "value", $cli_nit); 
				$respuesta->assign("div_resultado", "innerHTML", $contenido);
				return $respuesta;
			}else{
				$respuesta->alert("Error de Base de Datos, Contacte a su Administrador !!!");
				return $respuesta;
			}
		}else{
			$respuesta->alert("Error de Base de Datos, Contacte a su Administrador !!!");
			return $respuesta;
		}
		
		return $respuesta;
	}
	
	
	//===========================================TRAE CLIENTE===================================OC
	
	function get_cliente($form){
		$respuesta = new xajaxResponse();
		
		$emp_codigo 	= $form['emp_codigo'];
		$usu_codigo 	= $form['usu_codigo'];
		$nit 			= $form['ven_cliente'];
		$cli_empresa 	= $emp_codigo;
		
		$ClsVen = new ClsVentas();
		$result = $ClsVen->get_cliente($cli_empresa, $nit);
		
		if(is_array($result)){
			$cont = 0;
			foreach($result as $row){
				
				$nombre 	= $row['cli_nombre'];
				$direccion 	= $row['cli_direccion'];
				
			}
			$contenido = html_cliente($nombre,$direccion);
			$respuesta->assign("div_resultado","innerHTML",$contenido);
			return $respuesta;
		}else{
			
			$contenido = html_modal_nuevo_cliente($cli_empresa, $usu_codigo);
			$contenido = utf8_decode($contenido);
			$respuesta->assign("div_alert_modal", "innerHTML", "$contenido");
			$respuesta->script("$('#div_alert_modal').modal({ show: true, keyboard: false, backdrop: true, backdrop: 'static' })");
			return $respuesta;
		}
			
		return $respuesta;
	}

	//========================TRAE PRODUCTO Y LO AGREGA AL DETALLE DE VENTA=================OC
	
	function get_producto($form){
		$respuesta = new xajaxResponse();
		
		$emp_codigo		= $form['emp_codigo'];
		$detv_cantidad	= $form['detv_cantidad'];
		$pro_barra		= $form['pro_barra'];
		$filas_detalle	= $form['filas_detalle'];
		$total			= $form['total'];
		
		if($detv_cantidad == '' or $detv_cantidad == 0 or $detv_cantidad == null){
			$detv_cantidad = 1;	
		}
		
		$num = $filas_detalle;
		
		$ClsVen = new ClsVentas();
		$result = $ClsVen->get_producto($emp_codigo, $pro_barra);
		
		if(is_array($result)){
			$cont = 0;
			foreach($result as $row){
				$pro_descripcion 	= $row['pro_descripcion'];
				$pro_precio_venta 	= $row['pro_precio_venta'];
				
				$num++;
				$subtotal		= $pro_precio_venta*$detv_cantidad;
				
				
				$contenido = trae_detalle($num, $pro_barra, $pro_descripcion, $pro_precio_venta, $detv_cantidad, $subtotal);
				$respuesta->assign("div_detalle_venta_$num", "innerHTML", $contenido);

				$total = $total+$subtotal;
				$respuesta->assign("total", "value", "$total");
				$total = "Q. ".$total."";
				$respuesta->assign("div_total", "innerHTML", "$total");
				$respuesta->assign("filas_detalle", "value", "$num");
				$respuesta->assign("pro_barra", "value", '');
				$respuesta->assign("detv_cantidad", "value", '');
				$respuesta->script("document.getElementById('pro_barra').focus();");
				
			}
		}else{
			$respuesta->alert("No existen productos con ese Codigo de Barras...");
		}
		return $respuesta;
	}
	

	//========================================================================================================
	//=================================DECLARACIONES DE FUNCIONES============================================
	//========================================================================================================
	
	$xajax->register(XAJAX_FUNCTION, "get_cliente");
	$xajax->register(XAJAX_FUNCTION, "get_producto");
	$xajax->register(XAJAX_FUNCTION, "grabar");
	$xajax->register(XAJAX_FUNCTION, "grabar1");
	
	//========================================================================================================
	//===========================EL OBJETO XAJAX TIENE QUE PROCESAR CUALQUIER PETICIÓN========================
	//========================================================================================================
	$xajax->processRequest();
	
?>