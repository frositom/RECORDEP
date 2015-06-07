<?php
include_once('../user_auth_fns.php');
// require_once ("Clases/ClsCorrseg.php");
// require_once ("../Clases/ClsSeguridad.php");

$username = $_REQUEST['usu'];
$pass = $_REQUEST['pass'];
$passwd=sha1(md5($pass));


	if($username != '' && $pass != '' ){
		
	  if ((!isset($_REQUEST['usu']))||(!isset($_REQUEST['pass']))){	
		//redirecciona por medio de $_post
		echo "<h2>No esta logeando</h2>";
		echo "<form id='f1' name='f1' action='../index.php' method='post'>";
		echo "<script>document.f1.submit();</script>";
		echo "</form>";
	  }
		
	  if(login($username,$passwd)){
		$_SESSION['usu'] = $username;
		$_SESSION['pass'] = $passwd;
			
		echo "<script>window.location='../index.php';</script>";
		
	  }else{
		$_SESSION['usu'] = "";	
		unset($_SESSION['usu']);
		$_SESSION['pass'] = "";	
		unset($_SESSION['pass']);
		//redirecciona por medio de $_post
		echo "<h2>Esta logeando</h2>";
		echo "<form id='f1' name='f1' action='../index.php' method='post'>";
		echo "<script>document.f1.submit();</script>";
		echo "</form>";
		
	  } 
	}else{
		// redirecciona por medio de $_post
		echo "<form id='f1' name='f1' action='../index.php' method='post'>";
		echo "<script>document.f1.submit();</script>";
		echo "</form>";
	}
?>