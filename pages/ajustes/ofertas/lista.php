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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/ofertas/lista.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/ofertas/lista.js"></script>
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
					$consulta="SELECT cp, p.nombre prov, pa.nombre patro FROM patrocinadores pa join provincias p ON pa.provincia=p.cp WHERE pa.codigo=".$_GET['patro'];

					$rowP=mysqli_fetch_assoc(mysqli_query($con, $consulta));

					echo "<div class='breadcrumbs'><a href='../servicio.php'>/</a><a href='../servicio/lista.php?prov=".$rowP['cp']."'>".utf8_encode($rowP['prov'])."</a><span>/".utf8_encode($rowP['patro'])."</span></div>";

					$qryPC="SELECT * FROM permiso_patro WHERE patrocinador=".$_GET["patro"]." AND dni='".$row['dni']."'";
					$lonPC=mysqli_num_rows(mysqli_query($con, $qryPC));

					if($lonPC>0 || $row["admin"]!=0){
						$consulta="SELECT * FROM ofertas WHERE patrocinador=".$_GET["patro"];

						$res=mysqli_query($con, $consulta);

						if(mysqli_num_rows($res)>0){
							echo '<input type="text" id="seeker" placeholder="Busca una promoción..."/>';
						}
						else{
							echo '<input type="text" id="seeker" placeholder="Busca una promoción..." disabled/>';
						}
			?>
				<table class="table table-responsive table-hover results col-xs-10 col-sm-8">
					<tbody>
						
					</tbody>
				</table>
				<div class="col-xs-12 opciones">
					<a class="col-xs-12 col-sm-4 addAdmin"><button class="btn btn-primary">AÑADIR ADMINISTRADOR</button></a>
					<?php
						echo '<a href="/BasketBaseWeb/pages/ajustes/servicio/editar.php?patro='.$_GET["patro"].'" class="col-xs-12 col-sm-4"><button class="btn btn-primary">EDITAR DATOS</button></a>';
						echo '<a href="/BasketBaseWeb/pages/ajustes/ofertas/anadir.php?patro='.$_GET["patro"].'" class="col-xs-12 col-sm-4"><button class="btn btn-primary">AÑADIR PROMOCIÓN</button></a>';
					?>
				</div>
				<table class="table table-striped table-hover table-responsive">
					<thead>
						<tr>
							<th class='fechaTit'>Fecha</th>
							<th>Mensaje</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(mysqli_num_rows($res)>0){
								while($rowO=mysqli_fetch_array($res)){
									echo "<tr ofe='".$rowO['codigo']."'>
											  <td class='fecha'>".$rowO['fecha_fin']."</td>
											  <td class='titulo'>".utf8_encode($rowO['mensaje'])."</td>
										  </tr>";
								};
							}
							else{
								echo "<tr>
										  <td class='noResults' colspan='2'>No hay promociones.</td>
									  </tr>";
							}
						?>
					</tbody>
				</table>
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
			<span class="item-foot">Contacto</span>
			<span class="item-foot">Colabora</span>
			<span class="item-foot">Aviso legal</span>
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

							$qry="SELECT u.dni as dni, nick, patrocinador FROM usuarios u LEFT JOIN permiso_patro pp on u.dni=pp.dni AND patrocinador=".$_GET["patro"]." WHERE admin=0 AND u.dni!='".$row['dni']."' ORDER BY nick";
							$res=mysqli_query($con, $qry);

							while($row=mysqli_fetch_array($res)){
								if($row['patrocinador']!=null){
									echo "<div class='col-sm-3 col-xs-6'><input checked type='checkbox' value='".$row["dni"]."' />".$row["nick"]."</div>";
								}
								else{
									echo "<div class='col-sm-3 col-xs-6'><input type='checkbox' value='".$row["dni"]."' />".$row["nick"]."</div>";
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