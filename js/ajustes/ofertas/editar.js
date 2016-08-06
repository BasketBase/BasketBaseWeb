var codigo, patro, mensaje, rutaImg, tipoImg, obj_file;

$(function(){
	codigo=location.search.split('oferta=')[1];
	patro=location.search.split('patro=')[1];

	$("#auth_mensaje").focus();

	$("#auth_mensaje").keyup(function(){
		mensaje=$(this).val().trim();

		if(mensaje.length<=0){
			showError(".mensaje-lon", "#mensaje");
		}
		else{
			setSuccess("#mensaje");
		}
	});

	$("#auth_fechaFin").keyup(function(letter){
		var letra=letter.key;
		var fecha=$(this).val();
		var lon=fecha.length;

		if(!$.isNumeric(letra)){
			if(letra!="Shift" && letra!="Alt" && letra!="Control" && letra!="AltGraph" && letra!="Backspace"){
				$(this).val(fecha.substr(0, fecha.length-1));
			}
			else if(fecha.length==1 && letra=="/"){
				$(this).val(fecha.substr(0, fecha.length-1));
			}
		}
		else{
			if(lon==2){
				if(fecha<1 || fecha>31){
					$(this).val("");
				}
				else{
					$(this).val(fecha+"/");
				}
			}
			else if(lon==5){
				var fechaSplit=fecha.split("/");
				var dia=fechaSplit[0];
				var mes=fechaSplit[1];
				console.log(mes);
				if(mes<1 || mes>12){
					$(this).val(dia+"/");
				}
				else{
					$(this).val(fecha+"/");
				}
			}
		}
	});

	$(".editOferta").click(function(e){
		e.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/ofertas/editar.php',
	        data: 	"oferta="+codigo+
	        		"&mensaje="+$("#auth_mensaje").val()+
	        		"&fecha="+$("#auth_fechaFin").val()+
	        		"&url="+$("#auth_url").val()
	        ,success:function(data){
	        	if(obj_file!=null){
    				obj_file.append("patro", data);
    				obj_file.append("codPatro", patro);
        			$.ajax({
				        type: 	'POST',
				        url: 	'/BasketBaseWeb/php/ajustes/ofertas/imagen.php',
				        dataType: 'text',
		                cache: false,
		                contentType: false,
		                processData: false,
				        data: 	obj_file,
				        success:function(data){
				        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/ofertas/lista.php?patro="+patro;
				        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/ofertas/lista.php?patro="+patro;

				        },
				        error: function(data){
				        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
				        }
				    });
    			}
    			else{
    				//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/ofertas/lista.php?patro="+patro;
				    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/ofertas/lista.php?patro="+patro;
    			}
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});

	$("#auth_imagen").change(function(){
		var file_data = $(this).prop("files")[0];
		obj_file = new FormData();                  
    	obj_file.append("file", file_data);

		var tmppath = URL.createObjectURL($(this)[0].files[0]);
		var file=$(this)[0].files[0];
		var tipo=["image/png", "image/jpg", "image/jpeg"];

		var img = new Image();

        img.src = window.URL.createObjectURL(file);
        img.onload = function() {
            var width = img.naturalWidth;
            var height = img.naturalHeight;

            if(width>600){
            	showAlert("<strong>¡ERROR!</strong> La imagen no puede tener mas de 600px de ancho para que se visualice bien. Disculpe las molestias.", "danger");
            }
            else{
            	var found=false;
            	tipo.forEach(function(item, index){
            		if(item==file.type){
            			found=true;
            		}
            	});

            	if(!found){
            		showAlert("<strong>¡ERROR!</strong> Sólo se pueden subir archivos .jpg o .png. Disculpe las molestias.", "danger");
            	}
            	else{
            		rutaImg=tmppath;
            		tipoImg=file.type;
            	}
            }
        };
	});

	$(".deleteOfe").click(function(e){
		e.preventDefault();
		$('.modalDelete').modal();
	});

	$(".confirm").click(function(e){
		e.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/ofertas/borrar.php',
	        data: 	'codigo='+codigo,
	        success:function(data){
	        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/ofertas/lista.php?patro="+patro;
	        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/ofertas/lista.php?patro="+patro;
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data.statusText, "danger");
	        }
	    });
	});
});

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".editOferta").prop("disabled", true);
}

function hideError(error, input){
	$(error).hide();
	$(input).removeClass("has-error")
			.removeClass("has-success")
			.css("color", "black");
}

function setSuccess(input){
	hideError(input+" .error", input);
	$(input).addClass("has-success")
			.css("color", "green");

	if($(".has-success").length>=1){
		$(".editOferta").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe como oferta.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}