<?php
	include "../../config.php";

	$partido=$_POST['partido'];
	$ptsLoc=$_POST['ptsLoc'];
	$ptsVis=$_POST['ptsVis'];
	
	$qry="UPDATE partidos
		SET resultado='".$ptsLoc." - ".$ptsVis."'
		WHERE codigo=".$partido;

	$res=mysqli_query($con, $qry) or die($qry);
?>