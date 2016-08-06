<?php
	include "../../config.php";

	$patro=$_POST["patro"];
	$patroName="";
	$mensaje=utf8_decode($_POST["mensaje"]);
	$url=$_POST["url"];
	$fechaFin=$_POST["fecha"];
	
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

	$qry="INSERT INTO ofertas (mensaje, url, fecha_fin, patrocinador) 
	VALUES ('".$mensaje."', '".$url."', '".$fechaFin."', ".$patro.")";

	$res=mysqli_query($con, $qry) or die($qry);

	$qryP="SELECT nombre FROM patrocinadores WHERE codigo='".$patro."'";
	$resP=mysqli_query($con, $qryP) or die("Error en el servidor. Inténtelo más tarde.");
	echo mysqli_fetch_assoc($resP)["nombre"];
?>