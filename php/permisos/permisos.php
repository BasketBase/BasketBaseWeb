<?php
	include "../config.php";

	$login=$_COOKIE["user"];

	$qry="SELECT admin, club, patrocinador FROM usuarios u LEFT JOIN 
									permiso_club pc on u.dni=pc.dni LEFT JOIN
									permiso_patro pp on u.dni=pp.dni
		WHERE u.dni = '".$login."' OR
			nick = '".$login."' OR
			email = '".$login."'";

	$res=mysqli_query($con, $qry) or die($qry);;
	$row=mysqli_fetch_assoc($res);

	if($row["admin"]==1){
		echo "admin";
	}
	else{
		if($row["patro"]!=null){
			echo "1";
		}

		if($row["club"]!=null){
			echo "2";
		}
	}
?>