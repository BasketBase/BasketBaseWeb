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
		var tmppath = URL.createObjectURL($(this)[0].files[0]);
		var file=$(this)[0].files[0];
		var tipo=["image/png", "image/jpg", "image/jpeg"];

		var img = new Image();

        img.src = window.URL.createObjectURL(file);
        img.onload = function() {
            var width = img.naturalWidth;

            if(width>600){
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
				        data: 	"ruta="+tmppath+
				        		"&tipo="+file.type
				        ,success:function(data){
				        	//window.location.href = "http://dev.basketbaseweb.com/ajustes";
				        	window.location.href = "http://localhost/BasketBaseWeb/ajustes.php";
				        },
				        error: function(data){
				        	switch(data.status){
				        		case 400:
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/400.php";
				        		break;
				        		case 401:
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/401.php";
				        		break;
				        		case 403:
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/403.php";
				        		break;
				        		case 404:
				        			window.location.href = "http://localhost/BasketBaseWeb/errors/404.php";
				        		break;
				        		case 500:
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