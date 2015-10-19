<form align="middle" method="POST" action="operaciones.php?op=login">
	<?php if (isset($_GET["user"]) && $_GET["user"] == "error") echo "<h5>Usuario o contraseña incorrectos</h5>"; ?>
	<input type="text" name="user" placeholder="Usuario" required="required"/>
	<input type="password" name="password" placeholder="Contrase&ntilde;a" required="required"/>
	<button class="btn waves-effect waves-light" type="submit" name="action" style="margin:15px">
		Entrar <i class="material-icons right"></i>
	</button>
</form>
