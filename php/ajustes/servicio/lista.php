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

			$qry="";

			if($rowU['admin']!=1){
				$qryPP="SELECT p.codigo as patro, nombre FROM patrocinadores p JOIN permiso_patro pp on p.codigo=pp.club WHERE dni='".$rowU['dni']."' AND nombre LIKE '%".utf8_decode($text)."%' ORDER BY nombre";
				$resPP=mysqli_query($con, $qryPP);
				if(mysqli_num_rows($resPP)>0){
					while($row=mysqli_fetch_array($resPP)){
						echo $row["patro"]."//".utf8_encode($row["nombre"])."//";
					};
				}
			}
			else{
				$qry="SELECT * FROM patrocinadores WHERE nombre LIKE '%".utf8_decode($text)."%' ORDER BY nombre";
				$res=mysqli_query($con, $qry) or die ($qry);

				while($row=mysqli_fetch_array($res)){
					echo $row["codigo"]."//".utf8_encode($row["nombre"])."//";
				};
			}
		}
	}
?>