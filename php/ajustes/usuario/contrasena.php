<?php
	include "../../config.php";

	$login=$_COOKIE["user"];

	if(isset($_POST["sigue"])){
		$pass=md5(md5($_POST["sigue"]));

		$qry="SELECT pass FROM usuarios
						   WHERE dni = '".$login."'
						   OR 	 nick = '".$login."'
						   OR 	 email = '".$login."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			if(mysqli_fetch_assoc($res)["pass"]==$pass){
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}
	elseif(isset($_POST["pass"])){
		$pass=md5(md5($_POST["pass"]));
		$qry="UPDATE usuarios 
			  SET pass='".$pass."'
			  WHERE dni = '".$login."'
			  OR 	nick = '".$login."'
			  OR 	email = '".$login."'";

		$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");

		$to      = 	$email;
		$subject = 	'Ha cambiado su contraseña.';
		$message = '<html>
						<head>
							<title>Basket Base</title>
						</head>
						<body>
							<div>
								Si usted no ha cambiado su contraseña, por favor avísenos de inmediato dándonos su número de dni contestando a este correo.
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
?>