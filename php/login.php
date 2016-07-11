<?php
	include "config.php";

	$login=$_POST["log"];
	$pass=md5(md5($_POST["pass"]));

	if(buscar_campo("dni", strtoupper($login))!=true){
		if(buscar_campo("nick", $login)!=true){
			if(buscar_campo("email", $login)!=true){
				echo "404";
			}
			else{
				login($login, $pass);
			}
		}
		else{
			login($login, $pass);
		}
	}
	else{
		login($login, $pass);
	}


	function buscar_campo($campo, $valor){
		include "config.php";
		
		$qry="SELECT ".$campo." FROM usuarios WHERE ".$campo." = '".$valor."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			return false;
		}

		return true;
	}

	function login($login, $pass){
		include "config.php";
		$qry="SELECT * FROM usuarios
			WHERE (
				dni = '".$login."' OR
				nick = '".$login."' OR
				email = '".$login."'
			)
			AND pass = '".$pass."'";
		$res=mysqli_query($con, $qry) or die ($qry);

		if(mysqli_num_rows($res)>0){
			if($_POST["noClose"]!="false"){
				generar_cookie($login);
			}

			ultimo_acceso($login);

			echo "200";
		}
		else{
			echo "400";
		}
	}

	function generar_cookie($login){
		$dias=3650;
		setcookie("user", $login, time()+(60*60*24*$dias));
	}

	function ultimo_acceso($login){
		include "config.php";

		$qry="UPDATE usuarios
				SET acceso='".date("Y-m-d H:i:s")."'
				WHERE
					dni = '".$login."' OR
					nick = '".$login."' OR
					email = '".$login."'";

		$res=mysqli_query($con, $qry) or die ($qry);
	}
?>