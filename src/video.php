<?php
session_start();
include("config.php");
include("resources/libs/class.pdohelper.php");
include("pages/video.class.php");
if (!isset($_SESSION['userid'])) {header('Location: '.$rutaAbsoluta.'index.php');exit;}
if (!isset($_GET["id"])){header('Location: '.$rutaAbsoluta.'index.php');exit;}
$video = new Video("unico", $_GET["id"], 0); 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/materialize.min.css" type="text/css" charset="utf-8"/>
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/frontline.css" type="text/css" charset="utf-8"/>
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/hvideo.css" type="text/css" charset="utf-8">
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/materialize.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body style="background-color:#35352D">
		<a><?php include("pages/header.php"); ?>
		<div class="row">
			<div id="timelines" class="col s12 align-center">
				<?php $video->showVideo();?>
			</div>
		</div>
		<div id="bt_top" class="fixed-action-btn boton_subir" style="bottom:45px; right:24px;">
			 <a class="btn-floating btn-large waves-effect waves-light boton_subir_colores">
				<i class="material-icons md-36 elblack">keyboard_arrow_up</i>
			 </a>
		</div>
		<div id="popup-background" class="popup-background">
			<div id="popup" class="popup"></div>
		</div>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/uploader.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/timelines.js"></script>
	</body>
</html>
