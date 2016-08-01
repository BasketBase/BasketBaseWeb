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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/equipo/partidos.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/equipo/partidos.js"></script>
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
					$qryC="SELECT c.provincia AS cp, (SELECT nombre FROM provincias WHERE cp=c.provincia) AS prov, c.nombre AS club, e.nombre AS equipo, c.codigo AS clubCod, cami_loc, cami_vis FROM equipos e join clubs c ON e.club=c.codigo WHERE e.codigo=".$_GET['equipo'];

					$rowC=mysqli_fetch_assoc(mysqli_query($con, $qryC));

					echo "<div class='breadcrumbs'><a href='../club.php'>/</a><a href='../club/lista.php?prov=".$rowC['cp']."'>".utf8_encode($rowC['prov'])."</a><a href='../equipo/lista.php?club=".$rowC['clubCod']."'>/".utf8_encode($rowC['club'])."</a><span>/".utf8_encode($rowC['equipo'])."</span></div>";
					echo '<a href="/BasketBaseWeb/pages/ajustes/partidos/anadir.php?equipo='.$_GET['equipo'].'"><button class="addPartido col-xs-10 col-sm-4 col-xs-offset-1 btn" style="background-color: '.$rowC["cami_loc"].'">Añadir partido</button></a>';
					echo '<a href="/BasketBaseWeb/pages/ajustes/equipo/editar.php?equipo='.$_GET['equipo'].'"><button class="editEquipo col-xs-10 col-sm-4 col-xs-offset-1 btn" style="background-color: '.$rowC["cami_vis"].'">Editar equipo</button></a>';
				?>

				<table class="table table-striped table-hover table-responsive">
					<thead>
						<tr>
							<th class='jornTit'>Jornada</th>
							<th class='fechaTit'>Fecha</th>
							<th>Partido</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$qryP="SELECT p.codigo AS 'partido', (SELECT nombre FROM equipos WHERE codigo=local) AS local, (SELECT nombre FROM equipos WHERE codigo=visitante) AS visitante, cami_loc, cami_vis, resultado, jornada, fecha FROM equipos e join partidos p ON e.codigo=local or e.codigo=visitante WHERE e.codigo=".$_GET['equipo'];
							$resP=mysqli_query($con, $qryP);
							if(mysqli_num_rows($resP)>0){
								while($rowP=mysqli_fetch_array($resP)){
									echo "<tr part='".$rowP['partido']."'>
											  <td class='jornada'>".$rowP['jornada']."</td>
											  <td class='fecha'>".$rowP['fecha']."</td>
											  <td>".$rowP['local']." - ".$rowP['visitante']." : <i>".$rowP['resultado']."</i></td>
										  </tr>";
								};
							}
							else{
								echo "<tr>
										  <td class='noResults' colspan='3'>No hay partidos.</td>
									  </tr>";
							}
						?>
					</tbody>
				</table>
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

		<div class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Administración del partido</h4>
					</div>
					<div class="modal-body">
						<button type="button" class="btn btn-danger edit">Editar partido</button>
						<button style='float:right' type="button" class="btn btn-warning add">Añadir resultado</button>
						<div class='result' hidden>
							<div id="ptsLoc" class="form-group col-md-6 col-xs-12">
								<label class="ptsLoc" for="ptsLoc">
									<span class="fa fa-user" style="margin-right: 10px"></span>
									<span>Puntos del equipo local:</span>
									<span class="error ptsLoc-lon">No puede quedar vacío.</span>
								</label>
								<input type="number" class="form-control" id="auth_ptsLoc"
								       placeholder="0" maxlength="3">
							</div>
							<div id="ptsVis" class="form-group col-md-6 col-xs-12">
								<label class="ptsVis" for="ptsVis">
									<span class="fa fa-user" style="margin-right: 10px"></span>
									<span>* Puntos del equipo visitante:</span>
									<span class="error ptsVis-lon">No puede quedar vacío.</span>
								</label>
								<input type="text" class="form-control" id="auth_ptsVis"
								       placeholder="0" maxlength="3">
							</div>
							<button type="button" class="btn btn-danger addResult">Añadir</button>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>