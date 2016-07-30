var nombre, hora, camiLoc, camiVis, club;

$(function(){
	club=location.search.split('club=')[1];
	$("#auth_nombre").focus();

	$("#auth_nombre").keyup(function(){
		nombre=$(this).val().trim();

		if(nombre.length<=0){
			showError(".nombre-lon", "#nombre");
		}
		else{
			setSuccess("#nombre");
		}
	});

	$("#auth_hora").keyup(function(letter){
		hora=$(this).val();
		if(!$.isNumeric(letter.key)){
			if(letter.key!=":" && letter.key!="Shift" && letter.key!="Alt" && letter.key!="Control" && letter.key!="AltGraph" && letter.key!="Backspace"){
				$(this).val(hora.substr(0, hora.length-1));
			}
			else if(hora.length==1 && letter.key==":"){
				$(this).val(hora.substr(0, hora.length-1));
			}
		}
		else{
			if(hora.length==2){
				$(this).val(hora+":");
			}
		}
	});

	$(".altaEquipo").click(function(ev){
		ev.preventDefault();

		hora=$("#auth_hora").val();
		camiLoc=$("#auth_camiLoc").val();
		camiVis=$("#auth_camiVis").val();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/equipo/anadir.php',
	        data: 	"nombre="+nombre+
	        		"&club="+club+
	        		"&hora="+hora+
	        		"&camiLoc="+camiLoc+
	        		"&camiVis="+camiVis
	        ,success:function(data){
	        	switch(data){
	        		case "nombre":
	        			errorInsert(data, nombre);
	        		break;
	        		default:
	        			//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/lista.php?club="+club;
					    window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/lista.php?club="+club;
	        		break;
	        	};
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});
});

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".altaEquipo").prop("disabled", true);
}

function hideError(error, input){
	$(error).hide();
	$(input).removeClass("has-error")
			.removeClass("has-success")
			.css("color", "black");
}

function setSuccess(input){
	hideError(input+" .error", input);
	$(input).addClass("has-success")
			.css("color", "green");

	if($(".has-success").length>=1){
		$(".altaEquipo").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe como equipo.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}

function checkHora(valor){
	var horaSplit=valor.split(":");

	if(horaSplit[0]>24 || horaSplit[0]<0){
		showError(".hora-format", "#nombre");
	}
}