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
													<a href="#">ZeeIt</a>
													</div>
												</div>';
							}
				echo "</div></div></ul>";
			}
		?>
		<?php include("pages/header.php"); ?>
		<div>
			<?php include("pages/uploader.php"); ?>
		</div>
		<div class="row">
				<div class="col s3">
					<div class="align-center" style="padding: 20px;">
						<?php include("pages/sidebar.php");?>
					</div>
				</div>
				<div class="col s9">
					<div class="align-center" style="padding: 20px;">
							<?php Video();?>
							<?php Video();?>
							<?php Video();?>
					</div>
				</div>
		</div>
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
