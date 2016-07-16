<?php
	include "../../config.php";

	$ruta="/BasketBaseWeb/img/user/";

	$login=$_COOKIE["user"];

	$qry="SELECT dni FROM usuarios
						   WHERE dni = '".$login."'
						   OR 	 nick = '".$login."'
						   OR 	 email = '".$login."'";

	$res=mysqli_query($con, $qry) or die ($qry);

	$dni=mysqli_fetch_assoc($res)["dni"];

	$ruta=$ruta.$dni."/";

	$tipo="";

	switch($_POST["tipo"]){
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

	echo $tipo;

	if(!isdir($ruta)){
		mkdir($ruta);
		move_uploaded_file($_POST['ruta'], $ruta."0".$tipo);
	}
	else{
		$filecount = 0;
		$files = glob($ruta . "*");

		if($files){
			$filecount = count($files);
		}

		move_uploaded_file($_POST['ruta'], $ruta.$filecount.$tipo);
	}
?>