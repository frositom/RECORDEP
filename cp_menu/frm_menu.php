<?php header('Content-Type: text/html; charset=ISO-8859-1');
date_default_timezone_set('America/Guatemala');
require_once('xajax_fns_menu.php');
//     <!--==================   VARIABLES DE SESION  ====================================-->
session_start();
$usu_codigo					=	$_SESSION["usu_codigo"];$usu_grado						=$_SESSION["gra_codigo"];$gra_descripcion			= $_SESSION["gra_desc_md"];
$usu_nombres				=	$_SESSION["usu_nombres"];
$usu_apellidos				=	$_SESSION["usu_apellidos"];
$usu_usuario				=	$_SESSION["usu_usuario"];
$usu_nivel					=	$_SESSION["usu_nivel"];

if (empty($usu_codigo)){
	header('Location: ../index.php' );
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			$xajax->printJavascript("../xajax/");
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<!--==================TITLE====================================-->		<link rel="shortcut icon" type='image/x-icon' href='../img/logo_ep.png'>
		<title>E. P.</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="SEGUSA Application">
		<meta name="author" content="AROC Development Team AOC 2013">
		<!--====================================================================================================-->
		<!--================================= DEFAULT =============================================================-->
		<!--====================================================================================================-->
		<link href="../assets/css/bootstrap.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
		<!--====================================================================================================-->
		<!--================================= MIOS =============================================================-->
		<!--====================================================================================================-->
	</head>
	
<!--====================================== BODY ==========================================================================-->
	<body >
	<div class="container">			<!--			<div class="navbar">			-->			<div class="navbar navbar-fixed-top">			
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="frm_menu.php">Escuela Politécnica</a>						
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
								
								<li class="divider-vertical"></li>
								<!--===============================================================================================================-->
								<!--================================ MENU DE SISTEMAS ===========================================================-->
								<!--===============================================================================================================-->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th-list"></i> Sistemas<b class="caret"></b></a>
										<ul class="dropdown-menu">
										<!--============================ MENU DE SISTEMAS===========================================-->
											<li class="dropdown-submenu">
																										<li><a href="../RECORD/cp_record/frm_record.php"> <i class="icon-folder-open"></i> Record</a></li>													<li><a href="../SANCIONES/index.php"><i class="icon-flag"></i> Sanciones</a></li>													
											</li>
										</ul>
									</li>
								<li class="divider-vertical"></li>																<!--===============================================================================================================-->								<!--================================ PARA PARA EL ADMINISTRADOR ===========================================================-->								<!--===============================================================================================================-->									<li class="dropdown">										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench"></i>  Administrar<b class="caret"></b></a>										<ul class="dropdown-menu">										<!--============================ MENU DE ADMINISTRADOR===========================================-->											<li class="dropdown-submenu">													<li><a href="../cp_seguridad/frm_seguridad.php"><i class="icon-user"></i> Usuarios</a></li>											</li>										</ul>									</li>								<li class="divider-vertical"></li>
							</ul>
							
							<ul class="nav pull-right">
								<li class="divider-vertical"></li>
								<li><a href="#">Ayuda</a></li>
								<li class="divider-vertical"></li>
								<li><a href="../cp_login/logout.php"><i class="icon-off"></i> Salir</a></li>
							</ul>
						</div><!-- /.nav-collapse -->
					</div>
				</div><!-- /navbar-inner -->
			</div><!-- /navbar -->	</div>
			<!--
	<div class="navbar navbar-inverse navbar-fixed-top">		<div class="navbar-inner">			<div class="container">				<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">					<span class="icon-bar"></span>					<span class="icon-bar"></span>					<span class="icon-bar"></span>				</button>				<a class="brand" href="#">Bootstrap</a>				<div class="nav-collapse collapse">					<ul class="nav">						<li class="">							<a href="./index.html">Home</a>						</li>					</ul>				</div>			</div>		</div>	</div>-->
<!--================================================== /.navbar ===========================================================-->

<!--===============================================================================================================================================-->
<!--========================================================START WORK AREA========================================================================-->
<!--===============================================================================================================================================-->		<div class="container">
			<!-- Jumbotron -->
			<div class="text-center" >
				<h1 class='text-error'>ESCUELA POLITÉCNICA</h1>
				<p class="lead text-info">					<?php 						echo $gra_descripcion.'  '.$usu_apellidos.', '.$usu_nombres;					?>				</p>
				<div > 					<img src='../img/escudo_ep.png' width='30%' >				</div>			</div>
		</div> 		<!-- /container -->

<!--===============================================================================================================================================-->
<!--======================================================END WORK AREA============================================================================-->
<!--===============================================================================================================================================-->
						<div class="footer" align='center'>									<p class="muted credit">Copyright &copy 2015  -  Powered by  <a href='http://www.politecnica.edu.gt/' target='_blank'>Escuela Politécnica</a></p>							</div>
		

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript" src="../assets/js/widgets.js"></script>
		<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap-transition.js"></script>
		<script src="../assets/js/bootstrap-alert.js"></script>
		<script src="../assets/js/bootstrap-modal.js"></script>
		<script src="../assets/js/bootstrap-dropdown.js"></script>
		<script src="../assets/js/bootstrap-scrollspy.js"></script>
		<script src="../assets/js/bootstrap-tab.js"></script>
		<script src="../assets/js/bootstrap-tooltip.js"></script>
		<script src="../assets/js/bootstrap-popover.js"></script>
		<script src="../assets/js/bootstrap-button.js"></script>
		<script src="../assets/js/bootstrap-collapse.js"></script>
		<script src="../assets/js/bootstrap-carousel.js"></script>
		<script src="../assets/js/bootstrap-typeahead.js"></script>
		<script src="../assets/js/bootstrap-affix.js"></script>
		<script src="../assets/js/holder/holder.js"></script>
		<script src="../assets/js/google-code-prettify/prettify.js"></script>
		<script src="../assets/js/application.js"></script>		<script>			$('#example').tooltip(options)		</script>
	</body>
</html>