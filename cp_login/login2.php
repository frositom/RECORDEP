<?php
include_once('user_auth_fns.php');
require_once ("../Clases/ClsCorrseg.php");
$username = $_REQUEST['usu'];
$pass = $_REQUEST['pass'];

if($username != '' && $pass != '' ){
	
  if ((!isset($_REQUEST['usu']))||(!isset($_REQUEST['pass']))){	
	//redirecciona por medio de $_post
	echo "<form id='f_cambia_pass' name='f_cambia_pass' action='index.php' method='post'>";
	echo "<script>document.f_cambia_pass.submit();</script>";
	echo "</form>";
  }
	
  if(login($username,$pass)){
	$_SESSION['usu'] = $username;
	$_SESSION['pass'] = $pass;
		
	echo "<script>window.location='index.php';</script>";
	
  }else{
	$_SESSION['usu'] = "";	
	unset($_SESSION['usu']);
	$_SESSION['pass'] = "";	
	unset($_SESSION['pass']);
	//redirecciona por medio de $_post
	echo "<form id='f_cambia_pass' name='f_cambia_pass' action='index.php' method='post'>";
	echo "<script>document.f_cambia_pass.submit();</script>";
	echo "</form>";
  } 
}else{
	//redirecciona por medio de $_post
	echo "<form id='f_cambia_pass' name='f_cambia_pass' action='index.php' method='post'>";
	echo "<script>document.f_cambia_pass.submit();</script>";
	echo "</form>";
}	

?>
