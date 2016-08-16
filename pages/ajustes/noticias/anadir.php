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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/noticias/anadir.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/noticias/anadir.js"></script>
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
			<a href="/BasketBaseWeb/pages/promociones.php">
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
					<div id="titulo" class="form-group col-md-6 col-xs-12">
						<label class="titulo" for="titulo">
							<span class="fa fa-user" style="margin-right: 10px"></span>
							<span>* Título</span>
							<span class="error titulo-lon">No puede quedar vacío.</span>
						</label>
						<input type="text" class="form-control" id="auth_titulo"
						       placeholder="Introduce el título" maxlength="500">
					</div>
					<div id="subtitulo" class="form-group col-md-6 col-xs-12">
						<label class="subtitulo" for="subtitulo">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Subtítulo</span>
						</label>
						<input type="text" class="form-control" id="auth_subtitulo"
						       placeholder="Introduce el subtítulo" maxlength="1000">
					</div>
					<div id="imagen" class="form-group col-md-6 col-xs-12">
						<label class="imagen" for="imagen">
							<span class="fa fa-image" style="margin-right: 10px"></span>
							<span>Imagen</span>
						</label>
						<input name="imagen" type="file" class="form-control" id="auth_imagen"/>
					</div>
					<div id="url" class="form-group col-md-6 col-xs-12">
						<label class="url" for="url">
							<span class="fa fa-street-view" style="margin-right: 10px"></span>
							<span>Dirección Web</span>
						</label>
						<input type="text" class="form-control" id="auth_url"
						       placeholder="Introduce la direccion web..." maxlength="200">
					</div>
					<div id="cuerpo" class="form-group col-xs-12">
						<label class="cuerpo" for="cuerpo">
							<span class="fa fa-facebook-official" style="margin-right: 10px"></span>
							<span>Cuerpo</span>
							<!--<div>
								<button class='btn btn-default negrita'><span class="fa fa-bold"></span></button>
								<button class='btn btn-default cursiva'><span class="fa fa-italic"></span></button>
							</div>-->
						</label>
						<textarea type="text" class="form-control" id="auth_cuerpo"
						       placeholder="Escribe el cuerpo aquí..." maxlength="10000" rows="6"></textarea>
					</div>
					<span class="error campo-error" style="color: red"></span>
					<span class="error bd-error" style="color: red">Ha ocurrido un error en el servidor. Vuelva a intentarlo más tarde. Disculpe las molestias.</span>
					<button type="submit" class="btn btn-warning addNotice" disabled>Añadir</button>
					<button type="button" class="btn btn-info" onclick="location.href=history.back();">Volver</button>
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
			<span class="item-foot"><a href="/BasketBaseWeb/pages/contacto.php">Contacto</a></span>
			<span class="item-foot"><a href="/BasketBaseWeb/pages/colabora.php">Colabora</a></span>
			<!--<span class="item-foot"><a href="/BasketBaseWeb/pages/aviso.php">Aviso legal</a></span>-->
			<a href="https://twitter.com/basketbaseapp" target="_blank"><span class="fa fa-twitter"></span></a>
			<a href="https://facebook.com/basketbase" target="_blank"><span class="fa fa-facebook-official"></span></a>
			<a href="https://www.youtube.com/channel/UCBXOEDHVG8lZKQxLU41Di3w" target="_blank"><span class="fa fa-youtube"></span></a>
		</div>
	</body>
</html>