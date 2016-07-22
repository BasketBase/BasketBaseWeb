$(function(){
	$(".cImg").click(function(e){
		e.preventDefault();

		$(".modal").modal();
	});

	$(".imgPerfil img").click(function(e){
		e.preventDefault();

		$(".imgPerfil[actual]").removeAttr('actual');
		$(this).parent().attr('actual', true);
	});

	$(".subir").click(function(e){
		e.preventDefault();

		$("#upload").click();
	});

	$("#upload").change(function(){
		var file_data = $(this).prop("files")[0];
		obj_file = new FormData();                  
    	obj_file.append("file", file_data);

		var file=$(this)[0].files[0];
		var tipo=["image/png", "image/jpg", "image/jpeg"];

		var img = new Image();

        img.src = window.URL.createObjectURL(file);
        img.onload = function() {
            var width = img.naturalWidth;

            if(width>100){
            	console.log("La imagen no puede tener mas de 100px de ancho para que se visualice bien. Disculpe las molestias.");
            }
            else{
            	var found=false;
            	tipo.forEach(function(item, index){
            		if(item==file.type){
            			found=true;
            		}
            	});

            	if(!found){
            		console.log("Sólo se pueden subir archivos .jpg o .png. Disculpe las molestias.");
            	}
            	else{
            		$.ajax({
				        type: 	'POST',
				        url: 	'/BasketBaseWeb/php/ajustes/usuario/imagen.php',
				        dataType: 'text',
		                cache: false,
		                contentType: false,
		                processData: false,
				        data: 	obj_file,
				        success:function(data){
				        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes.php";
				        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes.php";
				        },
				        error: function(data){
				        	switch(data.status){
				        		case 400:
				        			//window.location.href = "http://dev.basketbaseweb.com/errors/400";
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/400.php";
				        		break;
				        		case 401:
				        			//window.location.href = "http://dev.basketbaseweb.com/errors/401";
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/401.php";
				        		break;
				        		case 403:
				        			//window.location.href = "http://dev.basketbaseweb.com/errors/403";
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/403.php";
				        		break;
				        		case 404:
				        			//window.location.href = "http://dev.basketbaseweb.com/errors/404";
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/404.php";
				        		break;
				        		case 500:
				        			//window.location.href = "http://dev.basketbaseweb.com/errors/500";
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/500.php";
				        		break;
				        	}
				        }
				    });
            	}
            }
        };
	});
});