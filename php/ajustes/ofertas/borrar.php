<?php
	include "../../config.php";
	$codigo=$_POST['codigo'];

	if($codigo!=null){
		$qry="DELETE FROM ofertas WHERE codigo=".$codigo;
		$res=mysqli_query($con, $qry) or die($qry);
	}	
?>