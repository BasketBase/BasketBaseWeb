var mostrarUser=false;

$(function(){
	$("#menu").mouseenter(function(){
		if(mostrarUser){
			$(".user-menu").show();
			$(".ajustes").show();
		}

		$(this).animate({width: "300px"}, 150);
		$(".tit-item-menu").css("display", "inline");
	}).mouseleave(function(){
		$(".user-menu").hide();

		$(this).animate({width: "45px"}, 150);
		$(".tit-item-menu").css("display", "none");
	});

	$("#container").height(
		$("#container").height()-
		$("#header").height()-
		$("#foot").height()
	);

	$.ajax({
        type: 	'POST',
        url: 	'/BasketBaseWeb/php/logueado.php',
        data: 	"",
        success:function(data){
        	console.log(data);
        	if(data!=""){
        		$(".login-link").hide();
        		$(".user-image").attr("src", "/BasketBaseWeb/img/user/"+data);
        		mostrarUser=true;
        	}
        },
        error: function(data){
        	console.log(data);
        }
    });

    $("#cerrarSesion").click(function(){
    	$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/logout.php',
	        data: 	"",
	        success:function(data){
	        	location.reload();
	        },
	        error: function(data){
	        	console.log(data);
	        }
	    });
    });
});