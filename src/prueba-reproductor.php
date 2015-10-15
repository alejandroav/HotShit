<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Wezee</title>
		<script src="resources/js/jquery-2.1.4.min"></script>
		<script src="resources/js/materialize.min.js"></script>
		<script src="resources/js/jquery.hvideo.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="resources/css/materialize.min.css"/>
		<link rel="stylesheet" href="resources/css/frontline.css"/>
		<link rel="stylesheet" href="resources/css/hvideo.css" type="text/css" charset="utf-8">
	</head>
	<body>
		<div id="test1" class="hvideo">
			<controls>
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
			<video width="640" height="360" poster="poster.jpg" autobuffer>
				<source src="uploads/movie.mp4" type="video/mp4">
			</video>
		</div>
		<script>
			$('#test1').hvideo();
		</script>
	</body>
</html>