var nombre, url, facebook, direccion, telefono, email, rutaLogo, tipoLogo;

$(function(){
	$("#auth_nombre").focus();

	preEdicion();

	$("#auth_nombre").keyup(function(){
		nombre=$(this).val().trim();

		if(nombre.length<=0){
			showError(".nombre-lon", "#nombre");
		}
		else{
			setSuccess("#nombre");
		}
	});

	$(".editaClub").click(function(event){
		event.preventDefault();

		iniciarDatos();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/club/editar.php',
	        data: 	"nombre="+nombre+
	        		"&url="+url+
	        		"&facebook="+facebook+
	        		"&direccion="+direccion+
	        		"&telefono="+telefono+
	        		"&email="+email+
	        		"&tipoLogo="+tipoLogo+
	        		"&club="+location.search.split('club=')[1]
	        ,success:function(data){
	        	switch(data){
	        		case "nombre":
	        			errorInsert(data, nombre);
	        		break;
	        		default:
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
					        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/lista.php?club="+location.search.split('club=')[1];
					        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/lista.php?club="+location.search.split('club=')[1];

					        },
					        error: function(data){
					        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
					        }
					    });
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







function iniciarDatos(){
	nombre=$("#auth_nombre").val().trim();
	url=$("#auth_url").val().trim();
	facebook=$("#auth_facebook").val().trim();
	direccion=$("#auth_direccion").val().trim();
	telefono=$("#auth_telefono").val().trim();
	email=$("#auth_email").val().trim();
}

function preEdicion(){
	//Control del nick
	$("#auth_nombre").keyup(function(){
		nombre=$(this).val().trim();

		if(nombre.length<=0){
			showError(".nombre-lon", "#nombre");
		}
		else{
			setSuccess("#nombre");
		}
	});
}

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".registro").prop("disabled", true);
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

	if($(".has-success").length>=6){
		$(".registro").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}