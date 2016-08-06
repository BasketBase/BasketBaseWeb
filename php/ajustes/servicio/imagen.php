<?php
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

	$logoArray=explode(" ", $_POST["nombre"]);
	$logo=implode("_", $logoArray);

	move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/BasketBaseWeb/img/patros/".$logo.$tipo);
?>