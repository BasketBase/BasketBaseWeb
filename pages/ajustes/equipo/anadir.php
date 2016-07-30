<!DOCTYPE html>
<html lang="ES">
	<head>
		<title>Basket Base</title>

		<meta charset="UTF-8" />
		<meta content="Basket Base, baloncesto, deporte" />
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<meta name="theme-color" content="#3F51B5"/>

		<link rel="icon" type="image/png" href="/BasketBaseWeb/img/favicon.png" size="192x192"/>

		<!--Libraries-->
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/lib/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/lib/font-awesome.min.css" />
		<script type="text/javascript" src='/BasketBaseWeb/lib/jquery-1.11.3.min.js'></script>
		<script type="text/javascript" src='/BasketBaseWeb/lib/bootstrap.min.js'></script>

		<!--Custom CSS -->
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/styles.css" />
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/equipo/anadir.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/equipo/anadir.js"></script>
	</head>
	<body>
		<div id="header" class="col-xs-12">
			<span class="img-titulo">
				<img style="padding: 5px" src="/BasketBaseWeb/img/logo.png">
			</span>
			
			<span class="titulo">BASKET BASE</span>
		</div>
		<div id="menu">
			<a href="/BasketBaseWeb/">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-home"></span>
					<span class="tit-item-menu">Inicio</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/clubs.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-asterisk"></span>
					<span class="tit-item-menu">Clubs</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/calendario.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-calendar"></span>
					<span class="tit-item-menu">Calendario</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/servicios.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-briefcase"></span>
					<span class="tit-item-menu">Servicios Asociados</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/promos.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-picture"></span>
					<span class="tit-item-menu">Promociones</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/ajustes.php">
				<div class="item-menu ajustes">
					<span class="img-item-menu glyphicon glyphicon-cog"></span>
					<span class="tit-item-menu">Ajustes</span>
				</div>
			</a>
			<a class="login-link" href="/BasketBaseWeb/pages/login.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-log-in"></span>
					<span class="tit-item-menu">Iniciar sesión</span>
				</div>
			</a>
			<div class="user-menu">
				<img class="user-image" src="">
				<div class="user-name">
					<?php 
						if(isset($_COOKIE["showable"])){
							echo $_COOKIE["showable"]; 
						}
						else{
							echo 'ERROR';
						}
					?>
				</div>
				<div class="close-session">
					<span class="glyphicon glyphicon-remove"></span>
					<span id="cerrarSesion">Cerrar sesión</span>
				</div>
			</div>
		</div>
		<div id="container" class="col-xs-12">
			<?php
				include "../../../php/config.php";
				$login="";
				if(isset($_COOKIE["user"])){
					$login=$_COOKIE["user"];
				}
				else{
					header("Location: http://localhost/errors/403.html");
					exit();
				}

				$consulta="SELECT * FROM usuarios
						   WHERE dni = '".$login."'
						   OR 	 nick = '".$login."'
						   OR 	 email = '".$login."'";

				$row=mysqli_fetch_assoc(mysqli_query($con, $consulta));

				if($row!=null){
			?>
				<form role="form">
					<div id="nombre" class="form-group col-md-6 col-xs-12">
						<label class="nombre" for="nombre">
							<span class="fa fa-user" style="margin-right: 10px"></span>
							<span>* Nombre</span>
							<span class="error nombre-lon">No puede quedar vacío.</span>
						</label>
						<input type="text" class="form-control" id="auth_nombre"
						       placeholder="Introduce el nombre" maxlength="150">
					</div>
					<div id="hora" class="form-group col-md-6 col-xs-12">
						<label class="hora" for="hora">
							<span class="fa fa-street-view" style="margin-right: 10px"></span>
							<span>Hora de juego</span>
							<span class="error hora-format">Formato de hora incorrecto.</span>
						</label>
						<input type="text" class="form-control" id="auth_hora"
						       placeholder="hh:MM" maxlength="5">
					</div>
					<div id="camiLoc" class="form-group col-md-6 col-xs-12">
						<label class="camiLoc" for="camiLoc">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Color camiseta local</span>
						</label>
						<input type="color" class="form-control" id="auth_camiLoc">
					</div>
					<div id="camiVIs" class="form-group col-md-6 col-xs-12">
						<label class="camiVIs" for="camiVIs">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Color camiseta visitante</span>
						</label>
						<input type="color" class="form-control" id="auth_camiVis">
					</div>
					<span class="error campo-error" style="color: red"></span>
					<span class="error bd-error" style="color: red">Ha ocurrido un error en el servidor. Vuelva a intentarlo más tarde. Disculpe las molestias.</span>
					<button type="submit" class="btn btn-warning altaEquipo" disabled>Registrar equipo</button>
				</form>
			<?php
				}

				else{
					header("Location: http://localhost/errors/500.html");
					exit();
				}
			?>
		</div>
		<div id="foot" class="col-xs-12">
			<span class="cbb"><span style="font-size: 23px;float:left; margin-top: -5px; margin-right: 5px;">®</span> BASKET BASE</span>
			<span class="item-foot">Contacto</span>
			<span class="item-foot">Colabora</span>
			<span class="item-foot">Aviso legal</span>
			<a href="https://twitter.com/basketbaseapp" target="_blank"><span class="fa fa-twitter"></span></a>
			<a href="https://facebook.com/basketbase" target="_blank"><span class="fa fa-facebook-official"></span></a>
			<a href="https://www.youtube.com/channel/UCBXOEDHVG8lZKQxLU41Di3w" target="_blank"><span class="fa fa-youtube"></span></a>
		</div>
	</body>
</html>