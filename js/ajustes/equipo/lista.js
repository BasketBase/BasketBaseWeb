$(function(){
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
	        url: 	'/BasketBaseWeb/php/ajustes/equipo/permisos.php',
	        data: 	"users="+JSON.stringify(users)+
	        		"&club="+location.search.split('club=')[1]
	        ,success:function(data){
	        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/lista.php?club="+location.search.split('club=')[1];
				window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/lista.php?club="+location.search.split('club=')[1];
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});
});