<?php
	include "../../config.php";

	$codigo=$_POST["codigo"];
	$titulo=utf8_decode($_POST["titulo"]);
	$subtitulo=utf8_decode($_POST["subtitulo"]);
	$cuerpo=utf8_decode($_POST["cuerpo"]);
	$url=$_POST["url"];

	$tipo="";

	switch($_POST["tipoImg"]){
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

	$imgArray=explode(" ", $nombre);
	$img=implode("_", $imgArray);

	$qry="UPDATE noticias SET 
			titulo='".$titulo."', 
			imagen='".$img.$tipo."',
			subtitulo='".$subtitulo."',
			cuerpo='".$cuerpo."', 
			url='".$url."'
			WHERE codigo=".$codigo;

	$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");

	$qry="SELECT club FROM noticias WHERE codigo=".$codigo;
	$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");
	echo mysqli_fetch_assoc($res)['club'];
?>