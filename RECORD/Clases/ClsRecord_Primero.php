<?php

	class ClsRecord_Primero{

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

			$this->getConexion();		//se ejecuta la conexion para cargar la variable

			$conn=$this->conn;		//ahora cargo la variable

			if($conn){//si hay conexion ejecutamos la siguiente instruccion

				$result=mysqli_query($conn,$ssql);		//la variable $result recoge el idem,  para ello lleva la conexion y el query

				if ($result){   //si el resultado no viene vacío hace la instruccion

					$x=0;

					while($row = $result->fetch_assoc()){   //row va a recibir la linea del vector

						$result_array[$x]=$row;  // se crea un array que va a recoger los datos que traiga una fila de la sentencia ssql.

						$x++;  //  se le va sumando 1 a x para que cambie la posición del array

					}

					if($x>0){

						return $result_array;

					}

				}else{			// si el resultado viene vacil retur error con '!E'

					return '!E';  // devuelve un error.

				}

			}

		}//finaliza el metodos para ejecutar querys 'select'

		

		

		//   metodo para ejecutar querys de insert, update o delete

		function exec_sql($ssql){

			$this->getConexion();		//se ejecuta la conexion para cargar la variable

			$conn=$this->conn;		//ahora cargo la variable

			if($conn){//si hay conexion ejecutamos la siguiente instruccion

				$sql= explode(';',$ssql);		//separamos las sentencias buscando el punto y coma

				mysqli_autocommit($conn,false); //desactivamos el autocomit

				foreach($sql as $squery){  //por cada sentencia sql ejecuta lo que esta dentro 

					$squery=trim($squery);  // quita los espacios en blanco del query

					if(strlen($squery)>0){		// si el query no viene vacio

						$rs=mysqli_query($conn,$squery);	//ejecuta la conexion y el query

						if (!$rs){		//si no hay ejecución del query

							mysqli_rollback($conn);   // ejecuta el rollback

							mysqli_close($conn);	//cierra la conexion

							return 0;		//devuelve un 0 y lo saca de la funcion automaticamente.

						}

					}

				}

				mysqli_commit($conn);	// si no hubo error ejecuta el comit

				mysqli_close($conn);	// cierra la conexion

				return 1;		//devuelve un 1

			}else{

				return '!E';	//devuelve un error

			}

		}

	}

?>