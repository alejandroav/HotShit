<<<<<<< HEAD
=======
<!DOCTYPE html>
>>>>>>> 2719f76ca9d840f22fee5e12efd058eb02805c63
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta charset="utf-8"/>
		<title>HotShit</title>
<<<<<<< HEAD
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/materialize.min.js"></script>
		
		<link rel="stylesheet" href="css/materialize.min.css"/>
		<script>
		 $(document).ready(function(){
			$('.slider').slider({full_width: true});
			});
		</script>
		<style>
			.slider{
				z-index: -3;
				position:absolute;	
			}
			.fondo{
				z-index:-2;
				position:fixed;
				top:50%;
				left:50%;
				margin-top:-100;
				margin-left:-150;
				width: 300px;
				height: 200px;
				overflow:hidden;
				background-color:#999999;
				border-radius: 25px;
				opacity:0.9;
				border: 4px solid #EEEE23;
				
				text-align:center;
			}
			.entrada{
				z-index:-1;
				padding: 20px;
				opacity:1;
			}
			.logo-arriba{
				z-index:0;
				position:fixed;
				top:30%;
				left:50%;
				margin-top:-75;
				margin-left:-75;
				width:150px;
				height:150px;
				border-radius: 75px;
				border: 4px solid #EEEE23;
			}
			
		</style>
	</head>
	<body>
		<div class="logo-arriba">
			<img src="images/logo.png" width="142px" height="142px">
		</div>
		<div class="fondo">
		<div class="entrada">
			<form align="middle"; method="POST" action="operaciones.php?op=register">
				<input type="text" name="user" placeholder="Username"></input>
				<input type="password" name="password" placeholder="Password"></input>
				<button class="btn waves-effect waves-light" type="submit" name="action">Entrar
				<i class="material-icons right"></i></input>
				</button>
			</form>
		</div>
		</div>
		<div class="slider fullscreen">
		<ul class="slides">
		  <li>
			<img src="images/fondo1.jpg"> <!-- random image -->
		  </li>
		  <li>
			<img src="images/fondo3.jpg"> <!-- random image -->
		  </li>
		  <li>
			<img src="images/fondo4.jpg"> <!-- random image -->
		  </li>
		  <li>
			<img src="images/fondo5.jpg"> <!-- random image -->
		  </li>
		</ul>
	  </div>
		
=======
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
>>>>>>> 2719f76ca9d840f22fee5e12efd058eb02805c63
	</body>
</html>