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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/login.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/login.js"></script>
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
			<a href="/BasketBaseWeb/pages/ajustes.php" class="ajustes">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-cog"></span>
					<span class="tit-item-menu">Ajustes</span>
				</div>
			</a>
			<div class="item-menu item-active">
				<span class="img-item-menu glyphicon glyphicon-log-in"></span>
				<span class="tit-item-menu">Iniciar sesión</span>
			</div>
			<div class="user-menu">
				<img class="user-image" src="#">
				<div class="user-name"></div>
				<div class="close-session">
					<span class="glyphicon glyphicon-remove"></span>
					<span>Cerrar sesión</span>
				</div>
			</div>
		</div>
		<div id="container" class="col-xs-12">
			<form role="form">
				<div id="login" class="form-group">
					<label class="auth" for="auth">
						<span class="fa fa-user" style="margin-right: 10px"></span>
						<span>Email/NIF/Nick</span>
					</label>
					<input type="text" class="form-control" id="auth_login"
					       placeholder="Introduce tu email, DNI o nick">
					<span class="error login-format">No puede quedar vacío este campo.</span>
					<span class="error login-error">Este usuario no existe.</span>
				</div>
				<div id="pass" class="form-group">
					<label class="pass" for="pass">
						<span class="fa fa-lock" style="margin-right: 10px"></span>
						<span>Contraseña</span>
						<span class="error pass-format">No puede quedar vacío este campo.</span>
						<span class="error login-error">La contraseña no es correcta.</span>
					</label>
					<input type="password" class="form-control" id="auth_pass" 
					       placeholder="Introduce tu contraseña">
				</div>
				<div id="no-close">
					<label>
					  <input type="checkbox"> No cerrar sesión
					</label>
				</div>
				<button type="submit" class="btn login" disabled>Entrar</button>
				<button type="button" class="btn btn-info" onclick="location.href='http://localhost/BasketBaseWeb/';">Volver</button>
				<a class="registro" href="/BasketBaseWeb/pages/registro.php">¿Aún no estás registrado?</a>
			</form>
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