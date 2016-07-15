<?php
	include "config.php";

	$dni=$_POST["dni"];
	$nick=utf8_decode($_POST["nick"]);
	$email=utf8_decode($_POST["email"]);
	$nombre=utf8_decode($_POST["nombre"]);
	$ape1=utf8_decode($_POST["ape1"]);
	$ape2=utf8_decode($_POST["ape2"]);

	if(buscar_campo("nick", $nick, $dni)!=false){
		if(buscar_campo("email", $email, $dni)!=false){
			$qry="UPDATE usuarios 
				  SET nick='".$nick."',
				  	  email='".$email."',
				  	  nombre='".$nombre."',
				  	  ape1='".$ape1."',
				  	  ape2='".$ape2."'
				  WHERE dni='".$dni."'";

			$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");
			echo "UPDATE usuarios 
				  SET nick='".$nick."',
				  	  email='".$email."',
				  	  nombre='".$nombre."',
				  	  ape1='".$ape1."',
				  	  ape2='".$ape2."'
				  WHERE dni='".$dni."'";
			$to      = 	$email;
			$subject = 	'Sus datos han sido editados.';
			$message = '<html>
							<head>
								<title>Basket Base</title>
							</head>
							<body>
								<div>
									Si usted no ha cambiado sus datos personales, por favor avísenos de inmediato dándonos su número de dni contestando a este correo.
									<br/><br/>
									Muchas gracias por su colaboración.
								</div>
							</body>
						</html>';
			$headers = "From: Basket Base <soporte@basketbaseweb.com>\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
     		$headers .= "Content-type: text/html\r\n";

			mail($to, $subject, $message, $headers);
		}
		else{
			echo "email";
		}
	}
	else{
		echo "nick";
	}



	function buscar_campo($campo, $valor, $dni){
		include "config.php";
		
		$qry="SELECT ".$campo." FROM usuarios WHERE ".$campo." = '".$valor."' AND dni!='".$dni."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>