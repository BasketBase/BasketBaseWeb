<?php
	include "../../config.php";

	$codigo=$_POST["codigo"];
	$nombre=utf8_decode($_POST["nombre"]);
	$hora=$_POST["hora"];
	$camiLoc=$_POST["camiLoc"];
	$camiVis=$_POST["camiVis"];

	$qry="UPDATE equipos SET 
			nombre='".$nombre."',
			hora_juego='".$hora."',
			cami_loc='".$camiLoc."',
			cami_vis='".$camiVis."'
			WHERE codigo=".$codigo;

	$res=mysqli_query($con, $qry) or die("Error en el servidor. Inténtelo más tarde.");
?>