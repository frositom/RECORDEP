<?php
  // writer.php Is the Interface for Writers to Manage Their Stories

  include_once('../../user_auth_fns.php');
  include_once('../../cp_login/validacion.php');
  
  if (!check_auth_user()){
    echo login_form();
	// echo "Sin loguear..";
  }else{
	consulta_log(); 
	// echo "Consulta Permisos..";
  }
?>