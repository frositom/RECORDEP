<?php header('Content-Type: text/html; charset=ISO-8859-1');
include_once("xajax_fns_seguridad.php");

$usu_codigo					=	$_SESSION["usu_codigo"];
$gra_descripcion			=	$_SESSION["gra_desc_md"];
$emp_codigo					=	$_SESSION["gra_codigo"];
$usu_nombres				=	$_SESSION["usu_nombres"];
$usu_apellidos				=	$_SESSION["usu_apellidos"];
$usu_usuario					=	$_SESSION["usu_usuario"];$usu_nivel						=	$_SESSION["usu_nivel"];

if (empty($usu_codigo)){
	header('Location: ../index.php' );
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>

	<!--    ICONO PARA LA PESTAÑA DEL NAVEGADOR
	<link rel="shortcut icon" type='image/x-icon' href='../img/vasija-maya1.png'>
	-->
	<link rel="shortcut icon" type='image/x-icon' href='../img/logo_ep.png'>		<title>E. P.</title>
	<?php 
		$xajax->printJavascript("../xajax/"); 
	?>
	<!-- Le styles -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<!--
    <script type="text/javascript" src="../js/jquery.js"></script>
	<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
	<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
	-->
	<script type="text/javascript" src="js/seguridad.js"></script>
	<script src="../assets/js/bootstrap.js"></script>
	
	<link href='../assets/css/bootstrap-panel.css' rel='stylesheet'/>
	
	<!--====================================================================================================-->
	<!--================================= DEFAULT =============================================================-->
	<!--====================================================================================================-->
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-panel.css" rel="stylesheet"/>
	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../assets/css/docs.css" rel="stylesheet">
	<link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../assets/css/docs.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-panel.css" rel="stylesheet"/>
	<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">

	
	<!--
	<script type="text/javascript">
		$(window).on('load', function () {
			
			$('.selectpicker').selectpicker({
				'selectedText': 'cat'
			});
			
			$('.selectpicker').selectpicker('hide');
		});
    </script>
	-->
</head>
<body >
	<div class="container">
<!--================== navbar ====================================-->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="../cp_menu/frm_menu.php">Usuarios</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li class="divider-vertical"></li>
							<li><a href="../cp_menu/frm_menu.php"><i class="icon-home"></i> Inicio</a></li>
							<li class="divider-vertical"></li>
							<!--===============================================================================================================-->
							<!--================================USUARIO DE DE TI ===========================================================-->
							<!--===============================================================================================================-->
							
						</ul>
						<a class="brand"></a>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
							<li><a href="../cp_login/logout.php"><i class="icon-off"></i> Salir</a></li>
						</ul>
					</div><!-- /nav-collapse -->
				</div><!-- /container-->
			</div><!-- /navbar-inner -->
		</div><!-- /navbar -->
		
<!--================== /navbar ====================================-->
	</div> <!-- FINALIZA CONTAINER PRINCIPAL --> 
	
	<div class='container' id='div_datos'>		</br>
		<div class='row-fluid'>
			<div class="span6" >				<div class="panel panel-primary" >
					 <div class="panel-heading" style="padding: 3px 3px;">DATOS DEL USUARIO</div>
					<!--================== INICIA BODY DEL PANEL ====================================-->
					<div class="panel-body">
						<div class='row-fluid'>							<div class='span12'>								<div class='span3' align='left'>									<label for='seg_grado'>Grado:</label>								</div>								<div class='span9'  >									<?php echo combo_grados(); ?>																	</div>							</div>						</div>																		<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_nombres'>Nombres:</label>
								</div>
								<div class='span9'  >
									<input type='hidden' class='span11' id='seg_codigo' name='seg_codigo' placeholder='codigo del Usuario'></input>
									<input type='hidden' class='span11' id='user' name='user' value='<?php echo $usu_usuario ?>' placeholder='codigo del Usuario'></input>
									<input type='text' class='span11' id='seg_nombres' name='seg_nombres' placeholder='Nombres del Usuario' style='text-transform: uppercase;' ></input>
								</div>
							</div>
						</div>
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_apellidos'>Apellidos:</label>
								</div>
								<div class='span9' >
									<input type='text' class='span11' id='seg_apellidos' name='seg_apellidos' placeholder='Apellidos del Usuario' style='text-transform: uppercase;'></input>
								</div>
							</div>
						</div>
						
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_correo'>Puesto:</label>
								</div>
								<div class='span9' >
									<input type='text' class='span11' id='seg_puesto' name='seg_puesto'  placeholder='Ingrese el puesto del usuario'  required></input>
								</div>
							</div>
						</div>
						
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_usuario'>Usuario:</label>
								</div>
								<div class='span9' >
									<input type='text' class='span5' id='seg_usuario' onblur='check_user(this.value);' name='seg_usuario' placeholder='Usuario'></input>
									<!--
										<img id='img_old_pass_ok' src='../img/check.png' style='display:none'><font id='font_img_old_pass_ok' color='green' style='display:none'>&nbsp Disponible</font></img>
										<img id='img_old_pass_no' src='../img/X.png' style='display:none'><font id='font_img_old_pass_no' color='red' style='display:none'>&nbsp No Disponible</font></img>
									-->
								</div>
							</div>
						</div>
						
						<!--=============================== alerts ======================================-->
						<div class='row-fluid'id='alert'></div>
						<div class="modal hide fade" id="alert_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
						<!--=============================================================================-->
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_pass'>Contraseña:</label>
								</div>
								<div class='span9' >
									<input type='hidden' class='span5' id='seg_pass_ant' name='seg_pass_ant' placeholder='Contraseña' readonly></input>
									<input type='password' class='span5' id='seg_pass' name='seg_pass' placeholder='Contraseña' readonly></input> &nbsp
									<label class="checkbox inline">
										<input type='checkbox' onclick='coloca_pass();' name='seg_habilita' id='seg_habilita'></input>Pedir cambio al ingresar
									</label>
								</div>
							</div>
						</div>
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='cmb_seg_nivel'>Nivel de Permisos:</label>
								</div>
								<div class='span9' >
									<select id='cmb_seg_nivel' class='span11'>
										<option value='0' >Seleccione...</option>
						<?php //     if ($emp_codigo==1 && $usu_nivel==1) {     ?>
										<option style='font-weight:bold' value='1'>Administrador</option>
						<?php//    }   ?>
										<option style='font-weight:bold' value='2'>Oficial</option>
										<option style='font-weight:bold' value='3'>Galonista</option>
										<option style='font-weight:bold' value='4'>Cadete</option>
									</select>
								</div>
							</div>
						</div>
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_seguridad'>Cuenta Habilitada:</label>
								</div>
								<div class='span9' >
									<label class="radio inline">
										<input type='radio' name='seg_seguridad' id='seg_seguridad_si' checked></input>SI
									</label>
									<label class="radio inline"> 
										<input type='radio' name='seg_seguridad' id='seg_seguridad_no'></input>NO
									</label>
									<small><small>&nbsp * Se deshabilita luego de 5 intentos en el login con el mismo usuario</small></small>
								</div>
							</div>
						</div>
						<div class='row-fluid'>
							<div class='span12'>
								<div class='span3' align='left'>
									<label for='seg_seguridad'>Situación Usuario:</label>
								</div>
								<div class='span9' >
									<select class='span11' id='seg_situacion' name='seg_situacion'>
									<option value='0' style='font-weight:bold; color:red'>INACTIVO</option>
									<option value='1' style='font-weight:bold; color:green'selected>ACTIVO</option>
								</select>
								</div>
							</div>
						</div>
						<div class='row-fluid'>
							<div  align='right'>
								<label>* Todos los campos son Obligatorios</label>
							</div>
						</div>
					</div>
					<!--================== FINALIZA EL BODY DEL PANEL ====================================-->
					<div class="panel-footer" align='center'>
					<button class="btn " onclick='reload()' value='Limpiar'><i class="icon-search"></i> Limpiar</button>
					<button class="btn "  onclick='modificar_seguridad();' id='modificar_seguridad'value='Modificar' style='display:none'><i class="icon-ok"></i> Modificar</button>
					
					<button class="btn "   onclick='grabar_seguridad();' id='grabar_seguridad' value='Grabar' style='display:display' ><i class="icon-hdd"></i> Grabar </button>
					<button class="btn "  onclick='buscar_seguridad();' id='Buscar_seguridad' value='Buscar' style='display:display' ><i class="icon-search"></i> Buscar</button>
				</div>
				</div>			</div>
			<div class="span6" >
				<div class="panel panel-primary" >					 <div class="panel-heading" style="padding: 3px 3px;">USUARIOS REGISTRADOS</div>
					<div class="panel-body" id='div_tabla' style=' overflow:auto;  height:467px;  padding: 3px  3px;'>
					<?php echo tabla_seguridad('','','','','','','','','') ?>					</div>
				</div>			</div>		</div>
	
		
		
	</div>
	<!-- Footer -->	<div class="footer" align='center'>									<p class="muted credit">Copyright &copy 2015  -  Powered by  <a href='http://www.politecnica.edu.gt/' target='_blank'>Escuela Politécnica</a></p>							</div>
	<!--=====================LIBRERIAS NECESARIAS DE BOOTSTRAP=====================-->
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