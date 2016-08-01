$(function(){
	$("tr").click(function(e){
		e.preventDefault();

		if(typeof($(this).attr("part"))!='undefined'){
			$(".modal").attr('partido', $(this).attr("part")).modal();
		}
	});

	$(".edit").click(function(e){
		e.preventDefault();

		//window.location.href="http://dev.basketbaseweb.com/pages/ajustes/partidos/editar.php?partido="+$(this).attr("part")+"&equipo="+location.search.split('equipo=')[1];
		window.location.href="http://localhost/BasketBaseWeb/pages/ajustes/partidos/editar.php?partido="+$(".modal").attr('partido')+"&equipo="+location.search.split('equipo=')[1];
	});

	$(".add").click(function(e){
		e.preventDefault();

		$(".edit").hide();
		$(".add").hide();
		$(".result").show();
		$("#auth_ptsLoc").focus();
	});

	$(".addResult").click(function(e){
		e.preventDefault();

		if($("#auth_ptsLoc").val()==""){
			showAlert("<strong>¡ERROR!</strong> El equipo local ha anotado puntos.", "danger");
		}
		else if($("#auth_ptsVis").val()==""){
			showAlert("<strong>¡ERROR!</strong> El equipo visitante ha anotado puntos.", "danger");
		}
		else{
			$.ajax({
		        type: 	'POST',
		        url: 	'/BasketBaseWeb/php/ajustes/partidos/anadirResultado.php',
		        data: 	"ptsLoc="+$("#auth_ptsLoc").val()+
		        		"&ptsVis="+$("#auth_ptsVis").val()+
		        		"&partido="+$(".modal").attr('partido')
		        ,success:function(data){
		        	switch(data){
		        		case "nombre":
		        			errorInsert(data, nombre);
		        		break;
		        		default:
		        			//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/partidos.php?equipo="+location.search.split('equipo=')[1];
						    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/partidos.php?equipo="+location.search.split('equipo=')[1];
		        		break;
		        	};
		        },
		        error: function(data){
		        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
		        }
		    });
		}
	});
});