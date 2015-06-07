<?php
date_default_timezone_set('America/Guatemala');
require_once('xajax_fns_menu.php');

session_start();
$usu_codigo					=	$_SESSION["usu_codigo"];
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
		<!--==================TITLE====================================-->
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
	<div class="container">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="frm_menu.php">Escuela Polit�cnica</a>
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
													
											</li>
										</ul>
									</li>
								<li class="divider-vertical"></li>
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
			</div><!-- /navbar -->
			
	<div class="navbar navbar-inverse navbar-fixed-top">
<!--================================================== /.navbar ===========================================================-->

<!--===============================================================================================================================================-->
<!--========================================================START WORK AREA========================================================================-->
<!--===============================================================================================================================================-->
			<!-- Jumbotron -->
			<div class="text-center" >
				<h1 class='text-error'>ESCUELA POLIT�CNICA</h1>
				<p class="lead text-info">
				<div > 
		</div> 

<!--===============================================================================================================================================-->
<!--======================================================END WORK AREA============================================================================-->
<!--===============================================================================================================================================-->
			
		

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
		<script src="../assets/js/application.js"></script>
	</body>
</html>