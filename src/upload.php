<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Dropzone simple example</title>
		<script src="js/dropzone.js"></script>
		<link rel="stylesheet" href="css/dropzone.css"/>
	</head>
	<body>
		<form action="operaciones.php?op=uploadvideo" class="dropzone dz-clickable">
			<div class="dz-default dz-message">
				<span>Drop files here to upload</span>
			</div>
		</form>
		<input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;"/>
	</body>
</html>