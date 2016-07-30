<?php
	include "../../config.php";

	if(isset($_POST["seek"])){
		$text=$_POST["seek"];

		if(isset($_COOKIE["user"]) || $_COOKIE["user"]!=null){
			$login=$_COOKIE["user"];
			
			$qryU="SELECT * FROM usuarios
					WHERE 	dni = '".$login."' OR
							nick = '".$login."' OR
							email = '".$login."'";

			$resU=mysqli_query($con, $qryU);

			$rowU=mysqli_fetch_assoc($resU);

			$qry="SELECT * FROM equipos WHERE club=".$_GET['club']." AND nombre LIKE '%".utf8_decode($text)."%'";
			$res=mysqli_query($con, $qry) or die ($qry);

			while($row=mysqli_fetch_array($res)){
				echo $row["codigo"]."//".utf8_encode($row["nombre"])."//";
			}
		}
	}
?>