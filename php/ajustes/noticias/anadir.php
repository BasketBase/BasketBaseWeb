<?php
	include "../../config.php";

	$club=$_POST["club"];
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

	$qry="INSERT INTO noticias (titulo, imagen, subtitulo, cuerpo, url, club) 
	VALUES ('".$titulo."', '".$img.$tipo."', '".$subtitulo."', '".$cuerpo."', '".$url."', '".$club."')";

	$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");
?>