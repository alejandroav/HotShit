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
				<div class="col s4">
					<h2>Usuarios</h2>
					<div style="text-align: center;">
						<select id="combobox-users">
							<option value=''>Todos</option>
							<?php 
								$query = $dbc->query("SELECT followed FROM follows where follower = ".$_SESSION['userid']);
								while ($result = $dbc->fetch($query)){
									$res = $dbc->query("SELECT id, username FROM users WHERE id=".$result["followed"]);
									$info = $dbc->fetch($res);
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
				<div class="col s4">
					<h2>Tags 
					<span style="font-size:15px">
						<input style="color:black;" size="15">
							<a class="btn-floating waves-effect waves-light red" style="background-color:rgb(255,236,50)"><i class="material-icons" style="background-color:rgb(255,236,50);color:black">add</i></a>
						</input>
					</span></h2>
					<div style="text-align: center;">
						<select id="combobox-tags">
							<option value=''>Todos</option>
							<?php
								$query = $dbc->query("SELECT tag FROM tags");
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
					loadRow('tags', $("#combobox-users").val());
				});
			});
		</script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/timelines.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/scroll.js"></script>
		<script src="<?php echo $rutaAbsoluta; ?>resources/js/uploader.js"></script>
	</body>
</html>
