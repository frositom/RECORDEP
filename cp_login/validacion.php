<?php 
date_default_timezone_set('America/Guatemala');
// include_once("../html_fns.php");
// require_once("../user_auth_fns.php");



	//=========================================================================================================
	//=======================================START WORK AREA===================================================
	//=========================================================================================================
	
	//=======================================CONSULTA LOG()====================================================
	
	function consulta_log(){
		$ClsUsu = new ClsSeguridad();
		//esta funcion verifica con que tipo de navegador pretende utilizar el sistema el Usuario
		check_Nav();

		$usu = $_SESSION['usu'];
		$pass = $_SESSION['pass'];
		// $passwd=sha1(md5($pass));
		
		$result = $ClsUsu->get_login($usu,$pass);
		// echo 'entro a consultar log '.$result;
			if (is_array($result)) {
				foreach ($result as $row){
					
					// NOMBRE DEL USUARIO
					
					$nombres = trim($row['seg_nombres']);
					$apellidos=trim($row['seg_apellidos']);
					
					$nivel = $row['seg_nivel'];	// NIVEL DE PERMISOS DEL USUARIO
					$band = $row['seg_habilita'];	// 1 SI CAMBIA DE PASSWORD AL INGRESAR Y 0 SI NO CAMBIA
					$pass = $row['seg_pass'];	// PASSWORD DEL USUARIO
					$user = $row['seg_usuario'];	// USUARIO QUE SE ESTA LOGEANDO
					$user_cod = $row['seg_codigo'];	// USUARIO QUE SE ESTA LOGEANDO
					$codigo_grado = $row['gra_codigo'];	// USUARIO QUE SE ESTA LOGEANDO
					$nom_grado = $row['gra_desc_md'];	// USUARIO QUE SE ESTA LOGEANDO
				
				
				}
				
					// / USUARIO
				// session_start();
				$_SESSION['usu_usuario'] 	= $user; //USUARIO QUE ESTA LOGEADO
				$_SESSION['usu_nombres'] 	= $nombres; // NOMBRES DEL USUARIO
				$_SESSION['usu_apellidos'] 	= $apellidos; // APELLIDOS DEL USUARIO
				$_SESSION['usu_nivel'] 		= $nivel; // NIVEL DE PERMISOS DEL USUARIO
				$_SESSION['usu_codigo']		= $user_cod;  // CODIGO DEL USUARIO
				$_SESSION['gra_codigo'] 	= $codigo_grado; // CODIGO DEL GRADO  DEL USUARIO
				$_SESSION['gra_desc_md']		= $nom_grado;  // DESCRIPCION DEL GRADO DEL USUARIO
				$_SESSION['usu_pass']		= $pass;  // USUARIO DE LA PERSONA QUE ESTA LOGEADA
				
				
				
				if($band != 0){
					// echo "<h4> CAMBIA DE CONTRASEÑA</h4>";
					redirect('cp_seguridad/frm_cambia_pass.php',0);
					// voy a cambiar mi contrase–a
				}else{
				// echo "<h4> entra al menu</h4>";
					redirect('cp_menu/frm_menu.php',0);
					// voy para el menu
				}
			}else{
				$_SESSION['usu'] = "";
				unset($_SESSION['usu']);
				$_SESSION['pass'] = "";
				unset($_SESSION['pass']);
				session_destroy();
				// echo "<h4> entra al destruir la conexion contraseña </h4>".$pass;
				//redirecciona por medio de $_post
				echo "<form id='f1' name='f1' action='../index.php' method='post'>";
				echo "<script>document.f1.submit();</script>";
				echo "</form>";
			}
	}


	//////// Funciones en PHP que ejecutan script's de Javascript
	function redirect($url,$seconds){
		$ss = $seconds * 1000;
		$comando = "<script>window.setTimeout('window.location=".chr(34).$url.chr(34).";',".$ss.");</script>";
		echo ($comando);
	}

	function check_Nav(){
		$comando = "<script>
		var browser=navigator.appName;
		if (browser == 'Microsoft Internet Explorer'){
			if (confirm('No se puede Ingresar a este Sistema por medio de Internet Explorer, se recomienda utilizar FireFox o algun otro Navegador de Netscape. Desea Descargar FireFox?')){
				window.location.href='logout2.php';
			}else{
				window.location.href='logout.php';
			}
		}
		</script>";
			
		echo ($comando);
	}

?>