//==========================================================================
//=======================MAYUSCULAS Y NUMEROS================================
//==========================================================================
		function mayusculas_enteros(n){
			//MAYUSCULAS
				cadena = n.value;
				cadena = cadena.toUpperCase();
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if((letra == "'") || (letra == '"') || (letra == 'á') || (letra == 'é') || (letra == 'í') || (letra == 'ó') || (letra == 'ú') || (letra == '´') || (letra == '`') || (letra == 'Á') || (letra == 'É')|| (letra == 'Í')|| (letra == 'Ó')|| (letra == 'Ú') || (letra == 'à')|| (letra == 'è')|| (letra == 'ì')|| (letra == 'ò')|| (letra == 'ù')|| (letra == 'À')|| (letra == 'È')|| (letra == 'Ì')|| (letra == 'Ò')|| (letra == 'Ù')){
						cadena2 = cadena;
						cadena = cadena2.replace(letra,"");
						band = true;
					}
				}
				if(band == true){
					alert("No se permite comillas simples o dobles, ni letras con tildes u otro caracter desconocido...");
				}
				n.value = cadena;
				n.focus();
				
				//NUMEROS
				permitidos=/[^A-Z0-9-]/;
				cadena = n.value;
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				var cont = 0;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(letra == "-"){
						cont++;
						if(cont > 1){
							cadena2 = cadena;
							cadena = cadena2.substring(0,cadena.length-1);
							break;
						}
					}
				}
				if(band == true){
					alert("Solo se permite Mayusculas y Numero enteros");
				}
				n.value = cadena;
				n.focus();	
		}
		
//==========================================================================
//=======================NUMERO ENTEROS=====================================
//==========================================================================
		function enteros(n){
				permitidos=/[^0-9]/;
				cadena = n.value;
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				var cont = 0;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(letra == "-"){
						cont++;
						if(cont > 1){
							cadena2 = cadena;
							cadena = cadena2.substring(0,cadena.length-1);
							break;
						}
					}
				}
				if(band == true){
					alert("Solo se puede ingresar valores numericos enteros sin decimales ni espacios");
				}
				n.value = cadena;
				n.focus();	
		}
		
//==========================================================================
//=======================NUMERO DECIMALES=====================================
//==========================================================================
		function decimales(n){
				permitidos=/[^0-9.]/;
				cadena = n.value;
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				var cont = 0;
				var cont2 = 0;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(letra == "."){
						cont++;
						if(cont > 1){
							cadena2 = cadena;
							//cadena = cadena2.substring(0,cadena.length-1);
							cadena = cadena2.value="";
							break;
						}
					}
					
				}
				if(band == true){
					alert("Solo se puede ingresar valores numericos decimales");
				}
				n.value = cadena;
				n.focus();
		}

//==========================================================================
//========VERIFICACION DE INGRESO DE HORAS Y MINUTOS========================
//==========================================================================
		function tiempo(n,m){
				permitidos=/[^0-9]/;
				cadena = n.value;
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						cadena = cadena2.replace(letra,"");
						band = true;
					}
				}
				n.value = cadena;
				n.focus();
				if(band == true){
					alert("Solo se puede ingresar valores numericos enteros");
				}else{
					if(m == 1){
						if((n.value > 23) || (n.value < 0)){
							alert("El Rango numerico permitido para Horas es entre 0 y 12");
							n.value="";
							n.focus();
						}
					}else if(m == 2){
						if((n.value > 59) || (n.value < 0)){
							alert("El Rango numerico permitido para Minutos es entre 0 y 59");
							n.value="";
							n.focus();
						}
					}else{
						alert("Error de Traslacion de Datos....");
						n.value="";
						n.focus();
					}
				}
		}
		
//==========================================================================
//=======================TEXTO A MAYUSCULAS=================================
//==========================================================================
		function mayusculas(n){
				cadena = n.value;
				cadena = cadena.toUpperCase();
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if((letra == "'") || (letra == '"') || (letra == 'á') || (letra == 'é') || (letra == 'í') || (letra == 'ó') || (letra == 'ú') || (letra == '´') || (letra == '`') || (letra == 'Á') || (letra == 'É')|| (letra == 'Í')|| (letra == 'Ó')|| (letra == 'Ú') || (letra == 'à')|| (letra == 'è')|| (letra == 'ì')|| (letra == 'ò')|| (letra == 'ù')|| (letra == 'À')|| (letra == 'È')|| (letra == 'Ì')|| (letra == 'Ò')|| (letra == 'Ù')){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				if(band == true){
					alert("No se permite ingresar comillas simples o dobles, ni letras con tildes u otro caracter desconocido...");
				}
				n.value = cadena;
				n.focus();	
		}
		
//=========================CORREO ELECTRONICO===============================
//=======================TEXTO A MINUSCULAS=================================
//==========================================================================
		function minusculas(n){
				cadena = n.value;
				cadena = cadena.toLowerCase();
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if((letra == "'") || (letra == '"') || (letra == 'á') || (letra == 'é') || (letra == 'í') || (letra == 'ó') || (letra == 'ú') || (letra == '´') || (letra == '`') || (letra == 'Á') || (letra == 'É')|| (letra == 'Í')|| (letra == 'Ó')|| (letra == 'Ú') || (letra == 'à')|| (letra == 'è')|| (letra == 'ì')|| (letra == 'ò')|| (letra == 'ù')|| (letra == 'À')|| (letra == 'È')|| (letra == 'Ì')|| (letra == 'Ò')|| (letra == 'Ù')){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				if(band == true){
					alert("No se permiten ingresar comillas simples o dobles, ni letras contildes u otro caracter desconocido...");
				}
				n.value = cadena;
				n.focus();	
		}
		
//==========================================================================
//=======================VALIDAR SOLO LETRAS================================
//==========================================================================
		function letras(n){
				permitidos=/[^a-zA-Z]/;
				cadena = n.value;
				cadena = cadena.toUpperCase();
				band = false;
				/*for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						cadena = cadena2.replace(letra,"");
						band = true;
					}
				}*/
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						//cadena = cadena2.value="";
						cadena = cadena2.value="";
						band = true;
					}
				}
				if(band == true){
					alert("Solo se puede ingresar valores alfabeticos sin tildes ni espacios");
				}
				n.value = cadena;
				n.focus();	
		}	
		
//==========================================================================
//=======================VALIDACION PARA NIT================================
//==========================================================================
		function nit(n){
				permitidos=/[^0-9kK-]/;
				cadena = n.value;
				cadena = cadena.toUpperCase();
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(permitidos.test(letra)){
						cadena2 = cadena;
						//cadena = cadena2.replace(letra,"");
						cadena = cadena2.value="";
						band = true;
					}
				}
				var cont = 0;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if(letra == "-"){
						cont++;
						if(cont > 1){
							cadena2 = cadena;
							//cadena = cadena2.replace("-","");
							cadena = cadena2.value="";
						}
					}
				}
				var cont2 = 0;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if((letra == "k") || (letra == "K")){
						cont2++;
						if(cont2 > 1){
							cadena2 = cadena;
							cadena = cadena2.replace("k","");
							cadena = cadena2.replace("K","");
						}
					}
				}
				if(band == true){
					alert("este formato de Numero de Nit no es valido");
				}
				n.value = cadena;
				n.focus();	
		}

//BUSCAR AL PERSONAL
function Enter_buscador(e){
	tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==13) {
		abrir();
		xajax_buscar_Seleccion(xajax.getFormValues('datos'));
	}		
}		