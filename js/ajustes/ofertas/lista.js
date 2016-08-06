$(function(){
	$("tr").click(function(e){
		e.preventDefault();

		var patro=location.search.split("patro=")[1];

		if(typeof($(this).attr("ofe"))!='undefined'){
			//window.location.href="http://dev.basketbaseweb.com/pages/ajustes/ofertas/editar.php?oferta="+$(this).attr("ofe")+"&patro="+patro;
			window.location.href="http://localhost/BasketBaseWeb/pages/ajustes/ofertas/editar.php?oferta="+$(this).attr("ofe")+"&patro="+patro;
		}
	});

	$(".addAdmin").click(function(e){
		e.preventDefault();

		$(".modal").modal();
	});

	$(".selec").click(function(e){
		e.preventDefault();

		var users=[];

		$(".modal input").each(function(){
			var user={};

			user.dni=$(this).val();
			user.check=$(this).prop("checked");

			users.push(user);
		});

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/servicio/permisos.php',
	        data: 	"users="+JSON.stringify(users)+
	        		"&patro="+location.search.split('patro=')[1]
	        ,success:function(data){
	        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/ofertas/lista.php?patro="+location.search.split('patro=')[1];
				window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/ofertas/lista.php?patro="+location.search.split('patro=')[1];
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});

	seeker(
		'/BasketBaseWeb/php/ajustes/ofertas/lista.php?patro='+location.search.split('patro=')[1],
		'/BasketBaseWeb/pages/ajustes/ofertas/editar.php?oferta=',
		'//'
	);
});