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
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="resources/css/materialize.min.css" type="text/css" charset="utf-8"/>
		<link rel="stylesheet" href="resources/css/frontline.css" type="text/css" charset="utf-8"/>
		<link rel="stylesheet" href="resources/css/hvideo.css" type="text/css" charset="utf-8">
		<link rel="stylesheet" href="resources/css/jquery-ui.min.css" type="text/css" charset="utf-8">
		<link rel="stylesheet" href="resources/css/jquery-combobox.css" type="text/css" charset="utf-8">
		<script src="resources/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="resources/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="resources/js/materialize.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
		<script src="resources/js/jquery-combobox.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
			</script>
	</head>
	<body style="background-color:#35352D">
		<a><?php include("pages/header.php"); ?>
		<div style="padding:10px">
			<?php include("pages/uploader.php"); ?>
		</div>

		<div class="row">
			<div id="timelines" class="col s12 align-center">
				<div class="col s4">
					<h2>General</h2>
					<div style="text-align:center">
						<button id="general_actualizar" class="actualizar">Actualizar</button>
					</div>
				</div>
				<div class="col s4">
					<h2>Usuarios</h2>
					<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>
					<script>
						$(function() {
							$( "#combobox" ).combobox();
							$( "#toggle" ).click(function() {
								$( "#combobox" ).toggle();
							});
						});
					</script>
				</div>
				<div class="col s4">
					<h2>Tags</h2>
					<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>
				</div>
				<?php include("pages/timelines.php"); ?>
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
		<script>
			var contador=0;
			$(window).scroll(function () {
				if (($(window).height() + $(window).scrollTop()) == $(document).height()) {
					contador+=10;
					setTimeout(function(){ loadMore(contador, 'general'); loadMore(contador, 'users'); loadMore(contador, 'tags'); }, 300);
				}
			});
		</script>
		<script src="resources/js/timelines.js"></script>
		<script src="resources/js/scroll.js"></script>
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
