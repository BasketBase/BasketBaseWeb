$(function(){
	$("tr").click(function(e){
		e.preventDefault();

		if(typeof($(this).attr("not"))!=undefined){
			console.log($(this).attr("not"));
		}
	});
});