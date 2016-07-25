var dni, pass, repPass;

$(function(){
	$("#auth_repPass").hide();
	$(".editPass").hide();
	$("#auth_pass").focus();

	preCambio();

	$(".sigue").click(function(event){
		event.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/usuario/contrasena.php',
	        data: 	"sigue="+pass
	        ,success:function(data){
	        	if(data!=0){
	        		$("#auth_repPass").show();
					$(".editPass").show();
					$("#auth_pass").val("");
					$("#auth_pass").focus();
					$(".sigue").hide();
	        	}
	        	else{
	        		showError(".pass-confirm", "#pass");
	        		$("#auth_pass").focus();
	        	}
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});

	$(".editPass").click(function(event){
		event.preventDefault();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/usuario/contrasena.php',
	        data: 	"pass="+pass
	        ,success:function(data){
    			//window.location.href="http://dev.basketbaseweb.com/pages/ajustes";
    			window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes.php";
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});
});





function preCambio(){
	//Control de la contraseña
	$("#auth_pass").focusout(function(){
		pass=$(this).val().trim();

		checkPass(pass);
	});

	$("#auth_repPass").keyup(function(){
		repPass=$(this).val().trim();

		if(checkPass(pass)){
			if(repPass===pass){
				setSuccess("#pass");
			}
			else{
				showError(".pass-repeat", "#pass");
			}
		}
	});
}

function checkPass(pass){
	if(/^(?=.*\d)(?=.*[a-z]).{6,15}$/.test(pass)){
		setSuccess("#pass");
		return true;
	}
	else{
		showError(".pass-format", "#pass");
	}
}

function showError(error, input){
	hideError(input+" .error", input);
	$(error).show();
	$(input).addClass("has-error")
			.removeClass("has-success")
			.css("color", "red");

	$(".registro").prop("disabled", true);
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

	if($(".has-success").length>=6){
		$(".registro").prop("disabled", false);
	}
}

function errorInsert(campo, valor){
	$(".campo-error").text("El "+campo+" '"+valor+"' ya existe.");
	showError(".campo-error", "#"+campo);
	$("#auth_"+campo).val("").focus();
}