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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/partidos/editar.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/partidos/editar.js"></script>
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
					$qryP="SELECT 	(SELECT nombre FROM equipos e WHERE e.codigo=p.local) AS localNom,
									(SELECT nombre FROM equipos e WHERE e.codigo=p.visitante) AS visNom,
									(SELECT nombre FROM equipos e WHERE e.codigo=p.visitante) AS visNom,
									(SELECT nombre FROM pabellones pab WHERE pab.codigo=p.pabellon) AS pabNom,
									local, visitante, jornada, fecha, hora, pabellon
							FROM partidos p WHERE p.codigo=".$_GET["partido"];
					$resP=mysqli_query($con, $qryP);
					$rowP=mysqli_fetch_assoc($resP);
			?>
				<form role="form">
					<div id="local" class="form-group col-md-6 col-xs-12">
						<label class="local" for="local">
							<span class="fa fa-street-view" style="margin-right: 10px"></span>
							<span>* Local</span>
						</label>
						<?php
							echo "<input value='".$rowP['localNom']."' type='text' disabled class='localInput form-control' id='auth_local' cod='".$rowP['local']."'/>";
						?>
						<button class='btn btn-primary escoLocal'>Escoger equipo</button>
					</div>
					<div id="vis" class="form-group col-md-6 col-xs-12">
						<label class="vis" for="vis">
							<span class="fa fa-street-view" style="margin-right: 10px"></span>
							<span>* Visitante</span>
						</label>
						<?php
							echo "<input value='".$rowP['visNom']."' type='text' disabled class='visInput form-control' id='auth_vis' cod='".$rowP['visitante']."'/>";
						?>
						<button class='btn btn-primary escoVis'>Escoger equipo</button>
					</div>
					<div id="jornada" class="form-group col-md-6 col-xs-12">
						<label class="jornada" for="jornada">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Jornada</span>
						</label>
						<?php
							echo '<input type="number" placeholder="Número de jornada..." min="1" max="99" class="form-control" id="auth_jornada" value="'.$rowP["jornada"].'">';
						?>
					</div>
					<div id="pabellon" class="form-group col-md-6 col-xs-12">
						<label class="pabellon" for="pabellon">
							<span class="fa fa-street-view" style="margin-right: 10px"></span>
							<span>Pabellón</span>
						</label>
						<?php
							echo "<input value='".utf8_encode($rowP['pabNom'])."' type='text' disabled class='pabellonInput form-control' id='auth_pabellon' cod='".$rowP['pabellon']."'/>";
						?>
						<button class='btn btn-primary escoPabe'>Escoger pabellón</button>
					</div>
					<div id="fecha" class="form-group col-md-6 col-xs-12">
						<label class="fecha" for="fecha">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Fecha</span>
						</label>
						<?php
							echo '<input type="text" placeholder="dd/mm/yyyy" maxlength="10" class="form-control" id="auth_fecha" value="'.$rowP["fecha"].'">';
						?>
					</div>
					<div id="hora" class="form-group col-md-6 col-xs-12">
						<label class="hora" for="hora">
							<span class="fa fa-globe" style="margin-right: 10px"></span>
							<span>Hora</span>
						</label>
						<?php
							echo '<input type="text" class="form-control" id="auth_hora" maxlength="5" placeholder="hh:MM" value="'.$rowP["hora"].'">';
						?>
					</div>
					<span class="error campo-error" style="color: red"></span>
					<span class="error bd-error" style="color: red">Ha ocurrido un error en el servidor. Vuelva a intentarlo más tarde. Disculpe las molestias.</span>
					<button type="submit" class="btn btn-warning editPartido">Editar partido</button>
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
			<span class="item-foot">Contacto</span>
			<span class="item-foot">Colabora</span>
			<span class="item-foot">Aviso legal</span>
			<a href="https://twitter.com/basketbaseapp" target="_blank"><span class="fa fa-twitter"></span></a>
			<a href="https://facebook.com/basketbase" target="_blank"><span class="fa fa-facebook-official"></span></a>
			<a href="https://www.youtube.com/channel/UCBXOEDHVG8lZKQxLU41Di3w" target="_blank"><span class="fa fa-youtube"></span></a>
		</div>

		<!--**********************   MODAL   EQUIPO   ************************-->
		<div class="modal modalEquipo fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Escoge un equipo</h4>
					</div>
					<div class="modal-body">
						<input type="text" id="auth_equipo" class='form-control' placeholder='Nombre del equipo'/>
						<button class='esc btn btn-primary'>Añadir y escoger</button>
						<table class="table table-striped table-hover table-responsive">
							<thead>
								<tr>
									<th>Equipo</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include "../../../php/config.php";
									$qry="SELECT codigo, nombre FROM equipos WHERE codigo!=".$rowP['local']." AND codigo!=".$rowP['visitante']." ORDER BY nombre";

									$res=mysqli_query($con, $qry) or die ($qry);

									if(mysqli_num_rows($res)>0){
										while($row=mysqli_fetch_array($res)){
											echo "<tr class='equipo' cod='".$row['codigo']."'><td>".$row['nombre']."</td></tr>";
										}
									}
									else{
										echo "<tr><td>No hay equipos disponibles</td></tr>";
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!--**********************   MODAL   PABELLONES   ************************-->
		<div class="modal modalPabe fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Escoge un pabellón</h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped table-hover table-responsive">
							<tbody>
								<?php
									include "../../../php/config.php";
									$qry="SELECT codigo, nombre FROM pabellones ORDER BY nombre";

									$res=mysqli_query($con, $qry) or die ($qry);

									if(mysqli_num_rows($res)>0){
										while($row=mysqli_fetch_array($res)){
											echo "<tr class='pabellon' cod='".$row['codigo']."'><td>".utf8_encode($row['nombre'])."</td></tr>";
										}
									}
									else{
										echo "<tr><td>No hay pabellones disponibles</td></tr>";
									}
								?>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>