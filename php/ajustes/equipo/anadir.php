<?php
	include "../../config.php";

	$club=$_POST["club"];
	$nombre=utf8_decode($_POST["nombre"]);
	$hora=$_POST["hora"];
	$camiLoc=$_POST["camiLoc"];
	$camiVis=$_POST["camiVis"];

	if(buscar_campo("nombre", $club)!=false){
		$qry="INSERT INTO equipos (nombre, club, hora_juego, cami_loc, cami_vis) 
		VALUES ('".$nombre."', ".$club.", '".$hora."', '".$camiLoc."', '".$camiVis."')";

		$res=mysqli_query($con, $qry) or die($qry);
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