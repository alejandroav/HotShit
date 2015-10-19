<?php
session_start();
include("resources/libs/class.pdohelper.php");
include("config.php");
$dbc = new PDOHelper($servername, $username, $password, $db);
if (!isset($_SESSION['userid']))
	header('Location: '.$rutaAbsoluta.'index');
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
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/jquery-ui.min.css" type="text/css" charset="utf-8">
		<link rel="stylesheet" href="<?php echo $rutaAbsoluta; ?>resources/css/jquery-combobox.css" type="text/css" charset="utf-8">
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/materialize.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/jquery-combobox.js" type="text/javascript" charset="utf-8"></script>
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
						<input type="button" id="general_actualizar" class="actualizar" value="Actualizar"/>
					</div>
				</div>
				<div class="col s4" id="users-container">
					<h2>Usuarios</h2>
					<div style="text-align: center;">
						<select id="combobox-users">
							<option value=''>Todos</option>
							<?php 
								$query = $dbc->query("SELECT id, username FROM users WHERE id in (SELECT followed FROM follows where follower = ".$_SESSION['userid'].")");
								while ($info = $dbc->fetch($query)){
									echo "<option value='".$info["id"]."'>@".$info["username"]."</option>";
								}
							?>
						</select>
					</div>
					<script>
						$(function() {
							$("#combobox-users").combobox();
							$("#toggle").click(function() {
								$("#combobox-users").toggle();
							});
						});
					</script>
					<!--<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>-->
				</div>
				<div class="col s4" id="tags-container">
					<h2>Tags 
					<span style="font-size:15px">
							<a href="javascript:followTag($('#tags-container').find('.custom-combobox-input').val())" class="btn-floating waves-effect waves-light red" style="background-color:rgb(255,236,50);margin-top:-20px"><i class="material-icons" style="background-color:rgb(255,236,50);color:black">add</i></a>
					</span></h2>
					<div style="text-align: center;">
						<select id="combobox-tags">
							<option value=''>Todos</option>
							<?php
								$query = $dbc->query("select tag from followtags where follower = ".$_SESSION['userid']."");
								while ($result = $dbc->fetch($query)){
									echo "<option value='".$result["tag"]."'>".$result["tag"]."</option>";
								}
							?>
						</select>
					</div>
					<script>
						$(function() {
							$("#combobox-tags").combobox();
							$("#toggle").click(function() {
								$("#combobox-tags").toggle();
							});
						});
					</script>
					<!--<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>-->
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
			$(document).ready(function(){
				$('#general_actualizar').click(function(){
					loadRow('general');
				});
				$("#combobox-users").on("change", function(){
					loadRow('users', $("#combobox-users").val());
				});
				$("#combobox-tags").on("change", function(){
					loadRow('tags', $("#combobox-tags").val());
				});
				$('#users-container').find('.custom-combobox-input').keypress(function(e) {
					if ( e.which == 13 ) {
						e.preventDefault();
						//loadRow('users', $('#users-container').find('.custom-combobox-input').val());
					}
				});
				$('#tags-container').find('.custom-combobox-input').keypress(function(e) {
					if ( e.which == 13 ) {
						e.preventDefault();
						loadRow('tags', $('#tags-container').find('.custom-combobox-input').val());
					}
				});
			});
		</script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/timelines.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/scroll.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/uploader.js"></script>
	</body>
</html>
