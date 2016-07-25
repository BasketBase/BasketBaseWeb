//Buscador que devuelve los resultados con el texto escrito marcado en negrita
var seeker=function(rutaPeticion, rutaEnvio, separador, numberTF){
	$("#seeker").focus().keyup(function(){
		//Obtiene el texto del input cada vez que se teclea una letra.
		var text=$(this).val().trim();
		if(text!=""){
			//Si el último parámetro es true, aceptará los números, si no con esta condición se impide escribir números y no hace la petición
			if(!numberTF && $.isNumeric(text)){
				text="";
			}
			else{
				//Petición POST a la ruta del primer parámetro
				$.ajax({
			        type: 	'POST',
			        url: 	rutaPeticion,
			        data: 	"seek="+text
			        ,success:function(data){
			        	//Separa los datos por los caracteres del tercer parámetro
			        	var arrayData=data.split(separador);
			        	//Borra los datos de la lista(si tenía alguno) y muestra la tabla oculta
			        	$(".results tbody *").remove();
			        	$(".results").show();
			        	//Comprueba que data tiene resultados y, si no, muestra No hay resultados.
			        	if(arrayData.length>1){
			        		//Bucle para recorrer todos los datos devueltos
			        		for(var i=0; i<arrayData.length-1; i=i+2){
			        			//En las próximas líneas se calcula el texto que hay que mostrar en negrita en los resultados.
			        			var textSplit=arrayData[i+1].split(text);
			        			var textBolder="";
			        			for(var j=0; j<textSplit.length; j++){
			        				textBolder+=textSplit[j];

			        				if(j!=textSplit.length-1){
			        					textBolder+="<strong>"+text+"</strong>";
			        				}
			        			}
			        			//Añade los resultados finales ya tratados y monta un enlace a la ruta del segundo parámetro
				        		$(".results tbody").append("<tr><td><a href='"+rutaEnvio+arrayData[i]+"'>"+textBolder+"</a></td></tr>");
				        	}
			        	}
			        	else{
			        		$(".results tbody").append("<tr><td>No hay resultados</td></tr>");
			        	}
			        },
			        error: function(data){
			        	showAlert("<strong>¡ERROR!</strong> "+data, "danger");
			        }
			    });
			}
		}
		else{
			//Si el resultado de obtener el texto del input es ún string vacío, borra los elementos y oculta la tabla.
			$(".results tbody *").remove();
			$(".results").hide();
		}
	});
}

var showAlert=function(text, status){
	$("body").prepend("<div class='alert alert-"+status+"'>"+text+"</div>");
	$(".alert").slideDown("slow");

	window.setTimeout(hideAlert, 6000);
};

var hideAlert=function(){
	$(".alert").fadeOut("slow");
}