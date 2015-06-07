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

		// FUNCION PARA COLOCAR EL FOCO EN UN ELEMENTO
		function foco(elemento){
				document.getElementById(elemento).focus();
			}


		// FUNCION PARA CONFIRMAR USUARIO
		function confirmar_usuario(){
				usu=document.getElementById('usu');
				pas=document.getElementById('pass');
				usuario=usu.value;
				contra=pas.value;
			if (usuario!='' && contra!=''){
				verifica=xajax_verifica_usaurio(usuario,contra);
			}
		}

	
	function salir(){
		var form=document.getElementById('f_cambia_pass');
		form.action='../logout.php';
		form.submit();
		// alert('llega al submit_form');
	}
	
		// funcion para traer el grado, nombre y apellido del usuario
	function trae_usuario(){
		var cat=document.getElementById('seg_usuario');

		if (cat.value>0){
			// alert('aqui esta entrando');
			xajax_Trae_Datos_Catalogo(cat.value);
		}
    }
	
	function check_old_pass(old){
		var pass=document.getElementById('seg_pass');
		var old_pass=document.getElementById('old_pass');
		var new_pass=document.getElementById('seg_pass');
		var old_pass=document.getElementById('seg_pass');
		
		if (pass.value==old){
			document.getElementById('img_old_pass_ok').style='display:';
			document.getElementById('img_old_pass_no').style='display:none';
		}else{
			document.getElementById('img_old_pass_ok').style='display:none';
			document.getElementById('img_old_pass_no').style='display:';
		}
	}
	
	function check_new_pass(){
		var pass=document.getElementById('seg_pass');
		var old_pass=document.getElementById('old_pass');
		var new_pass=document.getElementById('new_pass');
		var conf_pass=document.getElementById('conf_pass');
		
		if (new_pass.value!='' && conf_pass!=''){
			if (new_pass.value==conf_pass.value){
				document.getElementById('img_conf_pass_ok').style='display:';
				document.getElementById('img_conf_pass_no').style='display:none';
			}else{
				document.getElementById('img_conf_pass_ok').style='display:none';
				document.getElementById('img_conf_pass_no').style='display:';
			}
		}
	}
	
	function cambia_pass(){
		var usu=document.getElementById('seg_usuario_cod');
		var pass=document.getElementById('seg_pass');
		var old_pass=document.getElementById('old_pass');
		var new_pass=document.getElementById('new_pass');
		var conf_pass=document.getElementById('conf_pass');
		
		if (old_pass.value!='' && new_pass.value!='' && conf_pass.value!=''){
			if (pass.value==old_pass.value){
				if (new_pass.value==conf_pass.value){
					// alert('Usuario='+usu.value+' pass='+new_pass.value);
					xajax_Cambia_Pass(usu.value,new_pass.value);
				}else{
					alert('La nueva contraseña y la confirmacion de contraseña no coinciden !!!');
				}
			}else{
				alert('La contraseña actual ingresada no coincide !!!');
			}
		}else{
			alert('Debe llenar todos los campos');
		}
	}
	
	
	
	
	function limpiar_seguridad(){ 
		xajax_Limpiar_Seguridad();
		// document.getElementById("seg_mensajes").checked=false;
    }
	
	
	
	// FUNCION PARA GRABAR UN USUARIO
	function grabar_seguridad(){
		
		var nom=document.getElementById('seg_nombres');
		var ape=document.getElementById('seg_apellidos');
		var usu=document.getElementById('seg_usuario');
		var pas=document.getElementById('seg_pass');
		var niv=document.getElementById('cmb_seg_nivel');
		var seg=document.getElementById('seg_seguridad_si');
		var hab=document.getElementById('seg_habilita')
		var sit=document.getElementById('seg_situacion');
		var img_ok=document.getElementById('img_old_pass_ok');
		var img_no=document.getElementById('img_old_pass_no');
		
		
			var habilita=0;
			if (hab.checked){
				habilita=1;	// pide cambio de contraseña al ingresar 
				}else{
				habilita=0;	// no piede cambio de contraseña
			}
			
			var seguridad=0;
			if (seg.checked){
				seguridad=0;	// cuenta habilitada
				}else{
				seguridad=1; //	cuenta deshabilitada
			}
			

			if(nom.value != ""){
				if(ape.value != ""){
					if(usu.value != ""){
						if(pas.value != ""){
							if(niv.value != 0){
								
								xajax_Verificar_Usuario_Grabar(nom.value,ape.value,usu.value,pas.value,niv.value,seguridad,habilita,sit.value);
								
							}else{
								alert("Debe seleccionar el nivel de seguridad !!!");
								foco('cmb_seg_nivel'); 
							}
						}else{
							alert("Debe escribir una contraseña !!!");
							foco('seg_pass'); 
						}
					}else{
						alert("Debe escribir el usuario !!!");
						foco('seg_usuario');
					}
				}else{
					alert("Debe colocar el Apellido del usuario !!!");
					foco('seg_apellidos');
				}
			}else{
				alert("Debe colocar el Nombre del usuario !!!");
				foco('seg_nombres');
			}
			
	}
	
	
	// FUNCION PARA MODIFICAR UN USUARIO
	function modificar_seguridad(){
		
		var cod=document.getElementById('seg_codigo');
		var nom=document.getElementById('seg_nombres');
		var ape=document.getElementById('seg_apellidos');
		var usu=document.getElementById('seg_usuario');
		var pas=document.getElementById('seg_pass');
		var niv=document.getElementById('cmb_seg_nivel');
		var seg=document.getElementById('seg_seguridad_si');
		var hab=document.getElementById('seg_habilita')
		var sit=document.getElementById('seg_situacion');
		var img_ok=document.getElementById('img_old_pass_ok');
		var img_no=document.getElementById('img_old_pass_no');
		// alert (img_no.style.display+' '+img_ok.style.display);
		
			var habilita=0;
			if (hab.checked){
				habilita=1;	// pide cambio de contraseña al ingresar 
				}else{
				habilita=0;	// no piede cambio de contraseña
			}
			
			var seguridad=0;
			if (seg.checked){
				seguridad=0;	// cuenta habilitada
				}else{
				seguridad=1; //	cuenta deshabilitada
			}
			
			if(cod.value != ""){
				if(nom.value != ""){
					if(ape.value != ""){
						if(usu.value != ""){
							if(pas.value != ""){
								if(niv.value != 0){
									
										// alert('entro aqui');
										xajax_Verificar_Usuario_Modificar(cod.value,nom.value,ape.value,usu.value,pas.value,niv.value,seguridad,habilita,sit.value);
									
								}else{
									alert("Debe seleccionar el nivel de seguridad !!!");
									foco('cmb_seg_nivel'); 
								}
							}else{
								alert("Debe escribir una contraseña !!!");
								foco('seg_pass'); 
							}
						}else{
							alert("Debe escribir el usuario !!!");
							foco('seg_usuario');
						}
					}else{
						alert("Debe colocar el Apellido del usuario !!!");
						foco('seg_apellidos');
					}
				}else{
					alert("Debe colocar el Nombre del usuario !!!");
					foco('seg_nombres');
				}
			}else{
				alert("Debe seleccionar un usuario !!!");
			}
	}
	
	
	// funcion para buscar
	function buscar_seguridad(){

        var nom=document.getElementById('seg_nombres');
		var ape=document.getElementById('seg_apellidos');
		var usu=document.getElementById('seg_usuario');
		var niv=document.getElementById('cmb_seg_nivel');
		var seg=document.getElementById('seg_seguridad_si');
		var hab=document.getElementById('seg_habilita')
		var sit=document.getElementById('seg_situacion');
		
		var habilita=0;
		if (hab.checked){
			habilita=1;	// pide cambio de contraseña al ingresar 
			}else{
			habilita=0;	// no piede cambio de contraseña
		}
		
		var seguridad=0;
		if (seg.checked){
			seguridad=0;	// cuenta habilitada
			}else{
			seguridad=1; //	cuenta deshabilitada
		}
		
        if(nom.value != "" || ape.value != "" || usu.value != "" || niv.value != "0" || sit.value!="2") {
		// alert('usuario= '+usu.value+', dep= '+dep.value+' dir= '+dir.value+' ofi= '+ofi.value+' niv= '+niv.value);
           xajax_Buscar_Seguridad(nom.value,ape.value,usu.value,niv.value,seguridad,habilita,sit.value);
		}else{
			alert('debe seleccionar un parametro de busqueda');
		}
    }
	
	// funcion para buscar usuarios
		function buscar_seguridad_sel(cod){
        // alert('trae el codigo='+cod);
        //
        if(cod>0) {
			// alert('entra');
           xajax_Trae_Datos_Sel(cod);
        }else{
            alert("Debe seleccionar algun campo de busqueda!!!");
        }
    }
	
		function aut_user(){
			var usu=document.getElementById('usu');
			var pass=document.getElementById('pass');
			var trae=document.getElementById('intentos');
			var user=document.getElementById('user');
			
			if (usu.value!="" && pass.value!=""){
					// alert ('Usted ha excedido el limite de intentos permitidos, \n Su cuenta ha sido bloqueada temporalmente \n Pongase en contacto con el Administrador');
				xajax_Verificar_Seguridad(usu.value,pass.value,trae.value,user.value);
				
			}else{
				alert('Debes llenar todos los campos !!!')
			}
		}
		
		function coloca_pass(){
			// alert('entro a colocar');
			var usu=document.getElementById('seg_usuario');
			var pass=document.getElementById('seg_pass');
			var pass_ant=document.getElementById('seg_pass_ant');
			user=usu.value;
			if(seg_habilita.checked){
				pass_ant.value=pass.value;
				pass.value=user;
			}else{
				pass.value=pass_ant.value;
				
			}
		}
		
		
		function check_user(user){
			var guardar=document.getElementById('grabar_seguridad');
			var cod=document.getElementById('seg_codigo');
			
			if(user!=''){
				// // alert(grabar);
				if (guardar.style.display=="none"){
					// alert('entra a buscar con modificar='+cod.value);
					xajax_Check_User_Mod(user,cod.value);
				}else if(guardar.style.display==""){
					// alert('entro a buscar con guardar');
					xajax_Check_User(user);
				}
			}
		}