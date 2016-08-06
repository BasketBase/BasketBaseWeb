<?php
	include "../../config.php";

	$nombre=utf8_decode($_POST["nombre"]);
	$url=$_POST["url"];
	$facebook=$_POST["facebook"];
	$sector=utf8_decode($_POST["sector"]);
	$ofertas=$_POST["ofertas"];

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

		$logo="";

		if($tipo!=""){
			$logoArray=explode(" ", $nombre);
			$logo=implode("_", $logoArray);
		}

		if($ofertas==""){
			$ofertas=0;
		}

		$qry="UPDATE patrocinadores 
			  SET nombre='".$nombre."',
			  	  url='".$url."',
			  	  sector='".$sector."',
			  	  ofertas=".$ofertas.",
			  	  facebook='".$facebook."',
			  	  imagen='".$logo.$tipo."'
			  WHERE codigo=".$_POST['patro'];

		$res=mysqli_query($con, $qry) or die($qry);
	}
	else{
		echo "nombre";
	}



	function buscar_campo($campo, $valor){
		include "../../config.php";
		
		$qry="SELECT ".$campo." FROM patrocinadores WHERE ".$campo." = '".$valor."' AND codigo!=".$_POST['patro'];
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>