	<style>
	textarea{
	 height: 100px;
	}
	</style>

	<div style="padding:7px">
	</div>
	<h1 style="text-align:center">Your video is ready for publishing!</h1>
	
	<form style="margin:50px" method="POST" action="operaciones.php?op=videoconfig">
		<input type="hidden" name="videoid" value="<?php echo $_GET['id']; ?>"/><br>
		<input type="text" name="title" placeholder="Video title" required="required"/><br>
		<textarea  rows="4" cols="50" name="tags" placeholder="Tags: love, hate, fun" required="required"/></textarea><br>
		<div class="center-align" style="margin-top:7px">
			<button class="btn waves-effect waves-light" type="submit" name="registrar" style="margin-top:-6px">
				Publish video <i class="material-icons right"></i>
			</button>
		</div>
	</form>
