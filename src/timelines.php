<?php
session_start();
if (!isset($_SESSION['userid']))
	header('Location: index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<script src="resources/js/jquery-2.1.4.min"></script>
		<script src="resources/js/materialize.min.js"></script>
		<link rel="stylesheet" href="resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="resources/css/frontline.css"/>
	</head>
	<body style="background-color:#FBFBFB">
		<?php
			function Video(){
				// imprimimos tarjetas con cada video.
				// hay que pasar por parametro si queremos videos populares o tags populares
				echo "<ul>";
				echo "<div style='float:left;padding:5px'>
							<div class='col s4'>
							<h2>Titulo columna</h2>";
							for ($x = 0; $x <= 9; $x++) {
									echo '<div class="card green-white lighten-0" style="background-color: rgb(255, 255, '.round($x*(255/9)).')">
													<div class="card-content black-text">
														<span class="card-title black-text">Titulo tarjeta</span>
														<p>Descripcion</p>
													</div>
													<div class="card-action">
													<a href="#">Favoritos</a>
													<a href="#">Retweet</a>
													</div>
												</div>';
							}
				echo "</div></div></ul>";
			}
		?>
		<?php include("pages/header.php"); ?>
		<div>
			<div class="align-center" style="oadding: 20px;">
				<?php include("pages/frontline.php");>
			</div>
			<div class="align-center" style="padding: 20px;">
				<?php include("pages/uploader.php"); ?>
			</div>
		</div>
		<!--<div class="z-depth-2" style="padding:20px;float:left;border:1px solid black">
			<div style="border:1px solid black">
				<img src="uploads/userimg/<?php echo $_SESSION['userimg']; ?>" alt="Usuario" height="130"/>
			</div>
			<div style="padding:10px"></div>
			<div style="background-color:#F9FE6F;padding:10px">
				<div class="align-center">
					<p style="font-size:120%"><b>Estadisticas</b></p>
				</div>
				<div class="divider"></div>
				<p>CONTADOR <span style="color:green">Me gustas</span></p>
				<p>CONTADOR <span style="color:green">Reproducciones</span></p>
			</div>
		</div>-->
		<?php Video();?>
		<?php Video();?>
		<?php Video();?>
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
