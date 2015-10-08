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
		<style>
			div.video1{padding:20px;}
			div.video2{float:left;margin-left:100px;}
		</style>
	</head>
	<body style="background-color:#FBFBFB">
		<?php
		function Video(){
			echo "<ul>";
			for ($x = 0; $x <= 9; $x++) {
				echo "<il><div class='video1'>
				<img src='http://static.elobservador.com.uy/adjuntos/184/imagenes/000/298/0000298815.png' alt='Video'  width='310px' height='206px'>
				</div>
				<div class='video2'>
				<p><b> Titulo muy largo </b></p>
				</div></il>";
			}
			echo "</ul>";
		}
		?>
		<?php include("pages/header.php"); ?>
		<div>
			<div class="align-center" style="padding: 20px;">
				<?php include("pages/uploader.php"); ?>
			</div>
		</div>
		<div class="z-depth-2" style="padding:20px;float:left;border:1px solid black">
			<div style="border:1px solid black">
				<img src="uploads/userimg/<?php echo $_SESSION['userimg']; ?>" alt="Usuario"  width="130" height="130"/>
			</div>
			<div style="padding:10px"></div>
			<div style="background-color:#F9FE6F;padding:10px">
				<div class="align-center">
					<p style="font-size:120%"><b>Estadisticas</b></p>
				</div>
				<div class="divider"></div>
				<p>100 <span style="color:green">Me gustas</span></p>
				<p>100 <span style="color:green">Reproducciones</span></p>
			</div>
		</div>
		<div style="float:left; padding:15px"></div>
		<div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>
		<div style="float:left; padding:15px"></div>
		<div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>
		<div style="float:left; padding:15px"></div>
		<div class="z-depth-2" style="border:1px solid black; float:left;"><?php Video() ?></div>
	</body>
</html>
