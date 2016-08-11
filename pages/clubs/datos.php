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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/equipo/lista.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/equipo/lista.js"></script>
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
				include "../../php/config.php";

				$consulta="SELECT cp, p.nombre prov, c.nombre club, url, direccion, email, telefono, logo FROM clubs c join provincias p ON c.provincia=p.cp WHERE c.codigo=".$_GET['club'];

				$rowC=mysqli_fetch_assoc(mysqli_query($con, $consulta));

				echo "<div class='breadcrumbs'><a href='../clubs.php'>/</a><a href='lista.php?prov=".$rowC['cp']."'>".utf8_encode($rowC['prov'])."</a><span>/".utf8_encode($rowC['club'])."</span></div>";
			?>
			<div class='col-xs-12' style='text-align:center'>
				<?php
					if($rowC["logo"]!=""){
						echo "<img style='width: 200px; height: 200px; margin-bottom: 30px;' src='/BasketBaseWeb/img/clubs/".$rowC["logo"]."'/>";
					}
					else{
						echo "<img style='width: 200px; height: 200px; margin-bottom: 30px;' src='/BasketBaseWeb/img/user/noImage.jpg'/>";
					}
				?>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-4'>
				<strong>Nombre: </strong><?php echo utf8_encode($rowC["club"])?>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-4'>
				<strong>Dirección web: </strong><?php echo $rowC["url"]?>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-4'>
				<strong>Dirección: </strong><?php echo utf8_encode($rowC["direccion"])?>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-4'>
				<strong>Teléfono: </strong><?php echo $rowC["telefono"]?>
			</div>
			<div class='col-xs-12 col-sm-6 col-md-4'>
				<strong>Email: </strong><?php echo $rowC["email"]?>
			</div>

			<div class="table-responsive col-xs-12">
				<table class="table table-striped table-hover table-responsive" style='margin-top: 40px'>
					<thead>
						<tr>
							<th>Nombre</th>
							<th style='text-align: center'>Color Local</th>
							<th style='text-align: center'>Color Visitante</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$qryE="SELECT * FROM equipos WHERE club=".$_GET['club'];

							$resE=mysqli_query($con, $qryE);
							if(mysqli_num_rows($resE)>0){
								while($rowE=mysqli_fetch_array($resE)){
									echo "<tr>
											  <td>".utf8_encode($rowE['nombre'])."</td>
											  <td style='background-color: ".$rowE['cami_loc']."'></td>
											  <td style='background-color: ".$rowE['cami_vis']."'></td>
										  </tr>";
								}
							}
							else{
								echo "<tr>
										  <td class='noResults' colspan='3'>No hay equipos.</td>
									  </tr>";
							}
						?>
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