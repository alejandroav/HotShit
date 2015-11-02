<form id="login" align="middle" method="POST" action="operaciones.php?op=login">
	<span id="error"></span>
	<input type="text" name="user" placeholder="Usuario" required="required"/>
	<input type="password" name="password" placeholder="Contrase&ntilde;a" required="required"/>
	<button class="btn waves-effect waves-light" type="submit" name="action" style="margin:15px">
		Entrar <i class="material-icons right"></i>
	</button>
</form>
<script>
	$('#login').ajaxForm({
		success: function(res){
			console.log(res);
			if (res == "ok") location.href="/timelines";
			else $("#error").html("Usuario o contraseña incorrectos");
		}
	});
</script>