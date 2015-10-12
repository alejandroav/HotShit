<?php
	if (isset($_GET["op"]) && $_GET["op"]) {
		switch($_GET["op"]){
			case "uploadvideo":
				require ("libs/ffmpeg.class.php");
				$FFmpeg = new FFmpeg;
				$storeFolder = 'uploads';
				if (!empty($_FILES)) {
					$tempFile = $_FILES['file']['tmp_name'];
					$extension = pathinfo($tempFile, PATHINFO_EXTENSION);
					$name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
					$targetPath = dirname(__FILE__)."/".$storeFolder."/";
					$targetFile = $targetPath.$name.".mp4";
					if (file_exists($tempFile)) {
						exec("/bin/ffmpeg -i $tempFile -c:v libx264 -c:a aac -strict -2 $targetFile");
						if (file_exists($targetFile) && filesize($targetFile) > 0) die (json_encode(array("status" => "OK", "msg" => "Original: ".$tempFile." Nuevo: ".$targetFile)));
						else die (json_encode(array("status" => "ERROR", "msg" => "Error al copiar el archivo ".$targetFile)));
					} else die (json_encode(array("status" => "ERROR", "msg" => "Error al subir el archivo ".$tempFile)));
				} else die (json_encode(array("status" => "ERROR", "msg" => "Debe seleccionar algun archivo")));
			break;

			case 'login':
				// conectar a bd
				$servername = "localhost";
				$username = "root";
				$password = "";
				$db = "wezee";
			  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

				// consultamos si existe un usuario con ese nombre/email y esa contraseña
				$gsent = $conn->prepare("SELECT id,username,img from users where
					(username = '".$_POST['user']."' OR email = '".$_POST['user']."') AND password = '".$_POST['password']."'");
				$gsent->execute();
				$result = $gsent->fetch(PDO::FETCH_ASSOC);

				// si existe, cargamos sus datos en sesion y nos vamos al timeline
				if (count($result)>0) {
					session_start();
					$_SESSION['userid'] = $result['id'];
					$_SESSION['username'] = $result['username'];
					$_SESSION['userimg'] = $result['img'];
					header("Location: timelines.php");
				}
			break;

			case 'register':
				// conectar a bd
				$servername = "localhost";
				$username = "root";
				$password = "";
				$db = "wezee";
			  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

				// comprobar que no se repite el email ni el usuario, FALLA
				$gsent = $conn->prepare("SELECT count(id) from users where email = '".$_POST['email']."' or username='".
				$_POST['user']."');");
				$gsent->execute();
				$res = $gsent->fetch(PDO::FETCH_ASSOC);

				if ($res['count(id)']>0) {
					header("Location: index.php?user=error");
				}

				else {
					// crear el usuario
					$res = $conn-> exec("INSERT INTO users(username,email,password) VALUES ('".
					$_POST['user']."','".
					$_POST['email']."','".
					$_POST['password']."');");

					if ($res == 1) {
						header("Location: index.php?user=created");
					}
					else {
						header("Location: index.php?user=error");
					}
				}
			break;

			case 'logout':
				// nos cargamos la sesion y volvemos al login
				session_unset();
				header('Location: index.php');
			break;

			default:
				die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
			break;
		}
	} else die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
