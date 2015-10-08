<div id=""+id class="col s4 center-align">
Arrastra aqui o haz click para subir tus archivos
</div>
<input type="file" style="display: none;" name=""+id id="uploader-input"/>
<style>
	#uploader {
		border:2px dashed black;
		color:#92AAB0;
		padding: 10px;
		cursor: pointer;
		font-size: 100%;
	}
	#uploader.attention{
		border:2px dashed red;
	}
	#uploader.filecharged{
		border:2px solid red !important;
	}
	
	.progressBar {
		width: 200px;
		height: 22px;
		border: 1px solid #ddd;
		border-radius: 5px; 
		overflow: hidden;
		display:inline-block;
		margin:0px 10px 5px 5px;
		vertical-align:top;
	}
	
	.progressBar div {
		height: 100%;
		color: #fff;
		text-align: right;
		line-height: 22px; /* same as #progressBar height if we want text middle aligned */
		width: 0;
		background-color: #0ba1b5; border-radius: 3px; 
	}
	.statusbar {
		border-top:1px solid #A9CCD1;
		min-height:25px;
		width:700px;
		padding:10px 10px 0px 10px;
		vertical-align:top;
	}
	.statusbar:nth-child(odd){
		background:#EBEFF0;
	}
	.filename {
		display:inline-block;
		vertical-align:top;
		width:250px;
	}
	.filesize {
		display:inline-block;
		vertical-align:top;
		color:#30693D;
		width:100px;
		margin-left:10px;
		margin-right:5px;
	}
	.abort{
		background-color:#A8352F;
		-moz-border-radius:4px;
		-webkit-border-radius:4px;
		border-radius:4px;display:inline-block;
		color:#fff;
		font-family:arial;font-size:13px;font-weight:normal;
		padding:4px 15px;
		cursor:pointer;
		vertical-align:top;
	}
</style>
<script>
function sendFileToServer(formData,status) {
	var uploadURL ="http://hayageek.com/examples/jquery/drag-drop-file-upload/upload.php";
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
			status.setProgress(100);
			$("#status1").append("File upload Done<br>");		
		}
	}); 

	status.setAbort(jqXHR);
}
var rowCount=0;
function statusBar(id) {
	rowCount++;
	var row="odd";
	if(rowCount %2 ==0) row ="even";
	$("#"+id).html("");
	$("#"+id).removeClass();
	$("#"+id).addClass("statusbar");
	/*this.statusbar = $("<div class='statusbar "+row+"'></div>");
	this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
	this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
	this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
	this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
	obj.after(this.statusbar);*/
	this.setFileNameSize = function(name,size) {
		var sizeStr="";
		var sizeKB = size/1024;
		if(parseInt(sizeKB) > 1024) {
			var sizeMB = sizeKB/1024;
			sizeStr = sizeMB.toFixed(2)+" MB";
		} else {
			sizeStr = sizeKB.toFixed(2)+" KB";
		}
		this.filename.html(name);
		this.size.html(sizeStr);
	}
	this.setProgress = function(progress) {	  
		var progressBarWidth =progress*this.progressBar.width()/ 100;  
		this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
		if(parseInt(progress) >= 100) {
			this.abort.hide();
		}
	}
	this.setAbort = function(jqxhr) {
		var sb = this.statusbar;
		this.abort.click(function() {
			jqxhr.abort();
			sb.hide();
		});
	}
}
function handleFileUpload(files, id) {
	if (files.length == 1) {
		var fd = new FormData();
		fd.append('file', files[0]);
		var statusBar = new StatusBar(id);
		//Convertir Div drag&drop en barra de subida
	} else {
		//Mostrar error
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
});
</script>