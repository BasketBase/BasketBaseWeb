var club, titulo, subtitulo, url, cuerpo, rutaImg, tipoImg, obj_file;

$(function(){
	club=location.search.split('club=')[1];
	$("#auth_titulo").focus();

	$("#auth_titulo").keyup(function(){
		titulo=$(this).val().trim();

		if(titulo.length<=0){
			showError(".titulo-lon", "#titulo");
		}
		else{
			setSuccess("#titulo");
		}
	});

	$(".addNotice").click(function(ev){
		ev.preventDefault();

		subtitulo=$("#auth_subtitulo").val().trim();
		url=$("#auth_url").val().trim();
		cuerpo=$("#auth_cuerpo").val().trim();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/noticias/anadir.php',
	        data: 	"titulo="+titulo+
	        		"&club="+club+
	        		"&subtitulo="+subtitulo+
	        		"&url="+url+
	        		"&cuerpo="+cuerpo+
	        		"&tipoImg="+tipoImg
	        ,success:function(data){
	        	if(obj_file!=null){
	        		obj_file.append("club", club);
	    			$.ajax({
				        type: 	'POST',
				        url: 	'/BasketBaseWeb/php/ajustes/noticias/imagen.php',
				        dataType: 'text',
		                cache: false,
		                contentType: false,
		                processData: false,
				        data: 	obj_file,
				        success:function(data){
				        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/club/noticias.php?club="+club;
				        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/club/noticias.php?club="+club;
				        },
				        error: function(data){
				        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
				        }
				    });
	        	}
	        	else{
	        		//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/club/noticias.php?club="+club;
				    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/club/noticias.php?club="+club;
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
});

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".addNotice").prop("disabled", true);
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
		$(".addNotice").prop("disabled", false);
	}
}