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
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/usuario/imagen.js"></script>
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
			<div class="tables col-xs-12">
				<div class="titleA col-xs-offset-1 col-xs-11">USUARIO</div>
				<div class="elemA col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/ajustes/usuario/editar.php">EDITAR DATOS</a></div>
				<div class="elemA col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/ajustes/usuario/contrasena.php">CAMBIAR CONTRASEÑA</a></div>
				<div class="elemA col-sm-4 col-xs-12 cImg"><a>CAMBIAR IMAGEN</a></div>
			</div>

			<div class="tables permiso col-xs-12">
				<div class="titleA col-xs-offset-1 col-xs-11">ADMINISTRADOR</div>
				<div class="elemA perClub col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/ajustes/club.php">CLUB</a></div>
				<div class="elemA perPatro col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/ajustes/servicio.php">SERVICIO</a></div>
				<!--<div class="elemA perEve col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/ajustes/evento.php">EVENTO</a></div>-->
				<div class="elemA admin col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/adminPabellon">PABELLONES</a></div>
				<div class="elemA admin col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/adminEntrena">ENTRENADORES</a></div>
				<div class="elemA admin col-sm-4 col-xs-12"><a href="/BasketBaseWeb/pages/adminUsua">USUARIOS</a></div>
			</div>

			<div class="tables admin col-xs-12">
				<div class="titleA col-xs-offset-1 col-xs-11">GESTIÓN</div>
				<div class="elemA col-sm-4 col-xs-12"><a target="_blank" href="http://gestion.basketbaseweb.com">ACCEDER</a></div>
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

		<!--**********************   MODAL IMG   ************************-->
		<div class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Galería de imágenes de perfil</h4>
					</div>
					<div class="modal-body">
						<?php
							include "../php/config.php";
							$ruta="/BasketBaseWeb/img/user/";
							$login=$_COOKIE["user"];
							$qry="SELECT dni, imagen FROM usuarios
												   WHERE dni = '".$login."'
												   OR 	 nick = '".$login."'
												   OR 	 email = '".$login."'";

							$res=mysqli_query($con, $qry) or die ($qry);
							$row=mysqli_fetch_assoc($res);
							$dni=$row["dni"];
							$ruta.=$dni."/";

							foreach(scandir($_SERVER['DOCUMENT_ROOT'].$ruta) as $file) {
								if($file!="." && $file!="..")
								if($file!=$row["imagen"]){
									echo '<div class="imgPerfil col-md-3 col-sm-4 col-xs-6">
										  <img src="'."/img/user/".$file.'">
									  </div>';
								}
								else{
									echo '<div class="imgPerfil col-md-3 col-sm-4 col-xs-6" actual>
										  <img src="'.$ruta.$file.'">
									  </div>';
								}
							}
						?>
						<div class="imgPerfil col-md-3 col-sm-4 col-xs-6">
							<span class="subir fa fa-plus"  aria-hidden="true"></span>
							<input type="file" id="upload" name="img" style="display:none">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary selec">Seleccionar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>