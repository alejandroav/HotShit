<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>Dropzone simple example</title>
		<script src="js/jquery-2.1.4.min"></script>
		<script src="js/dropzone.js"></script>
		<script src="js/materialize.min.js"></script>
		<link rel="stylesheet" href="css/dropzone.css"/>
		<link rel="stylesheet" href="css/materialize.min.css"/>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div class="dropzone"></div>
		<script>
			var options = {
				url: "operaciones.php?op=uploadvideo",
				acceptedFiles: "video/*",
				dictDefaultMessage: "Arrastre sus archivos o haga click aqui para subirlos.",
				error: function(res, res2) {
					alert("ERROR: consulta la consola para mas informacion");
					console.log(res2);
				},
				success: function(res, res2) {
					alert("OK: consulta la consola para mas informacion");
					console.log(res2);
				}
			};
			$("#upload").dropzone(options);
		</script>
	</body>
</html>