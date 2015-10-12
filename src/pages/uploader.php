<div id="uploader" class="col s4 center-align uploader hide-on-med-and-down">
Arrastra aqui o haz click para subir un video
</div>
<input type="file" class="hide-on-large-only" name="file" id="uploader-input" accept="video/*"/>
<style>
	.uploader {
		border:2px dashed black;
		color:#92AAB0;
		padding: 10px;
		cursor: pointer;
		font-size: 100%;
	}
	.uploader.attention{
		border:2px dashed red;
	}
	.uploader.filecharged{
		border:2px solid red !important;
	}
</style>
<script>
var circle = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
function sendFileToServer(formData,status) {
	var uploadURL ="operaciones.php?op=uploadvideo";
	var jqXHR=$.ajax({
		xhr: function() {
			var xhrobj = $.ajaxSettings.xhr();
			if (xhrobj.upload) {
					xhrobj.upload.addEventListener('progress', function(event) {
						var percent = 0;
						var position = event.loaded || event.position;
						var total = event.total;
						if (event.lengthComputable) {
							percent = Math.ceil(position / total * 100);
						}
						status.setProgress(percent);
					}, false);
				}
			return xhrobj;
		},
		url: uploadURL,
		type: "POST",
		contentType:false,
		processData: false,
		cache: false,
		data: formData,
		success: function(data){
			console.log(data);
			//Comprobar que el video este convertido correctamente o mostrar error
			status.setProgress(100);
		}
	}); 

	status.setAbort(jqXHR);
}
var rowCount=0;
function StatusBar(id) {
	this.obj = $("#"+id);
	this.obj.unbind("click");
	this.obj.removeClass("uploader");
	this.obj.html('<div class="progress"><div class="determinate" style="width: 0%"></div></div>');
	this.progressBar = $($("#"+id+" > .progress")[0]);
	this.obj.append('<div class="percent">0%</div>');
	this.percent = $($("#"+id+" > .percent")[0]);
	this.obj.append('<button class="abort">X</button>');
	this.abort = $($("#"+id+" > .abort")[0]);
	this.setFileNameSize = function(name,size) {
		var sizeStr="";
		var sizeKB = size/1024;
		if(parseInt(sizeKB) > 1024) {
			var sizeMB = sizeKB/1024;
			sizeStr = sizeMB.toFixed(2)+" MB";
		} else {
			sizeStr = sizeKB.toFixed(2)+" KB";
		}
		//this.filename.html(name);
		//this.size.html(sizeStr);
	}
	this.setProgress = function(progress) {	  
		var progressBarWidth = progress*this.progressBar.width()/ 100;  
		this.progressBar.find('.determinate').animate({width: progressBarWidth}, 10);
		this.percent.html(progress + "%");
		if(parseInt(progress) >= 100) {
			this.obj.html("File upload Done");
			
			this.obj.hide(5000);
			//Mostrar "popup" de configuracion de video
		}
	}
	this.setAbort = function(jqxhr) {
		//console.log(this.abort);
		this.abort.on("click", function() {
			jqxhr.abort();
			obj.hide();
		});
	}
}
function handleFileUpload(files, id) {
	if (files.length == 1) {
		if (files[0].type.indexOf("video/") >= 0 && files[0].size > 1) {
			var fd = new FormData();
			fd.append('file', files[0]);
			console.log(files[0]);
			var statusBar = new StatusBar(id);
			console.log(statusBar.abort);
			//statusBar.setFileNameSize();
			sendFileToServer(fd,statusBar);
		} else {
			//Mostrar error de el archivo es invalido
		}
	} else {
		//Mostrar error de no se esta subiendo ningun archivo
	}
}
function startUploadZone(id) {
	$("#"+id).on('click', function(e){
		$("#"+id+"-input").trigger(e);
	});
	$("#"+id).on('dragenter', function (e) {
		e.stopPropagation();
		e.preventDefault();
		$("#"+id).addClass("filecharged");
	});
	$("#"+id).on('dragover', function (e) {
		e.stopPropagation();
		e.preventDefault();
		$("#"+id).addClass("filecharged");
	});
	$("#"+id).on('dragleave', function (e) {
		e.stopPropagation();
		e.preventDefault();
		$("#"+id).removeClass("filecharged");
	});
	$("#"+id).on('drop', function (e) {
		$("#"+id).removeClass("attention");
		$("#"+id).removeClass("filecharged");
		e.preventDefault();
		handleFileUpload(e.originalEvent.dataTransfer.files, id);
	});
	$("#uploader-input").on('change', function (e) {
		$("#"+id).removeClass("attention");
		$("#"+id).removeClass("filecharged");
		e.preventDefault();
		handleFileUpload(e.target.files, id);
	});
	$(document).on('dragenter', function (e)  {
		e.stopPropagation();
		e.preventDefault();
	});
	$(document).on('dragover', function (e)  {
		e.stopPropagation();
		e.preventDefault();
		$("#"+id).addClass("attention");
	});
	$(document).on('drop', function (e)  {
		e.stopPropagation();
		e.preventDefault();
	});
	$(document).on('dragleave', function (e)  {
		e.stopPropagation();
		e.preventDefault();
		$("#"+id).removeClass("attention");
	});
}
$(document).ready(function() {
	startUploadZone("uploader");
});
</script>