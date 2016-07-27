$(function(){
	$("tr").click(function(e){
		e.preventDefault();

		if(typeof($(this).attr("not"))!='undefined'){
			//window.location.href="http://dev.basketbaseweb.com/pages/ajustes/noticias/editar.php?noticia="+$(this).attr("not");
			window.location.href="http://localhost/BasketBaseWeb/pages/ajustes/noticias/editar.php?noticia="+$(this).attr("not");
		}
	});
});