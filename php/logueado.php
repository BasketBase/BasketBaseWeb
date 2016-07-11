<?php
	include "config.php";
	
	if(isset($_COOKIE["user"])){
		$login=$_COOKIE["user"];
		
		$qry="SELECT * FROM usuarios
				WHERE 	dni = '".$login."' OR
						nick = '".$login."' OR
						email = '".$login."'";

		$res=mysqli_query($con, $qry);

		$rowU=mysqli_fetch_assoc($res);

		$imagen="noImage.jpg";

		echo $rowU["imagen"];

		if($rowU["imagen"]!="NULL"){
			$imagen=$rowU["imagen"];
		}

		echo $imagen;
	}
?>