<?php
	include "config.php";

	$dni=$_POST["dni"];
	$nick=utf8_decode($_POST["nick"]);
	$email=utf8_decode($_POST["email"]);
	$nombre=utf8_decode($_POST["nombre"]);
	$ape1=utf8_decode($_POST["ape1"]);
	$ape2=utf8_decode($_POST["ape2"]);
	$pass=md5(md5($_POST["pass"]));

	if(buscar_campo("dni", $dni)!=false){
		if(buscar_campo("nick", $nick)!=false){
			if(buscar_campo("email", $email)!=false){
				$qry="INSERT INTO usuarios (dni, nick, email, nombre, ape1, ape2, pass) VALUES ('".$dni."', '".$nick."', '".$email."', '".$nombre."', '".$ape1."', '".$ape2."', '".$pass."')";

				$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");

				$to      = 	$email;
				$subject = 	'¡Bienvenido a Basket Base!';
				$message = '<html>
								<head>
									<title>Basket Base</title>
								</head>
								<body>
									<div>
										Gracias por registraste en la comunidad de Basket Base.
										<br/><br/>
										Puedes iniciar sesión en el siguiente enlace: <a href="http://basketbaseweb.com/pages/login">Inicia Sesión</a>
										<br/><br/>
										Tu nick es: '+$nick+'
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
	}
	else{
		echo "dni";
	}



	function buscar_campo($campo, $valor){
		include "config.php";
		
		$qry="SELECT ".$campo." FROM usuarios WHERE ".$campo." = '".$valor."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>