	// FUNCION PARA ESCRIBIR SOLO numeros
	function verifica_numero(e){
				var keynum=window.event ? window.event.keyCode : e.which;
				//<!-- alert(keynum); -->
				if ((keynum==8)||(keynum==0)||(keynum==13))
					return true;
					
				return /\d/.test(String.fromCharCode(keynum));
					
		}

		// FUNCION PARA ESCRIBIR SOLO LETRAS
		function soloLetras(e) {
			key = e.keyCode || e.which;
			// alert(key);
			tecla = String.fromCharCode(key).toLowerCase();
			letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
			especiales = [8, 13, 9];

			tecla_especial = false
			for(var i in especiales) {
				if(key == especiales[i]) {
					tecla_especial = true;
					break;
				}
			}
			if(letras.indexOf(tecla) == -1 && !tecla_especial)
				return false;
		}
	
	function salir(){
		var form=document.getElementById('f_cambia_pass');
		form.action='../logout.php';
		form.submit();
		// alert('llega al submit_form');
	}