<?php
	include "../../config.php";

	$nombre=utf8_decode($_POST["nombre"]);

	if(buscar_campo("nombre", $nombre)!=false){
		$qry="INSERT INTO equipos (nombre) VALUES ('".$nombre."')";

		mysqli_query($con, $qry) or die($qry);

		$qry="SELECT codigo FROM equipos WHERE nombre='".$nombre."'";
		$res=mysqli_query($con, $qry) or die($qry);
		echo mysqli_fetch_assoc($res)['codigo'];
	}
	else{
		echo "nombre";
	}



	function buscar_campo($campo, $valor){
		include "../../config.php";
		
		$qry="SELECT ".$campo." FROM equipos WHERE ".$campo." = '".$valor."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}
?>