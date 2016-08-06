<?php
	include "../../config.php";

	$oferta=$_POST["oferta"];
	$patro=$_POST["patro"];
	$mensaje=utf8_decode($_POST["mensaje"]);
	$url=$_POST["url"];
	$fechaFin=$_POST["fecha"];

	$qry="UPDATE ofertas SET
			mensaje='".$mensaje."', 
			url='".$url."',
			fecha_fin='".$fechaFin."'
		WHERE codigo=".$oferta;

	$res=mysqli_query($con, $qry) or die($qry);

	$qryP="SELECT nombre FROM patrocinadores WHERE codigo='".$patro."'";
	$resP=mysqli_query($con, $qryP) or die("Error en el servidor. Inténtelo más tarde.");
	echo mysqli_fetch_assoc($resP)["nombre"];
?>