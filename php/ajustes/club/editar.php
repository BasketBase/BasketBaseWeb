<?php
	include "../../config.php";

	$nombre=$_POST["nombre"];
	$url=utf8_decode($_POST["url"]);
	$email=utf8_decode($_POST["email"]);
	$direccion=utf8_decode($_POST["direccion"]);
	$facebook=utf8_decode($_POST["facebook"]);
	$telefono=utf8_decode($_POST["telefono"]);

	if(buscar_campo("nombre", $nombre)!=false){
		$tipo="";

		switch($_POST["tipoLogo"]){
			case "image/png":
				$tipo=".png";
			break;
			case "image/jpg":
				$tipo=".jpg";
			break;
			case "image/jpeg":
				$tipo=".jpeg";
			break;
		}

		$logoArray=explode(" ", $nombre);
		$logo=implode("_", $logoArray);

		$qry="UPDATE clubs 
			  SET nombre='".$nombre."',
			  	  url='".$url."',
			  	  email='".$email."',
			  	  direccion='".$direccion."',
			  	  facebook='".$facebook."',
			  	  telefono='".$telefono."',
			  	  logo='".$logo.$tipo."'
			  WHERE codigo=".$_POST['club'];

		$res=mysqli_query($con, $qry) or die(mysqli_error($res));

		$to      = 	$email;
		$subject = 	'Los datos de '.$nombre.' han sido editados.';
		$message = '<html>
						<head>
							<title>Basket Base</title>
						</head>
						<body>
							<div>
								Si usted no ha cambiado los datos de '.$nombre.', por favor reenvíenos este correo.
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
		echo "nombre";
	}



	function buscar_campo($campo, $valor){
		include "../../config.php";
		
		$qry="SELECT ".$campo." FROM clubs WHERE ".$campo." = '".$valor."' AND codigo!=".$_POST['club'];
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>