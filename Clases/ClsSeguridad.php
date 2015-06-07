<?php
	require_once('ClsConex.php');
	
	class ClsSeguridad extends ClsConex{  // con el extends hereda los metodos de la clase ClsConex
		
		// metodo para traer los datos de seguridd
		function get_login($usu,$pass){
			$sql="SELECT * from seguridad, grados";
			$sql.=" WHERE seg_grado=gra_codigo ";
			$sql.= " AND seg_usuario = '$usu' ";
			$sql.= " AND seg_pass = '$pass' ";
			$sql.= ' AND seg_situacion = 1'; // 1=activa y 0=inactiva
			$sql.= ' AND seg_seguridad = 0'; // si es=1 la seguridad fue manipulada
			// echo $sql;
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para traer los datos de seguridd
		function verifica_login($usu,$pass){
			$sql="SELECT * from seguridad";
			$sql.=" WHERE 1=1 ";
			$sql.= " AND seg_usuario = '$usu' ";
			$sql.= " AND seg_pass = '$pass' ";
			$sql.= ' AND seg_situacion = 1'; // 1=activa y 0=inactiva
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		
		// metodo para traer los datos de seguridd
		function verifica_usuario($usu){
			$sql="SELECT * from seguridad";
			$sql.=" WHERE 1=1 ";
			$sql.= " AND seg_usuario = '$usu';";

			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para traer los datos de seguridd
		function verifica_usuario_mod($cod,$usu){
			$sql="SELECT * from seguridad";
			$sql.=" WHERE 1=1 ";
			$sql.= " AND seg_usuario = '$usu'";
			$sql.= " AND seg_codigo not in($cod);";
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para traer los datos de seguridad
		function get_seguridad($gra, $nom, $ape, $pue,$usu,$niv,$seg,$hab,$sit){
			$sql="SELECT * from seguridad, grados";
			$sql.=" WHERE seg_grado=gra_codigo ";
			if((strlen($gra))>0){				$sql.= " AND gra_codigo = $gra ";			}						if((strlen($nom))>0){				$sql.= " AND seg_nombres like '%$nom%' ";			}
			if((strlen($ape))>0){
				$sql.= " AND seg_apellidos like '%$ape%' ";
			}
			if((strlen($pue))>0){
				$sql.= " AND seg_puesto like '%$pue%' ";
			}
			if((strlen($usu))>0){
				$sql.= " AND seg_usuario like '%$usu%' ";
			}
			if($niv!=0){
				$sql.= " AND seg_nivel = $niv ";
			}
			if((strlen($seg))>0){
				$sql.= " AND seg_seguridad = $seg ";
			}
			if((strlen($hab))>0){
				// $sql.= " AND seg_habilita = $hab ";
			}
			if((strlen($sit))>0){
				$sql.= " AND seg_situacion = $sit ";
			}
			$sql.= " ORDER BY  seg_apellidos ASC ;";
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para traer los datos de seguridad
		function get_seguridad_sel($cod){
			$sql="SELECT * from seguridad";
			$sql.=" WHERE seg_codigo=$cod ;";
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para insertar seguridad
		function insert_seguridad($cod, $gra, $nom, $ape, $pue, $usu, $pas, $niv, $seg, $hab, $sit, $user){
		    $nom=strtoupper($nom);
			$ape=strtoupper($ape);
			$fecha=date("Y-m-d H:i:s");
			$sql="insert into seguridad ";
			$sql.="values ($cod,$gra,'$nom','$ape','$pue','$usu','$pas',$niv,$seg,$hab,$sit,'$user','$fecha','','');";
			return $sql;
		}
		
		// metodo para actualizar seguridad
		function update_seguridad($cod, $gra, $nom, $ape, $pue, $usu, $niv, $seg, $hab, $sit, $user){
		$nom=strtoupper($nom);
		$ape=strtoupper($ape);
		$fecha=date("Y-m-d H:i:s");
			$sql="update seguridad ";						$sql.="set seg_grado=$gra,";	
						$sql.="seg_nombres='$nom',";						$sql.="seg_apellidos='$ape',";
			$sql.="seg_puesto='$pue',";
			$sql.="seg_usuario='$usu',";
			$sql.="seg_nivel=$niv,";
			$sql.="seg_seguridad=$seg,";
			$sql.="seg_habilita=$hab,";
			$sql.="seg_situacion=$sit,";
			$sql.="aud_user_update='$user',";
			$sql.="aud_fecha_update='$fecha'";
			
			$sql.=" where seg_codigo=$cod;";
			return $sql;
		}
		
		// metodo para actualizar seguridad
		function update_seguridad_pass($cod, $gra, $nom, $ape, $pue, $usu, $pas, $niv, $seg, $hab, $sit, $user){
		$nom=strtoupper($nom);
		$ape=strtoupper($ape);
		$fecha=date("Y-m-d H:i:s");
			$sql="update seguridad ";
			$sql.="set seg_grado=$gra,";						$sql.="seg_nombres='$nom',";						$sql.="seg_apellidos='$ape',";
			$sql.="seg_puesto='$pue',";
			$sql.="seg_usuario='$usu',";
			$sql.="seg_pass='$pas',";
			$sql.="seg_nivel=$niv,";
			$sql.="seg_seguridad=$seg,";
			$sql.="seg_habilita=$hab,";
			$sql.="seg_situacion=$sit,";
			$sql.="aud_user_update='$user',";
			$sql.="aud_fecha_update='$fecha'";
			
			$sql.=" where seg_codigo=$cod;";
			return $sql;
		}
		
		// metodo para actualizar la contraseña de la tabla inv_seguridad
		function actualiza_pass_seguridad($cod, $pass, $user){
		$fecha=date("Y-m-d H:i:s");
			$sql="update seguridad ";
			$sql.="set seg_pass='$pass',";
			$sql.=" seg_habilita=0,";
			$sql.=" aud_user_update='$user',";
			$sql.=" aud_fecha_update='$fecha'";
			
			$sql.=" where seg_codigo=$cod;";
			return $sql;
		}
		
		// metodo para actualizar la contraseña de la tabla inv_seguridad
		function deshabilita_usu($usu){
			$fecha=date("Y-m-d H:i:s");
			$sql="update seguridad ";
			$sql.="set seg_seguridad=1, ";
			$sql.=" aud_user_update='$usu',";
			$sql.=" aud_fecha_update='$fecha'";
			
			$sql.=" where seg_usuario='$usu';";
			return $sql;
		}
		
		// metodo para eliminar seguridad
		function delete_seguridad($cod){
			$sql=" update seguridad ";
			$sql.="set situacion=0 ";  // no elimina el registro sino que le cambia la situación
			
			$sql.="where seg_codigo=$cod;";
			return $sql;
		}
		
		//============================================== TRAE LOS DADOS DE LAS EMPRESAS ================================
		function get_grados(){
			$sql="SELECT * from grados";						$sql.=" where gra_clase in(1,3,4,5)";						$sql.=" and gra_codigo not in(1,4,5,6,10,11,18,23,24,28,29,30,31,32,33,34,35,13,14,15,36,42,50,52,54,61,69,77,85,87,99) ";						$sql.=" order by  gra_desc_lg asc";
				$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para obtener el codigo maximo de seguridad
		function max_seguridad(){
			$sql = "SELECT MAX(seg_codigo) as maximo FROM seguridad";
			$result= $this->exec_query($sql); // asigno los resultados del query a la variable result
			if(is_array($result)){
				foreach($result as $row){
					$max = $row['maximo'];
				}
				$max++;
			}
			return $max;
		}

		// metodo para obtener el codigo minimo de seguridad
		function min_seguridad(){
			$sql = "SELECT MIN(seg_codigo) as minimo FROM seguridad";
			$result= $this->exec_query($sql); // asigno los resultados del query a la variable result
			if(is_array($result)){
				foreach($result as $row){
					$min = $row['minimo'];
				}
				$min;
			}
			return $min;
		}
	}
?>