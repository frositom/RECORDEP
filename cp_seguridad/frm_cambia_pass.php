<?phpheader('Content-Type: text/html; charset=ISO-8859-1');
include_once("xajax_fns_seguridad.php");
// session_start();
$usu_codigo					=	$_SESSION["usu_codigo"];
$usu_nombres				=	$_SESSION["usu_nombres"];
$usu_apellidos				=	$_SESSION["usu_apellidos"];
$usu_usuario				=	$_SESSION["usu_usuario"];
$usu_nivel					=	$_SESSION["usu_nivel"];
$pass						=	$_SESSION["usu_pass"];
				
if (empty($usu_codigo)){
	header('Location: ../index.php' );
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
		  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		  <!--
	  <link rel="shortcut icon" type='image/x-icon' href='../img/ICONO.png'>
	  -->
	 <link rel="shortcut icon" type='image/x-icon' href='../img/logo_ep.png'>		<title>E. P.</title>
		  <?php $xajax->printJavascript("../xajax"); ?>
       <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
	  <link href="../assets/css/login_cambiacss.css" rel="stylesheet">
	  <script type="text/javascript" src="js/seguridad.js"></script>

    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
      </head>
  <body  style='background-color:#BDBDBD'>
    <div class="container" align='center' >
		
			</br>
		<form class="form-signin"   id='f_cambia_pass' action="../cp_menu/frm_menu.php" method="post" align='center'>
		
		<div>
			<div hidden>
			<input type="text" class="span2" id='seg_pass' value='<?php echo $pass ?>' name='seg_pass'>
			<input type="text" class="span2" id='seg_usuario' value='<?php echo $usu_usuario ?>' name='seg_usuario'>
			
			<input type="text" class="span2" id='seg_usuario_cod' value='<?php echo $usu_codigo ?>' name='seg_usuario_cod'>
			<!-- PARA VALIDAR DE NUEVO EL SUBMIT 
			<input type="text" class="span2" id='pass' value='<?php //echo $pass ?>' name='pass'>
			<input type="text" class="span2" id='usu' value='<?php //echo $usu ?>' name='usu'>
				-->
			</div>
			<h3 class="text-error">Cambiar Constraseña</h3>
			<img src='img/escudo_ep1.png' class='img-rounded' title='Escudo E. P.'></img>
		
			</br>
			<div class='row-fluid'>
				<div class='span10' >
					<input type="password" onkeyup='verifica_passwd();' class="input-block-level span12" id='old_pass' name='old_pass' placeholder="Constraseña Actual">
				</div>
			<!--
				<img id='img_old_pass_ok' style='display:none' src='../img/thick.ico'></img>
				<img id='img_old_pass_no' style='display:none' src='../img/cross.ico'></img>
			-->
			<img id='img_old_pass_ok' style='display:none' src='../img/check.png'></img>
			<img id='img_old_pass_no' style='display:none' src='../img/X.png'></img>
			
				
			</div>
			<div class='row-fluid'>
				<div class='span10' >
					<input type="password" class="input-block-level span12" onkeyup='check_new_pass();' id='new_pass' name='new_pass' placeholder="Nueva Contraseña">
				</div>
			</div>
			<div class='row-fluid'>
				<div class='span10' >
				<input type="password" class="input-block-level span12" onkeyup='check_new_pass();' id='conf_pass' name='conf_pass' placeholder="Conf. Contraseña">
				</div>
				<!--
					<img id='img_conf_pass_ok' style='display:none' src='../img/tick.ico'></img>
					<img id='img_conf_pass_no' style='display:none' src='../img/cross.ico'></img>
				-->
				<img id='img_conf_pass_ok' style='display:none' src='../img/check.png'></img>
				<img id='img_conf_pass_no' style='display:none' src='../img/X.png'></img>
			</div>
		</div>
			
		<div class='row-fluid'>
				<input type='button' class="btn span8 btn-success" onclick='cambia_pass();' value='Guardar'></input>
				<input type='button' class="btn span4 btn-danger" onclick='salir();' href='../cp_login/logout.php' value='Salir'></input>
		</div>  
		
		</form>
    </div> <!-- /container -->
  </body>
	<script type="text/javascript">
		document.getElementById('old_pass').focus();
	</script>
</html>
