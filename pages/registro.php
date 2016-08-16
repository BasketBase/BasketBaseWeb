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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/registro.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/registro.js"></script>
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
			<a href="/BasketBaseWeb/pages/ajustes.php" class="ajustes">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-cog"></span>
					<span class="tit-item-menu">Ajustes</span>
				</div>
			</a>
			<a href="/BasketBaseWeb/pages/login.php">
				<div class="item-menu">
					<span class="img-item-menu glyphicon glyphicon-log-in"></span>
					<span class="tit-item-menu">Iniciar sesión</span>
				</div>
			</a>
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
				<div id="dni" class="form-group col-md-6 col-xs-12">
					<label class="dni" for="dni">
						<span class="fa fa-credit-card-alt" style="margin-right: 10px"></span>
						<span>DNI</span>
						<span class="epl-form">Ej.: 12345678Z</span>
						<span class="error dni-lon">El DNI tiene 9 caracteres.</span>
						<span class="error dni-format">No es un formato de DNI correcto.</span>
						<span class="error dni-letra">La letra del DNI no corresponde a ese número.</span>
					</label>
					<input type="text" class="form-control" id="auth_dni"
					       placeholder="Introduce tu dni" maxlength="9">
				</div>
				<div id="nick" class="form-group col-md-6 col-xs-12">
					<label class="nick" for="nick">
						<span class="fa fa-universal-access" style="margin-right: 10px"></span>
						<span>Nick</span>
						<span class="error nick-lon">El nick debe tener más de 4 caracteres.</span>
					</label>
					<input type="text" class="form-control" id="auth_nick"
					       placeholder="Introduce tu nick" maxlength="20">
				</div>
				<div id="email" class="form-group col-md-6 col-xs-12">
					<label class="email" for="email">
						<span class="fa fa-envelope-o" style="margin-right: 10px"></span>
						<span>Email</span>
						<span class="error email-format">No es un formato de email correcto.</span>
					</label>
					<input type="email" class="form-control" id="auth_email"
					       placeholder="Introduce tu email" maxlength="200">
				</div>
				<div id="nombre" class="form-group col-md-6 col-xs-12">
					<label class="nombre" for="nombre">
						<span class="fa fa-user" style="margin-right: 10px"></span>
						<span>Nombre</span>
						<span class="error nom-lon">El nombre no puede quedar vacío.</span>
					</label>
					<input type="text" class="form-control" id="auth_nombre"
					       placeholder="Introduce tu nombre" maxlength="100">
				</div>
				<div id="apes" class="form-group col-md-6 col-xs-12">
					<label class="apes" for="apes">
						<span class="fa fa-user" style="margin-right: 10px"></span>
						<span>Apellidos</span>
						<span class="error ape-lon">El primer apellido no puede quedar vacío.</span>
					</label>
					<input type="text" class="form-control" id="auth_ape1"
					       placeholder="Introduce tu primer apellido" maxlength="150">
			        <input type="text" class="form-control" id="auth_ape2"
			        	   placeholder="Introduce tu segundo apellido" maxlength="150">
				</div>
				<div id="pass" class="form-group col-md-6 col-xs-12">
					<label class="pass" for="pass">
						<span class="fa fa-lock" style="margin-right: 10px"></span>
						<span>Contraseña</span>
						<span class="error pass-format">Debe contener al menos un número, una letra y 6 caracteres.</span>
						<span class="error pass-repeat">Las contraseñas no coinciden.</span>
					</label>
					<input type="password" class="form-control" id="auth_pass" 
					       placeholder="Introduce tu contraseña" maxlength="15">
			        <input type="password" class="form-control" id="auth_repPass" 
			       		   placeholder="Repite tu contraseña" maxlength="15">
				</div>
				<span class="error campo-error" style="color: red"></span>
				<span class="error bd-error" style="color: red">Ha ocurrido un error en el servidor. Vuelva a intentarlo más tarde. Disculpe las molestias.</span>
				<button type="submit" class="btn btn-warning registro" disabled>Registrar</button>
				<button type="button" class="btn btn-info" onclick="location.href='http://localhost/BasketBaseWeb/pages/login.php';">Volver</button>
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