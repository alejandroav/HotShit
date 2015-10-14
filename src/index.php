<?php
session_start();
if (isset($_SESSION['userid']))
	header('Location: timelines.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<script src="resources/js/jquery-2.1.4.min.js"></script>
		<script src="resources/js/materialize.min.js"></script>
		<link rel="stylesheet" href="resources/outdatedbrowser/outdatedBrowser.min.css">
		<link rel="stylesheet" href="resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="resources/css/out.css"/>
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
	</head>
	<body>
		<div id="outdated"></div>
		<div class="chg_button">
			<button class="btn waves-effect waves-light" type="submit" name="action" id="chg_button">Sign in/Sign up</button>
		</div>
		<div class="frente">
			<div class="logo-arriba">
				<img src="resources/images/logo.png" width="143px" height="143px">
			</div>
			<div class="fondo">
				<div class="entrada" id="formcontent">
					<?php include("pages/login.php"); ?>
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
				<li>
					<img src="resources/images/fondo1.jpg"/>
				</li>
				<li>
					<img src="resources/images/fondo3.jpg"/>
				</li>
				<li>
					<img src="resources/images/fondo4.jpg"/>
				</li>
				<li>
					<img src="resources/images/fondo5.jpg"/>
				</li>
			</ul>
		</div>
		<script src="resources/outdatedbrowser/outdatedBrowser.min.js"></script>
	</body>
</html>
