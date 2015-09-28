<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>HotShit</title>
		<script src="js/jquery-2.1.4.min"></script>
		<script src="js/materialize.min.js"></script>
		<link rel="stylesheet" href="css/materialize.min.css"/>
	</head>
	<body>
		<form method="POST" action="operaciones.php?op=login">
			<input type="text" name="user" placeholder="Username"></input><!-- Usuario o E-mail -->
			<input type="password" name="password" placeholder="Password"></input>
			<input type="submit" value="Enviar!"/>
		</form>
	</body>
</html>