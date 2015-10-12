<div id="uploader" class="col s4 center-align uploader hide-on-med-and-down">
Arrastra aqui o haz click para subir un video
</div>
<input type="file" class="hide-on-large-only" name="file" id="uploader-input" accept="video/*"/>
<script>
$(document).ready(function() {
	startUploadZone("uploader");
});
</script>