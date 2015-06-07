<?php
$serverName = "192.168.1.2"; //serverName\instanceName
$connectionInfo = array( "Database"=>"politecnica", "UID"=>"hack8", "PWD"=>"hack8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
