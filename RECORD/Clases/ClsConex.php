<?php

	class ClsConex {

		//variables para la conexion

		var $server = 'localhost';

		var $user 	= 'root';

		var $pass 	= '';

		var $db 	= 'record';

		var $conn;

		

		

		//metodos de coneccion

		function getConexion(){

			$serv= $this->server;       //con 'this' llamamos a una variable que se encuentra en el mismo documento

			$usu= $this->user;

			$pas= $this->pass;

			$bd= $this->db;

			$MysqlCon=mysqli_connect($serv, $usu, $pas, $bd);

			

			if($MysqlCon){

				$this->conn=$MysqlCon;

				// echo "entro";

			}else{

				// echo "no entro";

				return false;

			}

			

		}

		

		//metodo para ejecutar querys 'select'

		function exec_query($ssql){

			$conn = mssql_connect('192.168.1.2', '8559', 'hack8');
			 
			if (!$conn) {
				die('No se logro conectar con el servidor');
			}
				
			 if (!mssql_select_db('BKRECORD', $conn)){
				 die('No se logro conectar con la base de datos!');
			 }
							 
			$result = mssql_query($ssql);
			 
			 if ($result){   //si el resultado no viene vacío hace la instruccion

					$x=0;

					while($row =mssql_fetch_array($result)){   //row va a recibir la linea del vector

						$result_array[$x]=$row;  // se crea un array que va a recoger los datos que traiga una fila de la sentencia ssql.

						$x++;  //  se le va sumando 1 a x para que cambie la posición del array

					}

					if($x>0){
					
						return $result_array;   
	
					}

				}else{			// si el resultado viene vacil retur error con '!E'

					$error= '!E';  // devuelve un error.
					return $error;
				}
				

		}//finaliza el metodos para ejecutar querys 'select'

		

		

		//   metodo para ejecutar querys de insert, update o delete

		function exec_sql($ssql){

			$conn = mssql_connect('192.168.1.2', '8559', 'hack8');
			 
			if (!$conn) {
				die('No se logro conectar con el servidor');
			}
				
			 if (!mssql_select_db('BKRECORD', $conn)){
				 die('No se logro conectar con la base de datos!');
			 }
							 
			$result = mssql_query($ssql);
			
			if($result){//si hay conexion ejecutamos la siguiente instruccion

				return 1;		//devuelve un 1
				mssql_close($conn);	// cierra la conexion
				
			} else {
				
				return 0;		//devuelve un 0 y lo saca de la funcion automaticamente.

				mssql_close($conn);	//cierra la conexion
				
			}
			

		}

	}

?>