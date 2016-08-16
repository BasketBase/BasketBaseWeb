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
		<link rel="stylesheet" type="text/css" href="/BasketBaseWeb/css/ajustes/servicio.css" />

		<!-- Custom JS -->
		<script type="text/javascript" src="/BasketBaseWeb/js/BasketBaseWeb.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/menu.js"></script>
		<script type="text/javascript" src="/BasketBaseWeb/js/ajustes/servicio.js"></script>
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
				include "../../php/config.php";
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
				<input type="text" id="seeker" placeholder="Busca la provincia que deseas..."/>
				<table class="table table-responsive table-hover results">
					<tbody>
						
					</tbody>
				</table>
				<div id="contProvs">
					<?php
						include "../../php/config.php";

						if($row['admin']==1){
							$qry="SELECT * FROM provincias ORDER BY cp";
							$res=mysqli_query($con, $qry) or die ($qry);

							while($row=mysqli_fetch_array($res)){
								echo 	"<div class='
												provItem 
												col-xs-offset-2
												col-sm-offset-1 
												col-md-2
												col-sm-3
												col-xs-4'>
													<a href='/BasketBaseWeb/pages/ajustes/servicio/lista.php?prov=".$row["cp"]."'>".utf8_encode($row["nombre"])."</a>
										</div>";
							};
						}
						else{
							$qryPP="SELECT patrocinador FROM permiso_patro WHERE dni='".$row['dni']."'";
							$resPP=mysqli_query($con, $qryPP) or die ($qryPP);
							$lon=mysqli_num_rows($resPP);

							if($lon>0){
								if($lon>1){
									$qryCP="SELECT DISTINCT provincia FROM patrocinadores WHERE codigo IN (".$qryPP.")";
									$resCP=mysqli_query($con, $qryCP) or die ($qryCP);
									if(mysqli_num_rows($resCP)>1){
										$qryP="SELECT * FROM provincias WHERE cp IN (".$qryCP.") ORDER BY cp";
										$resP=mysqli_query($con, $qryP) or die ($qryP);

										while($rowP=mysqli_fetch_array($resP)){
											echo 	"<div class='
															provItem 
															col-xs-offset-2
															col-sm-offset-1 
															col-md-2
															col-sm-3
															col-xs-4'>
																<a href='/BasketBaseWeb/pages/ajustes/servicio/lista.php?prov=".$rowP["cp"]."'>".utf8_encode($rowP["nombre"])."</a>
													</div>";
										};
									}
									else{
										$rowCP=mysqli_fetch_assoc($resCP);
										header("Location: http://localhost/BasketBaseWeb/pages/servicio/club/lista.php?prov=".$rowCP['provincia']);
										exit();
									}
								}
								else{
									$rowPP=mysqli_fetch_assoc($resPP);
									header("Location: http://localhost/BasketBaseWeb/pages/ajustes/servicio/ofertas.php?club=".$rowPP['servicio']);
									exit();
								}
							}
							else{
								header("Location: http://localhost/BasketBaseWeb/errors/403.html");
								exit();
							}
						}
					?>
				</div>
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