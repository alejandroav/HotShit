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
		<link rel="stylesheet" href="resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="resources/css/frontline.css"/>
		<link rel="stylesheet" href="resources/css/hvideo.css" type="text/css" charset="utf-8">
		<script src="resources/js/jquery-2.1.4.min.js"></script>
		<script src="resources/js/materialize.min.js"></script>
		<script src="resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
			<script type="text/javascript">
				function like(videoid,userid) {
					Materialize.toast('YLELELELE video!', 3000);
						$.ajax({
						method: "POST",
						url: "operaciones.php?op=like",
						data: {video_id:videoid,user_id:userid},
						success: function(response) {
							// colorear el enlace de like
							if (IsJsonString(response)){
								response = $.parseJSON(response);
								if (response.status == "OK") {
									$('#like'+videoid).css('font-weight', 'bold');
										Materialize.toast('You liked this video!', 3000);
								} else {
									Materialize.toast('Error: video could not be liked', 3000);
								}
							}
						}
					});
				}
			</script>
	</head>
	<body style="background-color:#FBFBFB">
		<a><?php include("pages/header.php"); ?>
		<div style="padding:10px">
			<?php include("pages/uploader.php"); ?>
		</div>

		<div class="row">
			<div class="col s3">
				<div class="align-center" style="padding:20px;">
					<?php include("pages/sidebar.php");?>
				</div>
			</div>
			<div id="timelines" class="col s9 align-center">
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
			function loadMore(){
				//Materialize.toast("This is our ScrollFire Demo!", 1500 )
				var circle = '<div id="loadmore" class="preloader-wrapper active" style="margin-left: '+($("#timelines").width()/2)+'px;"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
				$("#timelines").append(circle);
				$.ajax({
					url: 'pages/timelines.php',
					success: function(res) {
						$("#timelines").append(res);
						$("#loadmore").remove();
					}
				});
			}
			var options = [
				{selector: '#timelines', offset: $('#timelines').height(), callback: 'loadMore()' }
			];
			Materialize.scrollFire(options);
		</script>
		<script src="resources/js/scroll.js"></script>
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
