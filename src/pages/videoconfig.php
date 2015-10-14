<h1>Your video is ready for publishing!</h1>
<form method="POST" action="operaciones.php?op=videoconfig">
  <input type="hidden" name="videoid" value="<?php echo $_GET['id']; ?>"/><br>
	<input type="text" name="title" placeholder="Video title" required="required"/><br>
  <textarea rows="4" cols="50" name="tags" placeholder="Tags: love, hate, fun" required="required"/></textarea><br>
  <button class="btn waves-effect waves-light" type="submit" name="registrar" style="margin-top:-6px">
    Publish video <i class="material-icons right"></i>
	</button>
</form>
