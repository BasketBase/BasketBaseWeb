var dni, nick, email, nombre, ape1, ape2, show;

$(function(){
	$("#auth_nick").focus();

	iniciarDatos();

	preEdicion();

	$(".edita").click(function(event){
		event.preventDefault();

		ape2=$("#auth_ape2").val().trim();

		show=$("#showName .radio input:checked").val();

		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/ajustes/usuario/editar.php',
	        data: 	"dni="+dni+
	        		"&nick="+nick+
	        		"&email="+email+
	        		"&nombre="+nombre+
	        		"&ape1="+ape1+
	        		"&ape2="+ape2+
	        		"&show="+show
	        ,success:function(data){
	        	switch(data){
	        		case "nick":
	        			errorInsert(data, nick);
	        		break;
	        		case "email":
	        			errorInsert(data, email);
	        		break;
	        		default:
	        			//window.location.href="http://dev.basketbaseweb.com/pages/ajustes";
	        			window.location.href = "http://localhost/BasketBaseWeb/pages/ajustes.php";
	        		break;
	        	}
	        },
	        error: function(data){
	        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
	        }
	    });
	});
});







function iniciarDatos(){
	dni=$("#auth_dni").val().trim();
	nick=$("#auth_nick").val().trim();
	email=$("#auth_email").val().trim();
	nombre=$("#auth_nombre").val().trim();
	ape1=$("#auth_ape1").val().trim();
	ape2=$("#auth_ape2").val().trim();
}

function preEdicion(){
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
}

function checkEmail(email){
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		setSuccess("#email");
	}
	else{
		showError(".email-format", "#email");
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