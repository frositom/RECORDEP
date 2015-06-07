<?php
	require_once('ClsConex.php');
	
	class ClsCorrseg extends ClsConex{  // con el extends hereda los metodos de la clase ClsConex
		
		// metodo para traer los datos de corr_seg
		function get_corrseg($usu='',$dep='', $dir='',$ofi='',$nivel='',$msg=''){
			$sql='SELECT co.of_oficina, ccs.seg_pass, co.of_dependencia, co.of_descripcion, co.of_mensajes, ccs.seg_oficina, ccs.seg_nivel, ccs.seg_plaza, '; 
			$sql.=' m.per_nom1, m.per_nom2, m.per_ape1, m.per_ape2, g.gra_desc_ct, ccs.seg_usuario, '; 
			$sql.=' (SELECT of_descripcion FROM cor_oficinas WHERE cor_oficinas.of_dependencia = co.of_dependencia ';
			$sql.=' AND left( cor_oficinas.of_oficina, 1 )= left(co.of_oficina, 1 ) ';
			$sql.=' AND cor_oficinas.of_oficina LIKE "%000000000" ) as direccion, '; 
			$sql.=' co.of_descripcion ';
			$sql.=' FROM cor_corr_seg as ccs, cor_oficinas as co, mper as m, grados as g ';
			$sql.=' WHERE ccs.seg_oficina=co.of_codigo ';
			$sql.=' AND ccs.seg_usuario=m.per_catalogo ';
			$sql.=' AND g.gra_codigo=m.per_grado ';
			
			if((strlen($usu))>0){
					$sql.= " AND ccs.seg_usuario = $usu ";
			}
			if($dep!=0 && $dir!=999 && $ofi!=999){
				$sql.=" AND co.of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
				$sql.=" AND left( co.of_oficina, 1 ) = '$dir' ";  /* AQUI VA LA DIRECCION SELECCIONADA */
				$sql.=" AND co.of_codigo = $ofi ";
				
			}else if($dep!=0 && $dir!=999){
				$sql.=" AND co.of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
				$sql.=" AND left( co.of_oficina, 1 ) = '$dir' ";  /* AQUI VA LA DIRECCION SELECCIONADA */
				$sql.=" AND of_oficina LIKE '%000'";
			}else if ($dep!=0){
				$sql.=" AND co.of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			}
			if($nivel!=0){
				$sql.=" AND ccs.seg_nivel = $nivel";
			}
			if((strlen($correo))>0){
				$sql.=" AND ccs.seg_centro_mensajes = $msg";
			}
			$sql.=' ORDER BY co.of_dependencia asc, co.of_oficina asc, m.per_grado DESC, m.per_ape1 ASC';
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		
		function get_login($usu,$pass){
			$sql='SELECT co.of_oficina, co.of_codigo, ccs.seg_pass, co.of_dependencia, co.of_descripcion, co.of_mensajes, ccs.seg_oficina, ccs.seg_nivel, ccs.seg_habilita, ccs.seg_plaza, '; 
			$sql.=' m.per_nom1, m.per_nom2, m.per_ape1, m.per_ape2, g.gra_desc_ct, ccs.seg_usuario,  '; 
			$sql.=' (SELECT of_descripcion FROM cor_oficinas WHERE cor_oficinas.of_dependencia = co.of_dependencia ';
			$sql.=' AND left( cor_oficinas.of_oficina, 1 )= left(co.of_oficina, 1 ) ';
			$sql.=' AND cor_oficinas.of_oficina LIKE "%000000000" ) as direccion, ';
			$sql.=' left(co.of_oficina, 1 ) as cod_direccion, ';
			$sql.=' co.of_descripcion ';
			$sql.=' FROM cor_corr_seg as ccs, cor_oficinas as co, mper as m, grados as g ';
			$sql.=' WHERE ccs.seg_oficina=co.of_codigo ';
			$sql.=' AND ccs.seg_usuario=m.per_catalogo ';
			$sql.=' AND g.gra_codigo=m.per_grado ';
			$sql.= " AND ccs.seg_usuario = $usu ";
			$sql.= " AND ccs.seg_pass = '$pass' ";
			$sql.= ' AND ccs.seg_plaza=m.per_plaza ';  //si cambia de plaza ya no ingresa al sistema
			$sql.= ' AND ccs.seg_situacion = 1';
			$sql.= ' AND ccs.seg_seguridad = 0';
			
			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result
			// $result = $sql;  // asignamos los resultados del query a la variable $result
			return $result;	
		}
		
		// metodo para insertar corr_seg
		function insert_corrseg($usu, $pas, $ofi, $pla, $niv, $seg, $hab, $sit){
			$sql="insert into cor_corr_seg (seg_usuario, seg_pass, seg_oficina, seg_plaza, seg_nivel, seg_seguridad, seg_habilita, seg_situacion)";
			$sql.="values ($usu,'$pas', $ofi, $pla, $niv, $seg, $hab, $sit);";
			return $sql;
		}
		
		// metodo para actualizar corr_seg 
		function update_corrseg($usu, $pas, $ofi, $pla, $niv, $seg, $hab, $sit){
			$sql="update cor_corr_seg ";
			$sql.="set seg_pass='$pas',";
			$sql.=" seg_oficina=$ofi,";
			$sql.=" seg_plaza=$pla,";
			$sql.=" seg_nivel=$niv,";
			$sql.=" seg_seguridad=$seg,";
			$sql.=" seg_habilita=$hab,";
			$sql.=" seg_situacion=$sit";
			$sql.=" where seg_usuario=$usu;";
			return $sql;
		}
		
		
		// metodo para actualizar la contraseña de la tabla cor_corr_seg incluyendo
		function actualiza_pass_corrseg($usu, $pass){
			$sql="update cor_corr_seg ";
			$sql.="set seg_pass='$pass',";
			$sql.=" seg_habilita=0";
			$sql.=" where seg_usuario=$usu;";
			return $sql;
		}
		
		
		// metodo para eliminar corr_Seg
		function delete_corrseg($usu){
			$sql=" delete from cor_corr_seg ";
			$sql.="where seg_usuario=$usu;";
			return $sql;
		}
		
		
		// metodo para obtener plaza actual del usuario
		function plaza_actual($usu){
			$sql=" select per_plaza from mper ";
			$sql.="where per_catalogo=$usu;";
			$result= $this->exec_query($sql); // asigno los resultados del query a la variable result
			if(is_array($result)){
				foreach($result as $row){
					$pla = $row['per_plaza'];
				}
			}
			return $pla;
		}
		
		
		
		// metodo para obtener plaza actual del usuario
		function plaza_corrseg($usu){
			$sql=" select seg_plaza from cor_corr_seg ";
			$sql.="where seg_usuario=$usu;";
			$result= $this->exec_query($sql); // asigno los resultados del query a la variable result
			if(is_array($result)){
				foreach($result as $row){
					$pla = $row['seg_plaza'];
				}
			}
			return $pla;
		}
		
		
		// metodo para cargar dependencias
		function dependencias_corrseg(){
			$sql=" select * from mdep";
			// $sql.=" where dep_llave in(2010,2160)";
			$sql.=" order by dep_desc_lg ASC";
			$result = $this->exec_query($sql);
			return $result;
		}
		
		
		// metodo para sacar las direcciones
		function direcciones_corrseg($dep){
			$sql=" SELECT left( of_oficina, 1 ) as dir_jerarquia , of_descripcion";
			$sql.=" FROM cor_oficinas";
			$sql.=" WHERE of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			$sql.=" AND of_oficina LIKE '%000000000'";
			$sql.=" ORDER BY of_oficina ASC;";
			$result = $this->exec_query($sql);
			return $result;
		}
		
		// metodo para sacar las Subdirecciones
		function oficinas_corrseg($dep, $dir){
			$sql=" SELECT * ";
			$sql.=" FROM cor_oficinas";
			$sql.=" WHERE of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			$sql.=" AND left( of_oficina, 1 ) = '$dir'";  /* AQUI VA LA DIRECCION SELECCIONADA */
			$sql.=" AND of_oficina LIKE '%000'";
			$sql.=" ORDER BY of_oficina ASC;";
			$result = $this->exec_query($sql);
			return $result;
		}
		
		
		// metodo para traer los datos del usuario
		function datos_catalogo($cat){
			$sql=" SELECT * ";
			$sql.=" FROM mper, armas, grados";
			$sql.=" WHERE per_arma=arm_codigo AND per_grado=gra_codigo";
			$sql.=" AND per_catalogo=$cat;";
			$result = $this->exec_query($sql);
			// $result=$sql;
			return $result;
		}
		
		// metodo para ver si el catalogo ya esta como usuario
		function busca_usuario($cat){
			$sql=" SELECT * ";
			$sql.=" FROM cor_corr_seg";
			$sql.=" WHERE seg_usuario=$cat;";
			$result = $this->exec_query($sql);
			// $result=$sql;
			return $result;
		}
		
		
		// metodo para ver si el catalogo ya esta como usuario
		function busca_info_usuario($cat){
			$sql=" SELECT left( of_oficina, 1 ) as direccion, seg_pass, of_dependencia, of_descripcion, seg_oficina, seg_plaza, seg_nivel,of_descripcion, seg_seguridad, seg_habilita, seg_situacion ";
			$sql.=" FROM cor_corr_seg, cor_oficinas";
			$sql.=" WHERE seg_oficina=of_codigo";
			$sql.=" AND seg_usuario=$cat;";
			$result = $this->exec_query($sql);
			// $result=$sql;
			return $result;
		}
		
		
		// metodo para sacar las direcciones
		function direcciones_tabla($dep,$ofi){
			$sql=" SELECT of_descripcion";
			$sql.=" FROM cor_oficinas";
			$sql.=" WHERE of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			$sql.=" AND $ofi LIKE '%000000000'";
			$sql.=" ORDER BY of_oficina ASC;";
			$result = $this->exec_query($sql);
			return $result;
		}
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		// XXXXXXXXXXXXXXXXXXXXXX  SE COMENTARIO PORQUE NO SE ESTA UTILIZANDO XXXXXXXXXXXXXXXXXXXX
		// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		
		// // metodo para sacar los Departamentos
		// function departamentos_corrseg($dep, $dir, $sub){
			
			// $sql=" SELECT substring( of_oficina, 4, 2 ) as dep_jerarquia, of_descripcion";
			// $sql.=" FROM cor_oficinas";
			// $sql.=" WHERE of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			// $sql.=" AND left( of_oficina, 1 ) = '$dir'";  /* AQUI VA LA DIRECCION SELECCIONADA */
			// $sql.=" AND substring( of_oficina, 2, 2 )='$sub'";  /* AQUI VA LA DIRECCION SELECCIONADA */
			// $sql.=" AND of_oficina LIKE '%00000'";
			// $sql.=" ORDER BY of_oficina ASC;";
			
			// // $result=$sql;
			// $result = $this->exec_query($sql);
			// return $result;
		// }
		
		
		// // metodo para sacar las Secciones
		// function secciones_corrseg($dep, $dir, $sub, $depto){
			
			// $sql=" SELECT substring( of_oficina, 6, 2 ) as sec_jerarquia, of_descripcion";
			// $sql.=" FROM cor_oficinas";
			// $sql.=" WHERE of_dependencia = $dep";   /* AQUI VA LA DEPENDENCIA SELECCIONADA */
			// $sql.=" AND left( of_oficina, 1 ) = '$dir'";  /* AQUI VA LA DIRECCION SELECCIONADA */
			// $sql.=" AND substring( of_oficina, 2, 2 )='$sub'";  /* AQUI VA LA DIRECCION SELECCIONADA */
			// $sql.=" AND substring( of_oficina, 4, 2 )='$depto'";  /* AQUI VA EL DEPARTAMENTO SELECCIONADO */
			// $sql.=" AND of_oficina LIKE '%000'";
			// $sql.=" ORDER BY of_oficina ASC;";
			
			
			// // $result=$sql;
			// $result = $this->exec_query($sql);
			// return $result;
		// }
		
		
	}
?>