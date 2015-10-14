<?php
session_start();
   $_SESSION['userid'] = 0;
     $_SESSION['username'] = "caca";
     $_SESSION['userimg'] = "";
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
		<link rel="stylesheet" href="resources/css/frontline.css"/>
	</head>
	<body style="background-color:#FBFBFB">
		<a name="top"><?php include("pages/header.php"); ?>
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
		<div class="fixed-action-btn" style="bottom:45px; right:24px;">
			<a href="#top">
			 <i class="waves-effect waves-light btn boton_subir">Subir</i>
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
		<script src="resources/js/uploader.js"></script>
	</body>
</html>
