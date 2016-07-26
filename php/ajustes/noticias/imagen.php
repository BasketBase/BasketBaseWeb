<?php
	include "../../config.php";

	$ruta="/BasketBaseWeb/img/noticias/";

	$login=$_COOKIE["user"];

	$qry="SELECT nombre FROM clubs
						   WHERE codigo = '".$_POST["club"]."'";

	$res=mysqli_query($con, $qry) or die ($qry);
	$club=mysqli_fetch_assoc($res)["nombre"];

	$ruta=$_SERVER['DOCUMENT_ROOT'].$ruta.$club."/";

	$tipo="";

	switch($_FILES["file"]["type"]){
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

	$imagen="";

	if(!is_dir($ruta)){
		mkdir($ruta);
		move_uploaded_file($_FILES["file"]["tmp_name"], $ruta."0".$tipo);
		$imagen='0'.$tipo;
	}
	else{
		$filecount = 0;
		$files = glob($ruta . "*");

		if($files){
			$filecount = count($files);
		}

		move_uploaded_file($_FILES["file"]["tmp_name"], $ruta.$filecount.$tipo);
		$imagen=$filecount.$tipo;
	}

	$qry="UPDATE noticias
		  SET imagen='".$imagen."'
		  WHERE club = '".$_POST['club']."'";

	$res=mysqli_query($con, $qry) or die ($qry);
?>