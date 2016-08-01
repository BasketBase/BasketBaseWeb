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
});