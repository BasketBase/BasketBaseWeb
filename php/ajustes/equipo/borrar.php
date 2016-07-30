<?php
	include "../../config.php";
	$codigo=$_POST['codigo'];

	if($codigo!=null){
		$qryC="SELECT club FROM equipos WHERE codigo=".$codigo;
		$rowC=mysqli_fetch_assoc(mysqli_query($con, $qryC));

		$qry="DELETE FROM equipos WHERE codigo=".$codigo;
		$res=mysqli_query($con, $qry) or die($qry);

		echo $rowC['club'];
	}	
?>