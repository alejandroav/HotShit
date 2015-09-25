<?php
	if (isset($_GET["op"]) && $_GET["op"]) {
		switch($_GET["op"]){
			case "uploadvideo":
				require ("libs/ffmpeg.class.php");
				$FFmpeg = new FFmpeg;
				$ds = DIRECTORY_SEPARATOR;
				$storeFolder = 'uploads';
				if (!empty($_FILES)) {
					$tempFile = $_FILES['file']['tmp_name'];
					$extension = pathinfo($tempFile, PATHINFO_EXTENSION);
					$name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
					$targetPath = dirname(__FILE__).$ds.$storeFolder.$ds;
					$targetFile = $targetPath.$name.".mp4";
					if (file_exists($tempFile)) {
						$FFmpeg->input($tempFile);
						$FFmpeg->output($targetFile);
						if ($FFmpeg->ready()){
							if (file_exists($targetFile)) die (json_encode(array("status" => "OK", "msg" => "Original: ".$tempFile." Nuevo: ".$targetFile)));
							else die (json_encode(array("status" => "ERROR", "msg" => "Error al copiar el archivo ".$targetFile)));
						} else die (json_encode(array("status" => "ERROR", "msg" => "Error al convertir al archivo ".$targetFile)));
					} else die (json_encode(array("status" => "ERROR", "msg" => "Error al subir el archivo ".$tempFile)));
				} else die (json_encode(array("status" => "ERROR", "msg" => "Debe seleccionar algun archivo")));
			break;
			default:
				die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
			break;
		}
	} else die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));