<?php
	include "../../config.php";

	$partido=$_POST['codigo'];
	$local=$_POST['local'];
	$visitante=$_POST['visitante'];
	$fecha=$_POST['fecha'];
	$hora=$_POST['hora'];
	$jornada=$_POST['jornada'];
	$pabellon=$_POST['pabellon'];
	
	$qry="UPDATE partidos
		SET local=".$local.",
			visitante=".$visitante.",
			fecha='".$fecha."',
			hora='".$hora."',
			jornada=".$jornada.",
			pabellon=".$pabellon."
		WHERE codigo=".$partido;

	$res=mysqli_query($con, $qry) or die($qry);
?>