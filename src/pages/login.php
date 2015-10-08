<?php
	if (isset($_SESSION['userid']))
		header('Location: timeline.php');
?>
<form align="middle" method="POST" action="operaciones.php?op=login">
	<input type="text" name="user" placeholder="Username or email" required="required"/>
	<input type="password" name="password" placeholder="Password" required="required"/>
	<button class="btn waves-effect waves-light" type="submit" name="action">
		Entrar <i class="material-icons right"></i>
	</button>
</form>
