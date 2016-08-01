<?php
	include "../../config.php";

	$equipo=$_POST['codigo'];
	$isLocal=$_POST['equipo'];
	$rival=$_POST['rival'];
	$fecha=$_POST['fecha'];
	$hora=$_POST['hora'];
	$jornada=$_POST['jornada'];
	$pabellon=$_POST['pabellon'];

	$qry="";
	if($isLocal==true){
		$qry="INSERT INTO partidos(local, visitante, fecha, hora, jornada, pabellon) VALUES (".$equipo.", ".$rival.", '".$fecha."', '".$hora."', ".$jornada.", ".$pabellon.")";
	}
	else{
		$qry="INSERT INTO partidos(local, visitante, fecha, hora, jornada, pabellon) VALUES (".$rival.", ".$equipo.", '".$fecha."', '".$hora."', ".$jornada.", ".$pabellon.")";
	}

	$res=mysqli_query($con, $qry) or die($qry);
?>