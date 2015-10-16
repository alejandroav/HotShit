<?php
session_start();
if (!isset($_SESSION['userid']))
	header('Location: index.php');

		global $contador;
		global $k;
		$contador = $k = 0;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
		<link rel="stylesheet" href="resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="resources/css/frontline.css"/>
		<link rel="stylesheet" href="resources/css/hvideo.css" type="text/css" charset="utf-8">
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<script src="resources/js/jquery-2.1.4.min.js"></script>
		<script src="resources/js/materialize.min.js"></script>
		<script src="resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
				function like(videoid,userid) {
						$.ajax({
						method: "POST",
						url: "operaciones.php?op=like",
						data: {video_id:videoid,user_id:userid},
						success: function(response) {
							console.log("Respuesta: " + response);
							// colorear el enlace de like
							if (IsJsonString(response)) {
								var res = $.parseJSON(response);
								if (res.status == "OK") {
									$('#like'+videoid).css('font-weight', 'bold');
									Materialize.toast('You liked this video!', 1000);
								}
								if (res.status == "ERROR") {
									Materialize.toast('Error: video could not be liked', 1000);
								}
							}
						}
					});
				}
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
					<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>
				</div>
				<div class="col s4">
					<h2>Usuarios</h2>
					<div class="search-wrapper" style="background-color:transparent;text-align:center;">
						<input id="search">
						<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20" style="margin-left:-28px;margin-bottom:-5px;"/></a>
						<div class="search-results"></div>
					</div>
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
			function loadMore(contador){
				//Materialize.toast("This is our ScrollFire Demo!", 1500 )
				var circle = '<div id="loadmore" class="preloader-wrapper active" style="margin-left: '+
				($("#timelines").width()/2)
				+'px;"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
				$("#timelines").append(circle);
				$.ajax({
					method: "POST",
					url: 'pages/timelines.php',
					data: {valor:contador},
					success: function(res) {
						$("#timelines").append(res);
						$("#loadmore").remove();
					}
				});
			}

			var contador=0;
			$(window).scroll(function () {
				if (($(window).height() + $(window).scrollTop()) == $(document).height()) {
					contador+=10;
					setTimeout(function(){ loadMore(contador); }, 300);
				}
			});
		</script>
		<script src="resources/js/scroll.js"></script>
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
