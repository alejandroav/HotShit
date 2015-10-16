<?php
session_start();
if (!isset($_SESSION['userid'])) {header('Location: index.php');exit;}
if (!isset($_GET["id"])){header('Location: index.php');exit;}
$videoid = $_GET["id"];
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
	<body style="background-color:#FBFBFB">
		<a><?php include("pages/header.php"); ?>
		<div class="row">
			<div id="timelines" class="col s12 align-center">
				<div class="card green-white lighten-0" style="background-color: rgb(235, 235, '.round($color*(255/30)).')">
					<div class="card-content black-text">
						<span class="card-title black-text">Titulo tarjeta</span>
						<p>
							<div id="test-<?php echo $_GET["id"]; ?>" class="hvideo">
								<controls>
									<button class="play" title="Toggle playback"></button>
									<button class="play-pause paused" title="Toggle playback"></button>
									<extended>
										<bar class="position" title="Current position">
											<p class="meta">0:00</p>
										</bar>
										<bar class="total">
											<p class="meta" title="Total length">0:00</p>
										</bar>
										<bar class="buffered"></bar>
										<bar class="unbuffered"></bar>
										<button class="zoom" title="Zoom in/out"></button>
									</extended>
								</controls>
								<video width="640" height="480" poster="uploads/videothumb/poster.png" autobuffer>
									<source src="uploads/video/movie.mp4" type="video/mp4">
								</video>
							</div>
							<script>
								var video = $("#test-<?php echo $_GET["id"]; ?>").hvideo();

							</script>
						</p>
					</div>
					<div class="card-action">
						<div class="chip">
							<img src="uploads/userimg/<?php echo $_SESSION["userimg"]; ?>" alt="#"><?php echo $_SESSION["username"]; ?>
						</div>
						<a href="#"><img class="responsive-img" src="resources/images/wink.png" alt="favoritos" width="25"/></a>
						<a href="javascript:like(<?php echo $videoid; ?>,<?php echo $_SESSION['userid']; ?>);" id="like<?php echo $videoid; ?>">ZeeIt</a>
					</div>
				</div>
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
