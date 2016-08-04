<?php
	include "config.php";

	if(isset($_COOKIE["user"]) || isset($_COOKIE["user"])!=null){
		$login=$_COOKIE["user"];
		
		$qry="SELECT * FROM usuarios
				WHERE 	dni = '".$login."' OR
						nick = '".$login."' OR
						email = '".$login."'";

		$res=mysqli_query($con, $qry);

		$rowU=mysqli_fetch_assoc($res);

		$imagen="noImage.jpg";

		if($rowU["imagen"]!="" || $rowU["imagen"]!=null){
			$imagen=$rowU["imagen"];
		}

		echo $imagen;
	}
?>