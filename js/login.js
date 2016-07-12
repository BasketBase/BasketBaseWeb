var login, pass;

$(function(){
	$("#auth_login").focus();

	$("#auth_login").keyup(function(){
		login=$(this).val().trim();

		if(login.length<=0){
			showError(".login-format", "#login");
		}
		else{
			setSuccess("#login");
		}
	});

	$("#auth_pass").keyup(function(){
		pass=$(this).val().trim();

		if(pass.length<=0){
			showError(".pass-format", "#pass");
		}
		else{
			setSuccess("#pass");
		}
	});

	$(".login").click(function(ev){
		ev.preventDefault();
		$.ajax({
	        type: 	'POST',
	        url: 	'/BasketBaseWeb/php/login.php',
	        data: 	"log="+login+
	        		"&pass="+pass+
	        		"&noClose="+$("#no-close input").prop('checked')
	        ,success:function(data){
	        	console.log(data);
	        	switch(data){
	        		case "400":
	        			showError(".pass-error", "#pass");
	        		break;
	        		case "404":
	        			showError(".login-error", "#login");
	        		break;
	        		case "200":
	        			//window.location.href = "http://dev.basketbaseweb.com";
	        			window.location.href = "http://localhost/BasketBaseWeb/";
	        		break;
	        	}
	        },
	        error: function(data){
	        	console.log(data);
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

	$(".login").prop("disabled", true);
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

	if($(".has-success").length>=2){
		$(".login").prop("disabled", false);
	}
}