var cp, nombre, url, facebook, direccion, telefono, email, rutaLogo, tipoLogo, obj_file;

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

	$(".altaClub").click(function(ev){
		ev.preventDefault();

		url=$("#auth_url").val();
		facebook=$("#auth_facebook").val();
		direccion=$("#auth_direccion").val();
		telefono=$("#auth_telefono").val();
		email=$("#auth_email").val();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/club/anadir.php',
	        data: 	"nombre="+nombre+
	        		"&cp="+cp+
	        		"&url="+url+
	        		"&facebook="+facebook+
	        		"&direccion="+direccion+
	        		"&telefono="+telefono+
	        		"&email="+email+
	        		"&tipoLogo="+tipoLogo
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
						        url: 	'/BasketBaseWeb/php/ajustes/club/logo.php',
						        dataType: 'text',
				                cache: false,
				                contentType: false,
				                processData: false,
						        data: 	obj_file,
						        success:function(data){
						        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/club/lista.php?prov="+cp;
						        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/club/lista.php?prov="+cp;

						        },
						        error: function(data){
						        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
						        }
						    });
	        			}
	        			else{
	        				//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/club/lista.php?prov="+cp;
						    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/club/lista.php?prov="+cp;
	        			}
	        		break;
	        	};
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});

	$("#auth_logo").change(function(){
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

            if(width>175 || height>175){
            	showAlert("<strong>¡ERROR!</strong> La imagen no puede tener mas de 175px de ancho  ni de alto para que se visualice bien. Disculpe las molestias.", "danger");
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
            		rutaLogo=tmppath;
            		tipoLogo=file.type;
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

	$(".altaClub").prop("disabled", true);
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
		$(".altaClub").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe como club.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}