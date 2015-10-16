<?php
	session_start();
	include("config.php");
	require("resources/libs/class.phpmailer.php");
	require("resources/libs/class.smtp.php");
	require("resources/libs/class.pdohelper.php");
	if (isset($_GET["op"]) && $_GET["op"]) {
		$dbc = new PDOHelper($servername, $username, $password, $db);
		switch($_GET["op"]) {
			case "uploadvideo":
				if (!isset($_SESSION['userid'])) die (json_encode(array("status" => "ERROR", "msg" => "No esta logueado")));
				$targetFolder = 'uploads/video';
				$thumbsFolder = 'uploads/videothumb';
				if (!empty($_FILES)) {
					$tempFile = $_FILES['file']['tmp_name'];
					$extension = pathinfo($tempFile, PATHINFO_EXTENSION);
					$name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
					$newname = $_SESSION["userid"].time();
					$targetPath = dirname(__FILE__)."/".$targetFolder."/";
					$thumbsPath = dirname(__FILE__)."/".$thumbsFolder."/";
					$targetFile = $targetPath.$newname.".mp4";
					$thumbsFile = $thumbsPath.$newname.".png";
					if (file_exists($tempFile)) {
						exec("/bin/ffmpeg -i $tempFile -c:v libx264 -c:a aac -strict -2 $targetFile");
						exec("/bin/ffmpeg -i $tempFile -ss 00:00:01.000 -vframes 1 $thumbsFile");
						if (file_exists($targetFile) && filesize($targetFile) > 0) {
							// comenzar conexion a bd para almacenar el video
							date_default_timezone_set('Europe/Berlin');
							$date = date('Y-m-d h:i:s', time());
							$query = "INSERT INTO videos (file,thumbnail,date,user) values (''".
							$targetFile."','".
							$thumbsFile."','".
							$date."',".
							$_SESSION['userid'].");";

							$res = $dbc->query($query);

							if ($dbc->queryDone()!==false) {
								die (json_encode(array("status" => "OK", "msg" => $dbc->insertId())));
							}
							else {
								die(json_encode(array("status" => "ERROR", "msg" => "Error al almacenar el video en base de datos.", "extra" => $dbc->getLastError())));
							}

							//
						}
						else die (json_encode(array("status" => "ERROR", "msg" => "Error al copiar el archivo ".$name.".mp4")));
					} else die (json_encode(array("status" => "ERROR", "msg" => "Error al subir el archivo ".$name.".mp4")));
				} else die (json_encode(array("status" => "ERROR", "msg" => "Debe seleccionar algun archivo")));
			break;

			case 'login':
				// consultamos si existe un usuario con ese nombre/email y esa contraseña
				$query = $dbc->query("SELECT id,username,img from users where
					(username = '".$_POST['user']."' OR email = '".$_POST['user']."') AND password = '".hash("sha512", $_POST['password'])."'");
				$result = $dbc->fetch($query);
				// si existe, cargamos sus datos en sesion y nos vamos al timeline
				if (count($result)>0) {
					session_start();
					$_SESSION['userid'] = $result['id'];
					$_SESSION['username'] = $result['username'];
					$_SESSION['userimg'] = $result['img'];
					if ($_SESSION['userimg'] == "")
						$_SESSION['userimg'] = 'nouser.jpg';

					header("Location: timelines.php");
				} else {
					header("Location: index.php?user=error");
				}
			break;

			case 'register':
				$query = "SELECT count(id) as c from users where email = '".$_POST['email']."' or username='".$_POST['user']."';";
				$resul = 0;
				//$query = $dbc->query($query);

				foreach($dbc->query($query) as $row)
					$resul = $row['c'];

				if ($resul > 0) {
					header("Location: index.php?user=error");
				}

				else {
					// crear el usuario
					$res = $dbc->query("INSERT INTO users(username,email,password) VALUES ('".
					$_POST['user']."','".
					$_POST['email']."','".
					hash("sha512", $_POST['password'])."');");

					if ($dbc->queryDone() == true) {
						// Mail them their key
						$mailbody = "¡Gracias por registrarte en www.wezee.es! Bienvenido a nuestra comunidad. Ya puedes iniciar sesión con tu usuario ".$_POST['user']." o con tu correo electrónico.";

						$mail = new PHPMailer;

						//$mail->SMTPDebug = 3;                               // Enable verbose debug output

						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'wezeevideo@gmail.com';                 // SMTP username
						$mail->Password = 'sisisitotalmente';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to

						$mail->setFrom('hola@wezee.es', 'WeZee Welcome Center');
						$mail->addAddress($userExists["email"]);     // Add a recipient
						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Bienvenido a WeZee';
						$mail->Body    = $mailbody;

						if(!$mail->send()) {
						    echo 'Message could not be sent.';
						    echo 'Mailer Error: ' . $mail->ErrorInfo;
						} else {
							header("Location: index.php?user=created");
						}
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

			case 'recover':
				// Was the form submitted?
				if (isset($_POST["ForgotPassword"])) {

					// Harvest submitted e-mail address
					if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
						$email = $_POST["email"];

					}else{
						echo "email is not valid";
						exit;
					}

					// Check to see if a user exists with this e-mail
					$query = $dbc->query("SELECT email FROM users WHERE email = '$email'");
					$userExists = $dbc->fetch($query);

					if ($userExists["email"])
					{
						// Create a unique salt. This will never leave PHP unencrypted.
						$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

						// Create the unique user password reset key
						$password = hash('sha512', $salt.$userExists["email"]);

						// Create a url which we will direct them to reset their password
						$pwrurl = "www.wezee.es/reset_password.php?q=".$password;

						// Mail them their key
						$mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.wezee.es\n\n".
						"To reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";
						$mail = new PHPMailer;

						//$mail->SMTPDebug = 3;                               // Enable verbose debug output

						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'wezeevideo@gmail.com';                 // SMTP username
						$mail->Password = 'sisisitotalmente';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to

						$mail->setFrom('support@wezee.es', 'WeZee Support Department');
						$mail->addAddress($userExists["email"]);     // Add a recipient
						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Wezee - Reset password';
						$mail->Body    = $mailbody;

						if(!$mail->send()) {
						    echo 'Message could not be sent.';
						    echo 'Mailer Error: ' . $mail->ErrorInfo;
						} else {
								echo "Your password recovery key has been sent to your e-mail address.";
						}
				}

				else
					echo "No user with that e-mail address exists.";
				}
			break;

			case "reset":
				// Was the form submitted?
				if (isset($_POST["ResetPasswordForm"]))
				{
					// Gather the post data
					$email = $_POST["email"];
					$password = $_POST["password"];
					$confirmpassword = $_POST["confirmpassword"];
					$hash = $_POST["q"];

					// Use the same salt from the forgot_password.php file
					$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

					// Generate the reset key
					$resetkey = hash('sha512', $salt.$email);

					// Does the new reset key match the old one?
					if ($resetkey == $hash)
					{
						if ($password == $confirmpassword)
						{
							//hash and secure the password
							$password = hash('sha512', $password);

							// Update the user's password
								$query = $dbc->query("UPDATE users SET password = '$password' WHERE email = '$email'");
							echo "Your password has been successfully reset.";
						}
						else
							echo "Your password's do not match.";
					}
					else
						echo "Your password reset key is invalid.";
				}
			break;

			case 'videoconfig':
			// Connect to MySQL
				// Check to see if a user exists with this e-mail
				$query = $dbc->query("SELECT id FROM videos WHERE id = ".$_POST["videoid"]);
				$videoExists = $dbc->fetch($query);

				if ($videoExists['id']) {
					$tags = array(preg_split("/[\s,]+/",$_POST['tags']));
					$query = $dbc->query("UPDATE videos SET name = '".$_POST['title']."' where id = '".$_POST['videoid']."'");

					for ($i = 0; $i < count($tags); $i++) {
						$query = $dbc->query("insert into tags values('".$_POST['videoid']."','".$tags[$i]."')");
					}
					header('Location: timelines.php');
				}
			break;

			case 'like':
				// zona horaria
				date_default_timezone_set('Europe/Berlin');
				$date = date('Y-m-d h:i:s', time());
				// insertar el like
				$res = $dbc->query("INSERT INTO likes values (".$_POST['user_id'].",".$_POST['video_id'].",'".$date."')");

				if ($dbc->queryDone()!==false) {
					// actualizar likes del video
					$res = $dbc->query("UPDATE videos set likes = (select likes+1 from videos where id = ".$_POST['video_id'].") where id = ".$_POST['video_id']);
					if($dbc->queryDone()!==false) {
						die (json_encode(array("status" => "OK", "msg" => "Like")));
					} else {
						// si al actualizar los likes falla, borramos el like para no alterar la bd (se puede arreglar con transaction tambien)
						$res = $dbc->query("DELETE FROM likes where video = ".$_POST['video_id']);
					}
				} die (json_encode(array("status" => "ERROR", "msg" => "Error")));
			break;

			default:
				die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
			break;
		}
		$conn = null;
	} else die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
