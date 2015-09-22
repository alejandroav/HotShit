<?php
	if (isset($_GET["op"]) && $_GET["op"]) {
		switch($_GET["op"]){
			case "uploadvideo":
				require ("ffmpeg.class.php");
				$FFmpeg = new FFmpeg;
				$FFmpeg->input( 'video.avi' )->output( 'video.mp4' )->ready();
			break;
			default:
				die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida"));
			break;
		}
	} else die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida"));