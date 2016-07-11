var dni, nick, email, nombre, ape1, ape2, pass, repPass;

$(function(){
	$("#auth_dni").focus();

	preRegistro();

	$(".registro").click(function(event){
		event.preventDefault();

		ape2=$("#auth_ape2").val().trim();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/registro.php',
	        data: 	"dni="+dni+
	        		"&nick="+nick+
	        		"&email="+email+
	        		"&nombre="+nombre+
	        		"&ape1="+ape1+
	        		"&ape2="+ape2+
	        		"&pass="+pass
	        ,success:function(data){
	        	switch(data){
	        		case "dni":
	        			errorInsert(data, dni);
	        		break;
	        		case "nick":
	        			errorInsert(data, nick);
	        		break;
	        		case "email":
	        			errorInsert(data, email);
	        		break;
	        		default:
	        			//window.location.href="http://dev.basketbaseweb.com/pages/login";
	        			window.location.href = "http://localhost:8080/BasketBaseWeb/pages/login";
	        		break;
	        	}
	        },
	        error: function(data){
	        	console.log(data);
	        }
	    });
	});
});





function preRegistro(){
	//Control del DNI
	$("#auth_dni").keyup(function(){
		$("#auth_dni").val($("#auth_dni").val().toUpperCase());
	}).focusout(function(){
		dni=$(this).val().trim();

		if(dni.length!=9){
			showError(".dni-lon", "#dni");
		}
		else if(!$.isNumeric(dni.substr(0,8))){
			showError(".dni-format", "#dni");
		}
		else{
			checkDNI(dni);
		}
	});

	//Control del nick
	$("#auth_nick").focusout(function(){
		nick=$(this).val().trim();

		if(nick.length<=4){
			showError(".nick-lon", "#nick");
		}
		else{
			setSuccess("#nick");
		}
	});

	//Control del email
	$("#auth_email").focusout(function(){
		email=$(this).val().trim();

		checkEmail(email);
	});

	//Control del nombre
	$("#auth_nombre").focusout(function(){
		nombre=$(this).val().trim();

		if(nombre.length>0){
			setSuccess("#nombre");
		}
		else{
			showError(".nom-lon", "#nombre");
		}
	});

	//Control de los apellidos
	$("#auth_ape1").focusout(function(){
		ape1=$(this).val().trim();

		if(ape1.length>0){
			setSuccess("#apes");
		}
		else{
			showError(".ape-lon", "#apes");
		}
	});

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


function checkDNI(dni){
	var letras="TRWAGMYFPDXBNJZSQVHLCKE";
	var numero=dni.substr(0,8);
	var letraIntro=dni.substr(8,1);
	
	if(letras.charAt(numero%23)!=letraIntro){
		showError(".dni-letra", "#dni");
	}
	else{
		setSuccess("#dni");
	}
}

function checkEmail(email){
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		setSuccess("#email");
	}
	else{
		showError(".email-format", "#email");
	}
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