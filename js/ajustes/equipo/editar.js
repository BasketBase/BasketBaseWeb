var codigo, nombre, hora, camiLoc, camiVis;

$(function(){
	codigo=location.search.split('equipo=')[1];

	$(".borraEquipo").click(function(e){
		e.preventDefault();

		$('.modalDelete').modal();
	});

	$(".confirm").click(function(e){
		e.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/equipo/borrar.php',
	        data: 	'codigo='+codigo,
	        success:function(data){
	        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/lista.php?club="+data;
	        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/lista.php?club="+data;
	        },
	        error: function(data){
	        	console.log(data);
	        	showAlert("<strong>¡ERROR!</strong> "+data.statusText, "danger");
	        }
	    });
	});

	$(".editaEquipo").click(function(ev){
		ev.preventDefault();

		camiLoc=$("#auth_camiLoc").val().trim();
		camiVis=$("#auth_camiVis").val().trim();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/equipo/editar.php',
	        data: 	"nombre="+nombre+
	        		"&codigo="+codigo+
	        		"&hora="+hora+
	        		"&camiLoc="+camiLoc+
	        		"&camiVis="+camiVis
	        ,success:function(data){
	        	//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/partidos.php?equipo="+codigo;
	        	window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/partidos.php?equipo="+codigo;
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
    	});
	});

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
});

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".editaEquipo").prop("disabled", true);
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
		$(".editaEquipo").prop("disabled", false);
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