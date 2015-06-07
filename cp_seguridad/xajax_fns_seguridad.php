<?php
include_once('html_fns_seguridad.php');
//inclu?s la clase ajax
require ('../xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 

session_start();
$usu_codigo					=	$_SESSION["usu_codigo"];
$gra_descripcion			=	$_SESSION["gra_desc_md"];
$emp_codigo					=	$_SESSION["gra_codigo"];
$usu_nombres				=	$_SESSION["usu_nombres"];
$usu_apellidos				=	$_SESSION["usu_apellidos"];
$usu_usuario					=	$_SESSION["usu_usuario"];
$usu_nivel						=	$_SESSION["usu_nivel"];

	// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	//Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  funciones para la tabla inv_seguridad  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	//Xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

	function Buscar_Seguridad($gra, $nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		
		
		$result = $ClsSeg->get_seguridad($gra, $nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit);
		
		
		// $respuesta->alert($result);
		if(is_array($result)){
			$cont = 0;
			foreach($result as $row){
				
				$codigo = $row['seg_codigo'];		//asigno el codigo 
				$grado = $row['seg_grado'];		//asigno el código del grado 
				$nombres = $row['seg_nombres'];		//asigno los nombres
				$apellidos = $row['seg_apellidos'];		//asigno los apellidos
				$puesto = $row['seg_puesto'];		//asigno los apellidos
				$usuario = $row['seg_usuario'];		//asigno el usuario
				$passwd = $row['seg_pass'];		//asigno la contraseña
				$nivel = $row['seg_nivel'];		//asigno el nivel de seguridad
				$seguridad = $row['seg_seguridad'];		//asigno la seguridad
				$habilita = $row['seg_habilita'];		//asigno si habilita el cambio de contraseña al ingresar
				$situacion = $row['seg_situacion'];		//asigno la situacion
				
				
				$cont++;
			}
			// $respuesta->alert($cont);
			if($cont == 1){ // si el contador viene igual a 1 le coloco los valores a los campos
				$respuesta->assign("seg_codigo","value",$codigo);  // campo de los nombres
				$respuesta->assign("cmb_seg_grados","value",$grado);  // campo de los nombres
				$respuesta->assign("seg_nombres","value",$nombres);  // campo de los nombres
				$respuesta->assign("seg_apellidos","value",$apellidos);  // campo de los apellidos
				$respuesta->assign("seg_puesto","value",$puesto);  // campo de los apellidos
				$respuesta->assign("seg_usuario","value",$usuario);  // campo del usuario
				$respuesta->assign("seg_pass","value",$passwd);  // campo del usuario
				$respuesta->assign("cmb_seg_nivel","value",$nivel);  // campo del nivel
				
				if($seguridad==0){ // campo de seguridad 
					$respuesta->script("document.getElementById('seg_seguridad_si').checked = true;");
				}else if($seguridad==1){
					$respuesta->script("document.getElementById('seg_seguridad_no').checked = true;");
				}
				
				if($habilita==1){ // campo de habilitar que pida contraseña al ingresar
					$respuesta->script("document.getElementById('seg_habilita').checked = true;");
				}else if($habilita==0){
					$respuesta->script("document.getElementById('seg_habilita').checked = false;");
				}
				
				$respuesta->assign("seg_situacion","value",$situacion);  // campo de situacion
				
				$contenido = tabla_seguridad($gra,$nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit);  // asigno la informaci??e la tabla a la variable $contenido
				$respuesta->assign("div_tabla","innerHTML",$contenido);		// la variable respuesta la asigno al Div resultado para que me despliegue la informacion

				
			}else{
				$contenido = tabla_seguridad($gra,$nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit);  // asigno la informaci??e la tabla a la variable $contenido
				$respuesta->assign("div_tabla","innerHTML",$contenido);		// la variable respuesta la asigno al Div resultado para que me despliegue la informacion

				// $respuesta->script("document.getElementById('div_datos').style='display:none'");
				// $respuesta->script("document.getElementById('div_tabla').style='display:display'");
			}
				$respuesta->script("document.getElementById('grabar_seguridad').style='display:none';");  // deshabilito el boton de grabar
				$respuesta->script("document.getElementById('modificar_seguridad').style='display:display';");	//habilito el boton de modificar
				$respuesta->script("document.getElementById('Buscar_seguridad').style='display:none';");
		}else{
			$respuesta->alert("No se reportan datos en la busqueda");	// si no trae datos levanto una alerta.
		}
		
		return $respuesta;
	}

	function Trae_Datos_Sel($cod){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		
		$result = $ClsSeg->get_seguridad_sel($cod);
		// $respuesta->alert($cod);
		if(is_array($result)){
			$cont = 0;
			foreach($result as $row){
				
				$codigo = $row['seg_codigo'];		//asigno el codigo 
				$grado = $row['seg_grado'];
				$nombres = $row['seg_nombres'];		//asigno los nombres
				$apellidos = $row['seg_apellidos'];		//asigno los apellidos
				$puesto = $row['seg_puesto'];		//asigno los apellidos
				$usuario = $row['seg_usuario'];		//asigno el usuario
				$passwd = $row['seg_pass'];		//asigno la contraseña
				$nivel = $row['seg_nivel'];		//asigno el nivel de seguridad
				$seguridad = $row['seg_seguridad'];		//asigno la seguridad
				$habilita = $row['seg_habilita'];		//asigno si habilita el cambio de contraseña al ingresar
				$situacion = $row['seg_situacion'];		//asigno la situacion
				
				
				$respuesta->assign("seg_codigo","value",$codigo);  // campo de los nombres
				$respuesta->assign("cmb_seg_grados","value",$grado);  // campo de los nombres
				$respuesta->assign("seg_nombres","value",$nombres);  // campo de los nombres
				$respuesta->assign("seg_apellidos","value",$apellidos);  // campo de los apellidos
				$respuesta->assign("seg_puesto","value",$puesto);  // campo de los apellidos
				$respuesta->assign("seg_usuario","value",$usuario);  // campo del usuario
				$respuesta->assign("seg_pass","value",$passwd);  // campo del usuario
				$respuesta->assign("cmb_seg_nivel","value",$nivel);  // campo del nivel
				
				if($seguridad==0){ // campo de seguridad 
					$respuesta->script("document.getElementById('seg_seguridad_si').checked = true;");
					}else if($seguridad==1){
					$respuesta->script("document.getElementById('seg_seguridad_no').checked = true;");
				}
				
				if($habilita==1){ // campo de habilitar que pida contraseña al ingresar
					$respuesta->script("document.getElementById('seg_habilita').checked = true;");
					}else if($habilita==0){
					$respuesta->script("document.getElementById('seg_habilita').checked = false;");
				}
				
				$respuesta->assign("seg_situacion","value",$situacion);  // campo de situacion
				// $respuesta->alert($usuario);
				$contenido = tabla_seguridad('','','','',$usuario,'','','','');  // asigno la informaci??e la tabla a la variable $contenido
				$respuesta->assign("div_tabla","innerHTML",$contenido);		// la variable respuesta la asigno al Div resultado para que me despliegue la informacion

				$respuesta->script("document.getElementById('grabar_seguridad').style='display:none';");  // deshabilito el boton de grabar
				$respuesta->script("document.getElementById('modificar_seguridad').style='display:display';");	//habilito el boton de modificar
				$respuesta->script("document.getElementById('Buscar_seguridad').style='display:none';");

				// $respuesta->script("document.getElementById('div_datos').style='display:display'");
				// $respuesta->script("document.getElementById('div_tabla').style='display:none'");
			}
		}
		
		return $respuesta;
	}

	
// METODO PARA VERIFICAR QUE EL USUARIO ESTE DISPONIBLE ANTES DE MODIFICAR DATOS DEL USUARIO
function Verificar_Usuario_Modificar($cod,$gra,$nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit,$user){
	$respuesta = new xajaxResponse();
	$ClsSeg = new ClsSeguridad();
	
	$result = $ClsSeg->verifica_usuario_mod($cod,$usu);
	// $respuesta->alert($result);
	if (is_array($result)) {
		
		$respuesta->call('xajax_alert_seguridad', 1);
		// $respuesta->script("document.getElementById('img_old_pass_ok').style='display:none'");
		// $respuesta->script("document.getElementById('font_img_old_pass_ok').style='display:none'");
		
		// $respuesta->script("document.getElementById('img_old_pass_no').style='display:display'");
		// $respuesta->script("document.getElementById('font_img_old_pass_no').style='display:display'");
		
		// $respuesta->script("document.getElementById('div_tabla').style='display:none'");
		
		}else{
			
			$sql = $ClsSeg->update_seguridad($cod,$gra, $nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit,$user);
			
			$rs = $ClsSeg->exec_sql($sql);
		
			if($rs==1){
				
				$respuesta->call('xajax_alert_seguridad', 3);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
				
				$respuesta->script("xajax_Limpiar_Seguridad()");
			}else{
				$respuesta->alert("Error de Ejecucion del Query");
			}
	}
	
	return $respuesta;
}

// METODO PARA VERIFICAR QUE EL USUARIO ESTE DISPONIBLE ANTES DE MODIFICAR DATOS DEL USUARIO
function Verificar_Usuario_Modificar_Pass($cod,$gra,$nom,$ape,$pue,$usu,$pas,$niv,$seg,$hab,$sit,$user){
	$respuesta = new xajaxResponse();
	$ClsSeg = new ClsSeguridad();
	$passwd=sha1(md5($pas));
	$result = $ClsSeg->verifica_usuario_mod($cod,$usu);
	// $respuesta->alert('entra al ajax');
	if (is_array($result)) {
		
		$respuesta->call('xajax_alert_seguridad', 1);
		// $respuesta->script("document.getElementById('img_old_pass_ok').style='display:none'");
		// $respuesta->script("document.getElementById('font_img_old_pass_ok').style='display:none'");
		
		// $respuesta->script("document.getElementById('img_old_pass_no').style='display:display'");
		// $respuesta->script("document.getElementById('font_img_old_pass_no').style='display:display'");
		
		// $respuesta->script("document.getElementById('div_tabla').style='display:none'");
		
		}else{
			
			$sql = $ClsSeg->update_seguridad_pass($cod,$gra,$nom,$ape,$pue,$usu,$passwd,$niv,$seg,$hab,$sit,$user);
			// $respuesta=$sql;
			// return $respuesta;
			$rs = $ClsSeg->exec_sql($sql);
			if($rs==1){
				
				$respuesta->call('xajax_alert_seguridad', 3);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
				
				$respuesta->script("xajax_Limpiar_Seguridad()");
			}else{
				$respuesta->alert("Error de Ejecucion del Query");
			}
	}
	
	return $respuesta;
}
	
	// FUNCION PARA ELIMINAR UN REGISTRO O UN USUARIO DE LA TABLA cor_corr_seg
	function Verificar_Seguridad($usu,$pas){
		$respuesta = new xajaxResponse();
		// $ClsUsu = new ClsSeguridad();
		// $result = $ClsUsu->get_login($usu,$pass);
		$respuesta->alert("ENTRO A XAJAX!!!");
		// if (is_array($result)) {
			// $respuesta->script("document.getElementById('f1').submit();'");
		// }else{
			// $respuesta->script("document.getElementById('msg_invalido').removeAttribute('disabled');'");
		// }
		return $respuesta;
	}

	// FUNCION PARA GRABAR UN NUEVO USUARIO
	function Grabar_Seguridad($gra,$nom,$ape,$pue,$usu,$pas,$niv,$seg,$hab,$sit,$user){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		$cod = $ClsSeg->max_seguridad();
		$passwd=sha1(md5($pas));
		$sql = $ClsSeg->insert_seguridad($cod,$gra,$nom,$ape,$pue,$usu,$passwd,$niv,$seg,$hab,$sit,$user);
		// $respuesta->alert($sql);
			
		$rs = $ClsSeg->exec_sql($sql);
		
		if($rs==1){
			$respuesta->alert("Usuario Grabado Satisfactoriamente!!!");
			$respuesta->script("xajax_Limpiar_Seguridad()");
			
		}else{
			$respuesta->alert("Error de Ejecucion del Query");
		}
		return $respuesta;
	}
	


	// FUNCION PARA MODIFICAR LA CONTRASEÑA EN LA TABLA inv_seguridad
	function Cambia_Pass($cod_user,$pass,$user){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		$passwd=sha1(md5($pass));
		$sql = $ClsSeg->actualiza_pass_seguridad($cod_user,$passwd,$user);
		$rs = $ClsSeg->exec_sql($sql);
		if($rs==1){
			$respuesta->alert("La contraseña fue modificada con éxito !!!");
			$_SESSION['pass']='';
			unset($_SESSION['pass']);
			$_SESSION['pass']=$passwd;
			$respuesta->script("document.getElementById('f_cambia_pass').submit();");
			
		}else{
			$respuesta->alert("Error de Ejecucion del Query");
		}
		
		return $respuesta;
	}





	// FUNCION PARA LIMPIAR EL FORMULARIO DE SEGURIDAD
	function Limpiar_Seguridad(){
		$respuesta = new xajaxResponse();
		
		$respuesta->assign("seg_codigo","value","");
		$respuesta->assign("cmb_seg_grados","value","");
		$respuesta->assign("seg_nombres","value","");
		$respuesta->assign("seg_apellidos","value","");
		$respuesta->assign("seg_puesto","value","");
		$respuesta->assign("seg_usuario","value","");
		$respuesta->assign("seg_pass","value","");
		$respuesta->assign("cmb_seg_nivel","value","0");
		$respuesta->assign("seg_situacion","value","1");
		$respuesta->script("document.getElementById('seg_seguridad_si').checked = true;");
		$respuesta->script("document.getElementById('seg_habilita').checked = false;");
		
		// $respuesta->script("document.getElementById('div_datos').style='display:display'");
		// $respuesta->script("document.getElementById('div_tabla').style='display:none'");
		
		$contenido = tabla_seguridad($gra,$nom,$ape,$pue,$usu,$niv,$seg,$hab,$sit);  // asigno la informaci??e la tabla a la variable $contenido
		$respuesta->assign("div_tabla","innerHTML",$contenido);		// la variable respuesta la asigno al Div resultado para que me despliegue la informacion

		
		$respuesta->script("document.getElementById('img_old_pass_ok').style='display:none'");
		$respuesta->script("document.getElementById('font_img_old_pass_ok').style='display:none'");
		$respuesta->script("document.getElementById('img_old_pass_no').style='display:none'");
		$respuesta->script("document.getElementById('font_img_old_pass_no').style='display:none'");
		
		$respuesta->script("document.getElementById('modificar_seguridad').style='display:none';");  // deshabilito el boton de grabar
		$respuesta->script("document.getElementById('grabar_seguridad').style='display:display';");	//habilito el boton de modificar
		$respuesta->script("document.getElementById('Buscar_seguridad').style='display:display';");
		$respuesta->script("document.getElementById('btn_alert').click();");
		return $respuesta;
	}

	
		// METODO PARA VERIFICAR QUE EL USUARIO NO SE REPITA ANTES DE GUARDAR
		
		function Check_User($usu){
			$respuesta = new xajaxResponse();
			$ClsSeg = new ClsSeguridad();
			
			$result = $ClsSeg->verifica_usuario($usu);
			if (is_array($result)) {
				
				$respuesta->call('xajax_alert_seguridad', 1);
				
			}else{
				$respuesta->script("document.getElementById('btn_alert').click();");
				
			}
			return $respuesta;
		}
		
		
	// METODO PARA VERIFICAR QUE EL USUARIO PARA MODIFICAR

	function Check_User_Mod($usu,$cod){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		// $respuesta->alert('entra a xajax');
		$result = $ClsSeg->verifica_usuario_mod($cod,$usu);
		if (is_array($result)) {
			// $respuesta->alert('a tirar mensaje');
			$respuesta->call('xajax_alert_seguridad', 1);
			
			}else{
				// $respuesta->alert('no encontro');
			$respuesta->script("document.getElementById('btn_alert').click();");
			
		}
		return $respuesta;
	}

		// METODO PARA VERIFICAR QUE EL USUARIO NO SE REPITA ANTES DE GUARDAR UN USUARIO NUEVO
	function Verificar_Usuario_Grabar($gra,$nom,$ape,$pue,$usu,$pas,$niv,$seg,$hab,$sit,$user){
		$respuesta = new xajaxResponse();
		$ClsSeg = new ClsSeguridad();
		
			$result = $ClsSeg->verifica_usuario($usu);
			
			if (is_array($result)) {
				$respuesta->alert('usuario ya existe');
				// $respuesta->call('xajax_alert_seguridad', 1);
				// -----------------------------$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
				
				// $respuesta->script("document.getElementById('img_old_pass_ok').style='display:none'");
				// $respuesta->script("document.getElementById('font_img_old_pass_ok').style='display:none'");
				
				// $respuesta->script("document.getElementById('img_old_pass_no').style='display:display'");
				// $respuesta->script("document.getElementById('font_img_old_pass_no').style='display:display'");
				
				// //--------------------------------$respuesta->script("document.getElementById('div_tabla').style='display:none'");
				
			}else{
				
				$cod = $ClsSeg->max_seguridad();
				
				$passwd=sha1(md5($pas));
				
				$sql = $ClsSeg->insert_seguridad($cod,$gra,$nom,$ape,$pue,$usu,$passwd,$niv,$seg,$hab,$sit,$user);
				$rs = $ClsSeg->exec_sql($sql);
				
				// $respuesta->alert($rs);
				// $respuesta->alert("$sql");
					
				if($rs==1){
				//$respuesta->alert("Usuario Grabado Satisfactoriamente!!!");
					$respuesta->call('xajax_alert_seguridad', 2);
					$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
					
					$respuesta->script("xajax_Limpiar_Seguridad()");
					
				}else{
					$respuesta->alert("Error de Ejecucion del Query");
				}
			}
		
		return $respuesta;
	}
	
	
	
		// FUNCION PARA ELIMINAR UN REGISTRO O UN USUARIO DE LA TABLA cor_corr_seg
	function Check_Old_Pass($pass,$old){
		$respuesta = new xajaxResponse();
		$passwd=sha1(md5($old));
		// $respuesta->alert("entro a xajax");
		
		if ($pass==$passwd) {
			$respuesta->script("document.getElementById('img_old_pass_ok').style='display:display'");
			$respuesta->script("document.getElementById('img_old_pass_no').style='display:none'");
			
			
		}else{
			$respuesta->script("document.getElementById('img_old_pass_ok').style='display:none'");
			$respuesta->script("document.getElementById('img_old_pass_no').style='display:display'");
			
		}
		return $respuesta;
	}

	///////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////// ALERT SEGURIDAD /////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////

	function alert_seguridad($valor){
	$respuesta = new xajaxResponse();
	
	$alert_articulo = html_alert_seguridad($valor);
		if($valor == 2){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else if($valor == 3){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else if($valor == 5){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else if($valor == 6){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else if($valor == 10){
			$respuesta->assign("alert_modal","innerHTML",$alert_articulo);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_articulo);
		}
		return $respuesta;
	}

	// DECLARACIONES DE FUNCIONES PARA LA TABLA seguridad
	$xajax->register(XAJAX_FUNCTION, "Limpiar_Seguridad");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Grabar_Seguridad");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Verificar_Seguridad");
	$xajax->register(XAJAX_FUNCTION, "Verificar_Usuario_Grabar");
	$xajax->register(XAJAX_FUNCTION, "Verificar_Usuario_Modificar");
	$xajax->register(XAJAX_FUNCTION, "Verificar_Usuario_Modificar_Pass");
	$xajax->register(XAJAX_FUNCTION, "Verificar_Usuario");
	$xajax->register(XAJAX_FUNCTION, "Buscar_Seguridad");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Trae_Datos_Sel");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Modificar_Seguridad");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Modificar");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "alert_seguridad");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Check_User");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Check_User_Mod");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Check_Old_Pass");   // siempre hay que declarar las funciones
	$xajax->register(XAJAX_FUNCTION, "Cambia_Pass");   // siempre hay que declarar las funciones

//El objeto xajax tiene que procesar cualquier petición??	
	$xajax->processRequest();
	
?>