<?php

require_once('ClsConex.php');

class ClsRecord extends ClsConex{  // con el extends hereda los metodos de la clase ClsConex

// metodo para traer los datos de seguridad

		function get_cadetes($cat='', $gra='', $nom1='', $nom2='',$ape1='',$ape2='',$prom='',$sem='',$cia=''){

			$sql="SELECT * from cadetes, gra_cadetes";

			$sql.="  WHERE cad_grado=cgr_codigo ";

			if((strlen($cat))>0){

				$sql.= " AND cad_catalogo = $cat ";

			}
			
			if($gra>0){

				$sql.= " AND cad_grado = $gra ";

			}
			
			if((strlen($nom1))>0){

				$sql.= " AND cad_nom1 like '%$nom1%' ";

			}

			if((strlen($nom2))>0){

				$sql.= " AND cad_nom2 like '%$nom2%' ";

			}
			
			if((strlen($ape1))>0){

				$sql.= " AND cad_ape1 like '%$ape1%' ";

			}

			if((strlen($ape2))>0){

				$sql.= " AND cad_ape2  like '%$ape2%' ";

			}
			
			if((strlen($prom))>0){

				$sql.= " AND cad_promoción = $prom ";

			}

			if($sem>0){

				$sql.= " AND cad_semestre = $sem ";

			}

			if($cia>0){

				$sql.= " AND cad_cia = '$cia' ";

			}

			$sql.= " AND cad_situacion in (11) ORDER BY cad_semestre DESC, cad_ape1 ASC, cad_ape2 ASC, cad_nom1 ASC, cad_nom2 ASC ;";

			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result

			// $result = $sql;  // asignamos los resultados del query a la variable $result

			return $result;	

		}
		
		
		function get_cadete_sel($cat){

			$sql="SELECT * from cadetes, gra_cadetes";

			$sql.="  WHERE cad_grado=cgr_codigo ";

			$sql.= " AND cad_catalogo = $cat ";

			$sql.= " AND cad_situacion in (11);";

			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result

			// $result = $sql;  // asignamos los resultados del query a la variable $result

			return $result;	

		}
		
		
		
			function get_grados_cadetes(){

			$sql="SELECT * from  gra_cadetes ";

			$sql.= "ORDER BY cgr_codigo ASC ;";

			$result = $this->exec_query($sql);  // asignamos los resultados del query a la variable $result

			// $result = $sql;  // asignamos los resultados del query a la variable $result

			return $result;	

		}
		
		

	}

?>