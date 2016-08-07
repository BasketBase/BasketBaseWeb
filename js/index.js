$(function(){
	$(".noti").click(function(e){
		e.preventDefault();

		window.location.href="http://localhost/BasketBaseWeb/pages/noticia.php?noticia="+$(this).attr("codigo");
	});
});