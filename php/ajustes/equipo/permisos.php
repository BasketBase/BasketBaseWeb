<?php
	include "../../config.php";

	$postJson=json_decode($_POST["users"]);

	foreach($postJson as $user){
		$dni=$user->dni;
		$check=$user->check;

		$qryU="SELECT * FROM permiso_club WHERE dni='".$dni."' AND club=".$_POST["club"];
		$resU=mysqli_query($con, $qryU);
		if(mysqli_num_rows($resU)>0){
			if($check!=1){
				$qry="DELETE FROM permiso_club WHERE dni='".$dni."' AND club=".$_POST["club"];
				mysqli_query($con, $qry) or die($qry);
			}
		}
		else{
			if($check==1){
				$qry="INSERT INTO permiso_club VALUES ('".$dni."' ,".$_POST["club"].")";
				mysqli_query($con, $qry) or die($qry);
			}
		}
	}
?>