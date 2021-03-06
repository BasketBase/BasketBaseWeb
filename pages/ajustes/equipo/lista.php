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
					$consulta="SELECT cp, p.nombre prov, c.nombre club FROM clubs c join provincias p ON c.provincia=p.cp WHERE c.codigo=".$_GET['club'];

					$rowC=mysqli_fetch_assoc(mysqli_query($con, $consulta));

					echo "<div class='breadcrumbs'><a href='../club.php'>/</a><a href='../club/lista.php?prov=".$rowC['cp']."'>".utf8_encode($rowC['prov'])."</a><span>/".utf8_encode($rowC['club'])."</span></div>";

					$qryPC="SELECT * FROM permiso_club WHERE club=".$_GET["club"]." AND dni='".$row['dni']."'";
					$lonPC=mysqli_num_rows(mysqli_query($con, $qryPC));

					if($lonPC>0 || $row["admin"]!=0){
						$consulta="SELECT * FROM equipos WHERE club=".$_GET["club"];

						$res=mysqli_query($con, $consulta);

						if(mysqli_num_rows($res)>0){
							echo '<input type="text" id="seeker" placeholder="Busca un equipo..."/>';
						}
						else{
							echo '<input type="text" id="seeker" placeholder="Busca un equipo..." disabled/>';
						}
			?>
				<table class="table table-responsive table-hover results col-xs-10 col-sm-8">
					<tbody>
						
					</tbody>
				</table>
				<div class="col-xs-12 opciones">
					<a class="col-xs-12 col-sm-4 addAdmin"><button class="btn btn-primary">AÑADIR ADMINISTRADOR</button></a>
					<?php
						echo '<a href="/BasketBaseWeb/pages/ajustes/club/editar.php?club='.$_GET["club"].'" class="col-xs-12 col-sm-4"><button class="btn btn-primary">EDITAR DATOS</button></a>';
						echo '<a href="/BasketBaseWeb/pages/ajustes/club/noticias.php?club='.$_GET["club"].'" class="col-xs-12 col-sm-4"><button class="btn btn-primary">NOTICIAS</button></a>';
					?>
				</div>
				<div id="contEquipos" class="col-xs-10 col-sm-9">
					<?php
						while($rowE=mysqli_fetch_array($res)){
							echo 	"<a class='
											equiposItem 
											col-xs-offset-2
											col-sm-offset-1 
											col-md-2
											col-sm-3
											col-xs-4'
											href='/BasketBaseWeb/pages/ajustes/equipo/partidos.php?equipo=".$rowE["codigo"]."'>
												<div class='nomClub'>".utf8_encode($rowE["nombre"])."</div>
									</a>";
						};
						echo "<a class='
									equiposItem
									subir
									col-xs-offset-2
									col-sm-offset-1 
									col-md-2
									col-sm-3
									col-xs-4'
								href='/BasketBaseWeb/pages/ajustes/equipo/anadir.php?club=".$_GET["club"]."'>
								<span class='fa fa-plus' aria-hidden='true'></span>
							</a>";
					?>
				</div>
			<?php
					}

					else{
						header("Location: http://localhost/errors/403.html");
						exit();
					}
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

		<!--**********************   MODAL ADMIN   ************************-->
		<div class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Añadir administrador</h4>
					</div>
					<div class="modal-body">
						<?php
							include "../../../php/config.php";

							$qry="SELECT u.dni as dni, nick, club FROM usuarios u LEFT JOIN permiso_club pc on u.dni=pc.dni AND club=".$_GET["club"]." WHERE admin=0 AND u.dni!='".$row['dni']."' ORDER BY nick";
							$res=mysqli_query($con, $qry);

							while($row=mysqli_fetch_array($res)){
								if($row['club']!=null){
									echo "<div class='col-sm-3 col-xs-6'><input checked type='checkbox' value='".$row["dni"]."' />".utf8_encode($row["nick"])."</div>";
								}
								else{
									echo "<div class='col-sm-3 col-xs-6'><input type='checkbox' value='".$row["dni"]."' />".utf8_encode($row["nick"])."</div>";
								}
							};
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary selec">Conceder</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>