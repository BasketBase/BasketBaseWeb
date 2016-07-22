<?php
	include "../../config.php";

	$cp=$_POST["cp"];
	$nombre=utf8_decode($_POST["nombre"]);
	$url=$_POST["url"];
	$facebook=$_POST["facebook"];
	$direccion=utf8_decode($_POST["direccion"]);
	$telefono=$_POST["telefono"];
	$email=$_POST["email"];

	if(buscar_campo("nombre", $club)!=false){
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

		$qry="INSERT INTO clubs (nombre, provincia, logo, url, facebook, direccion, telefono, email) 
		VALUES ('".$nombre."', ".$cp.", '".$logo.$tipo."', '".$url."', '".$facebook."', '".$direccion."', '".$telefono."', '".$email."')";

		$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");

		if($email!=""){
			$to      = 	$email;
			$subject = 	'¡Bienvenido a Basket Base!';
			$message = '<html>
							<head>
								<title>Basket Base</title>
							</head>
							<body>
								<div>
									'.$nombre.' bienvenido a la comunidad de Basket Base.
									<br/><br/>
								</div>
							</body>
						</html>';
			$headers = "From: Basket Base <soporte@basketbaseweb.com>\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
	 		$headers .= "Content-type: text/html\r\n";

			mail($to, $subject, $message, $headers);
		}
	}
	else{
		echo "nombre";
	}



	function buscar_campo($campo, $valor){
		include "../../config.php";
		
		$qry="SELECT ".$campo." FROM clubs WHERE ".$campo." = '".$valor."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>