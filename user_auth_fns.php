<?php


    
   header('Content-Type: text/html; charset=ISO-8859-1');
    
 // crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, 
 // o pasado mediante una cookie. 
  session_start();
  include_once("html_fns.php");

  // verifica si el usuario tiene permisos en la BD's
  function login($usu,$pass){
	$usu = decode($usu);
	$pass = decode($pass);
    $ClsUsu = new ClsSeguridad();   
		$result = $ClsUsu->get_login($usu,$pass);
		echo $result;
		// return $result;
		if (is_array($result)) {
			// echo "<h2>ingreso al array</h2>";
			return true;
		}else {
			return false;
		} 
   }
  
  //verifica si el usuario esta logeado o si no 	
  function check_auth_user(){
    global $_SESSION;
    if (isset($_SESSION['usu']))
    {
	  // echo 'si esta logeado';
	  return true;
    }
    else
    {
      return false;
    }
  }
  
  //quitar caracteres especiales para evitar sql-injection
      function decode($string){ 
		$nopermitidos = array("'",'\\','<','>',"\"","-","%");
		$string = str_replace($nopermitidos, "", $string);
		return $string;
      }   
  
  
  //muestra la pagina de login
function login_form(){
	include_once('cp_menu/xajax_fns_login.php');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		
		<link rel="shortcut icon" type='image/x-icon' href='img/escudo_ep1.png'> 
		<title>Login</title>
		<?php 
			$xajax->printJavascript("xajax/"); 
		?>
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/logincss.css" rel="stylesheet">
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
		<script type="text/javascript" src="cp_seguridad/js/seguridad.js"></script>
	</head>
	<body  style='background-color:#6E6E6E'>
		<div class="container" align='center' >
			</br>
			</br>
			<form class="form-signin" id='formaction' action="cp_login/login.php" method="post" >
				<input id='intentos' name='intentos' type='hidden'></input>
				<input id='user' name='user' type='hidden'></input>
				 <h4 class="form-signin-heading">ESCUELA POLITÉCNICA</h4>
				
					<img src='img/escudo_ep1.png' title='Escudo de la E.P.'></img></br></br>
				
				
				
				
				<!--=============================== alerts ======================================-->
				<div class='row-fluid' id='alert'></div>
				<div class="modal hide fade" id="alert_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
				<!--=============================================================================-->
				
				<h5 id='msg_invalido' style='display:none'><font color='red'>El Usuario o Contraseña no es válido, intenta de nuevo!!!</font></h5>
				<input type="text" class="input-block-level" id='usu' onkeypress='return verifica_numero(event);'  name='usu' placeholder="Usuario"></input>
				<input type="password" class="input-block-level" id='pass' name='pass' placeholder="Contraseña"></input>
				<div class='row-fluid'>
				<input class="btn btn-large  span12 btn-danger"  onclick="xajax_Verificar_Seguridad(xajax.getFormValues('formaction'));" type="button" value='Ingresar'>
				<!-- <input class="btn btn-large  span12 btn-danger"  onclick='aut_user();' type="button" value='Ingresar'></input>   -->
				</div>
			</form>
		</div> <!-- /container -->
	</body>
	<script type="text/javascript">
		document.getElementById('usu').focus();
	</script>
	<script type="text/javascript" src="assets/js/widgets.js"></script>
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap-transition.js"></script>
	<script src="assets/js/bootstrap-alert.js"></script>
	<script src="assets/js/bootstrap-modal.js"></script>
</html>
<?php 
	}
?>
