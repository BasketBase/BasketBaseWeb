var cp, nombre, url, facebook, sector, ofertas, email, rutaImg, tipoImg, obj_file;

$(function(){
	cp= location.search.split('prov=')[1];
	$("#auth_nombre").focus();

	$("#auth_nombre").keyup(function(){
		nombre=$(this).val().trim();

		if(nombre.length<=0){
			showError(".nombre-lon", "#nombre");
		}
		else{
			setSuccess("#nombre");
		}
	});

	$(".altaServ").click(function(ev){
		ev.preventDefault();

		url=$("#auth_url").val();
		facebook=$("#auth_facebook").val();
		sector=$("#auth_sector").val();
		ofertas=$("#auth_ofertas").val();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/servicio/anadir.php',
	        data: 	"nombre="+nombre+
	        		"&cp="+cp+
	        		"&url="+url+
	        		"&facebook="+facebook+
	        		"&sector="+sector+
	        		"&ofertas="+ofertas+
	        		"&tipoImg="+tipoImg
	        ,success:function(data){
	        	switch(data){
	        		case "nombre":
	        			errorInsert(data, nombre);
	        		break;
	        		default:
	        			if(obj_file!=null){
	        				obj_file.append("nombre", nombre);
		        			$.ajax({
						        type: 	'POST',
						        url: 	'/BasketBaseWeb/php/ajustes/servicio/imagen.php',
						        dataType: 'text',
				                cache: false,
				                contentType: false,
				                processData: false,
						        data: 	obj_file,
						        success:function(data){
						        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/servicio/lista.php?prov="+cp;
						        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/servicio/lista.php?prov="+cp;

						        },
						        error: function(data){
						        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
						        }
						    });
	        			}
	        			else{
	        				//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/servicio/lista.php?prov="+cp;
						    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/servicio/lista.php?prov="+cp;
	        			}
	        		break;
	        	};
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
});

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".altaServ").prop("disabled", true);
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
		$(".altaServ").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe como servicio.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}