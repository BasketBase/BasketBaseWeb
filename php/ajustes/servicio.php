<?php
	include "../config.php";

	if(isset($_POST["seek"])){
		$text=$_POST["seek"];

		$qry="SELECT * FROM provincias WHERE nombre LIKE '%".utf8_decode($text)."%' ORDER BY cp";
		$res=mysqli_query($con, $qry) or die ($qry);

		while($row=mysqli_fetch_array($res)){
			echo $row["cp"]."//".utf8_encode($row["nombre"])."//";
		};
	}
?>