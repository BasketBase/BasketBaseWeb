var codigo, equipo, rival, fecha, hora, jornada, pabellon;

$(function(){
	codigo=location.search.split('equipo=')[1];
	$(".escoEquipo").click(function(e){
		e.preventDefault();

		$(".modalEquipo").modal();
	});

	$(".modalEquipo .modal-body .equipo").click(function(e){
		$("#auth_rival").val($(this).text()).attr("cod", $(this).attr('cod'));
		$(".modalEquipo").modal('hide');
		setSuccess("#rival");
	});

	$(".escoPabe").click(function(e){
		e.preventDefault();

		$(".modalPabe").modal();
	});

	$(".modalPabe .modal-body .pabellon").click(function(e){
		$("#auth_pabellon").val($(this).text()).attr("cod", $(this).attr('cod'));
		$(".modalPabe").modal('hide');
	});

	$(".esc").click(function(e){
		e.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/partidos/anadirEquipo.php',
	        data: 	"nombre="+$("#auth_equipo").val()
	        ,success:function(data){
	        	switch(data){
	        		case "nombre":
	        			errorInsert(data, $("#auth_equipo").val());
	        		break;
	        		default:
	        			$("#auth_rival").val($("#auth_equipo").val()).attr("cod", data);
						$(".modal").modal('hide');
						setSuccess("#rival");
	        		break;
	        	};
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});

	$("#auth_fecha").keyup(function(letter){
		var letra=letter.key;
		var fecha=$(this).val();
		var lon=fecha.length;

		if(!$.isNumeric(letra)){
			if(letra!="Shift" && letra!="Alt" && letra!="Control" && letra!="AltGraph" && letra!="Backspace"){
				$(this).val(fecha.substr(0, fecha.length-1));
			}
			else if(fecha.length==1 && letra=="/"){
				$(this).val(fecha.substr(0, fecha.length-1));
			}
		}
		else{
			if(lon==2){
				if(fecha<1 || fecha>31){
					$(this).val("");
				}
				else{
					$(this).val(fecha+"/");
				}
			}
			else if(lon==5){
				var fechaSplit=fecha.split("/");
				var dia=fechaSplit[0];
				var mes=fechaSplit[1];
				console.log(mes);
				if(mes<1 || mes>12){
					$(this).val(dia+"/");
				}
				else{
					$(this).val(fecha+"/");
				}
			}
		}
	});

	$("#auth_hora").keyup(function(letter){
		hora=$(this).val();
		if(!$.isNumeric(letter.key)){
			if(letter.key!="Shift" && letter.key!="Alt" && letter.key!="Control" && letter.key!="AltGraph" && letter.key!="Backspace"){
				$(this).val(hora.substr(0, hora.length-1));
			}
			else if(hora.length==1){
				$(this).val(hora.substr(0, hora.length-1));
			}
		}
		else{
			if(hora.length==2){
				$(this).val(hora+":");
			}
		}
	});

	$(".addPartido").click(function(e){
		e.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/partidos/anadir.php',
	        data: 	"codigo="+codigo+
	        		"&equipo="+$("#auth_local").prop('checked')+
	        		"&rival="+$("#auth_rival").attr('cod')+
	        		"&fecha="+$("#auth_fecha").val()+
	        		"&hora="+$("#auth_hora").val()+
	        		"&jornada="+$("#auth_jornada").val()+
	        		"&pabellon="+$("#auth_pabellon").attr('cod')
	        ,success:function(data){
	        	if(data!=""){
	        		console.log(data);
	        	}
	        	else{
	        		//window.location.href = "http://dev.basketbaseweb.com/pages/ajustes/equipo/partidos.php?equipo="+codigo;
					window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes/equipo/partidos.php?equipo="+codigo;
	        	}
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

	$(".addPartido").prop("disabled", true);
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
		$(".addPartido").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe como club.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}