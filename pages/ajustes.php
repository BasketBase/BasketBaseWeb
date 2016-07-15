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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
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
			<div class="item-menu ajustes item-active">
				<span class="img-item-menu glyphicon glyphicon-cog"></span>
				<span class="tit-item-menu">Ajustes</span>
			</div>
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
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th colspan="4">USUARIO</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>
								<a href="/BasketBaseWeb/pages/ajustes/usuario/editar.php">EDITAR DATOS</a>
							</td>
							<td>
								<a href="/BasketBaseWeb/pages/editPass">CAMBIAR CONTRASEÑA</a>
							</td>
							<td>
								<a href="/BasketBaseWeb/pages/addImage">AÑADIR IMAGEN</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-responsive permiso">
				<table class="table">
					<thead>
						<tr>
							<th colspan="4">ADMINISTRADOR</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td class="perClub">
								<a href="/BasketBaseWeb/pages/adminClub">CLUB</a>
							</td>
							<td class="perPatro">
								<a href="/BasketBaseWeb/pages/adminPatro">SERVICIO</a>
							</td>
							<td class="perEve">
								<a href="/BasketBaseWeb/pages/adminEvento">EVENTO</a>
							</td>
						</tr>
						<tr class="admin">
							<td></td>
							<td>
								<a href="/BasketBaseWeb/pages/adminPabellon">PABELLONES</a>
							</td>
							<td>
								<a href="/BasketBaseWeb/pages/adminEntrena">ENTRENADORES</a>
							</td>
							<td>
								<a href="/BasketBaseWeb/pages/adminUsuarios">USUARIOS</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="table-responsive admin">
				<table class="table">
					<thead>
						<tr>
							<th colspan="4">GESTIÓN</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a href="http://gestion.basketbaseweb.com">ACCEDER</a>
							</td>
							<td></td><td></td><td></td>
						</tr>
					</tbody>
				</table>
			</div>
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