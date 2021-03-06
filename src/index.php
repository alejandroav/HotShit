<?php
session_start();
include("config.php");
if (isset($_SESSION['userid']))
	header('Location: '.$rutaAbsoluta.'timelines.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/out.css"/>
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $rutaAbsoluta; ?>resources/images/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $rutaAbsoluta; ?>resources/images/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $rutaAbsoluta; ?>resources/images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $rutaAbsoluta; ?>resources/images/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $rutaAbsoluta; ?>resources/images/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $rutaAbsoluta; ?>resources/images/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo $rutaAbsoluta; ?>resources/images/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/materialize.min.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/modernizr-custom.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery.form.min.js"></script>
		<script>
		if (!Modernizr.json || !Modernizr.video || !Modernizr.filereader || !Modernizr.fullscreen || !Modernizr.eventlistener || !Modernizr.inputtypes.email || !Modernizr.cssanimations || !Modernizr.backgroundsize || !Modernizr.opacity) {
			location.href="http://outdatedbrowser.com";
		}
		</script>
	</head>
	<body>
		<div class="chg_button">
			<button class="btn waves-effect waves-light" type="submit" name="action" id="chg_button">Entrar/Registro</button>
		</div>
		<div class="frente">
			<div class="logo-arriba">
				<img src="<?php echo $rutaAbsoluta; ?>resources/images/logofinal.png" width="143px" height="143px">
			</div>
			<div class="fondo">
				<div class="entrada" id="formcontent">
					<?php include("pages/login.php"); ?>
					<a href="<?php echo $rutaAbsoluta; ?>pages/recover.php">Has olvidado tu contrase&ntilde;a?</a>
				</div>
			</div>
			<div class="isotipo">
				<div class="right hide-on-med-and-down">
					You live it, <span style="color:yellow">WeZee</span> it.
				</div>
			</div>
		</div>
		<div class="slider fullscreen">
			<ul class="slides">
				<?php for ($i = 1; $i <= 11; $i++)
					echo "
				<li>
					<img src='resources/images/fondo".$i.".jpg'/>
				</li>";
				?>
			</ul>
		</div>
		<script>
		$(document).ready(function(){
			var page = "login";
			$('.slider').slider({full_width: true, indicators: false});
			$('#chg_button').click(function(){
				if (page == "login"){
					page = "register";
					$.ajax({
						url: "pages/register.php",
						success: function(res) {
							$("#formcontent").html(res);
						}
					});
				} else if (page == "register"){
					page = "login";
					$.ajax({
						url: "pages/login.php",
						success: function(res) {
							$("#formcontent").html(res);
						}
					});
				}
			});
		});
		</script>
	</body>
</html>
