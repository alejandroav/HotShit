<?php
	session_start();
	include("config.php");
	require("resources/libs/class.phpmailer.php");
	require("resources/libs/class.smtp.php");
	if (isset($_GET["op"]) && $_GET["op"]) {
		switch($_GET["op"]) {

			case "uploadvideo":
				if (!isset($_SESSION['userid'])) die (json_encode(array("status" => "ERROR", "msg" => "No esta logueado")));
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
						else die (json_encode(array("status" => "ERROR", "msg" => "Error al copiar el archivo ".$name.".mp4")));
					} else die (json_encode(array("status" => "ERROR", "msg" => "Error al subir el archivo ".$name.".mp4")));
				} else die (json_encode(array("status" => "ERROR", "msg" => "Debe seleccionar algun archivo")));
			break;

			case 'login':
				// conectar a bd
				$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

				// consultamos si existe un usuario con ese nombre/email y esa contraseña
				$gsent = $conn->prepare("SELECT id,username,img from users where
					(username = '".$_POST['user']."' OR email = '".$_POST['user']."') AND password = '".hash("sha512", $_POST['password'])."'");
				$gsent->execute();
				$result = $gsent->fetch(PDO::FETCH_ASSOC);
				$conn = null;
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
				$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

				// comprobar que no se repite el email ni el usuario

				$query = "SELECT count(id) as c from users where email = '".$_POST['email']."' or username='".$_POST['user']."';";
				$resul = 0;

				foreach($conn->query($query) as $row)
					$resul = $row['c'];

				if ($resul > 0) {
					header("Location: index.php?user=error");
				}

				else {
					// crear el usuario
					$res = $conn-> exec("INSERT INTO users(username,email,password) VALUES ('".
					$_POST['user']."','".
					$_POST['email']."','".
					hash("sha512", $_POST['password'])."');");
					$conn = null;
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

			case 'recover':
				// Connect to MySQL
					$username = "root";
					$password = "";
					$host = "localhost";
					$dbname = "wezee";
				try {
				$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
				}
				catch(PDOException $ex)
					{
							$msg = "Failed to connect to the database";
					}

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
					$query = $conn->prepare('SELECT email FROM users WHERE email = :email');
					$query->bindParam(':email', $email);
					$query->execute();
					$userExists = $query->fetch(PDO::FETCH_ASSOC);
					$conn = null;

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
				// Connect to MySQL
						$username = "root";
						$password = "";
						$host = "localhost";
						$dbname = "wezee";
				try {
				$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
				//$conn = new PDO('mysql:host=localhost;dbname=test', 'root', '');
				}
				catch(PDOException $ex)
						{
								$msg = "Failed to connect to the database";
						}

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
								$query = $conn->prepare('UPDATE users SET password = :password WHERE email = :email');
								$query->bindParam(':password', $password);
								$query->bindParam(':email', $email);
								$query->execute();
								$conn = null;
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
				$username = "root";
				$password = "";
				$host = "localhost";
				$dbname = "wezee";
			try {
			$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
			}
			catch(PDOException $ex)
				{
						$msg = "Failed to connect to the database";
				}

				// Check to see if a user exists with this e-mail
				$query = $conn->prepare('SELECT id FROM videos WHERE id = :id');
				$query->bindParam(':id', $_POST['videoid']);
				$query->execute();
				$videoExists = $query->fetch(PDO::FETCH_ASSOC);

				if ($videoExists['id']) {
					$tags = array(preg_split("/[\s,]+/",$_POST['tags']));
					$query = $conn->prepare('UPDATE videos SET name = :name where id = :id');
					$query->bindParam(':name', $_POST['title']);
					$query->bindParam(':id', $_POST['videoid']);
					$query->execute();

					for ($i = 0; $i < count($tags); $i++) {
						$query = $conn->prepare('insert into tags values(:id,:tag)');
						$query->bindParam(':id', $_POST['videoid']);
						$query->bindParam(':tag', $tags[$i]);
						$query->execute();
					}
					$conn = null;
					header('Location: timelines.php');
				}
			break;

			default:
				die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
			break;
		}
	} else die (json_encode(array("status" => "ERROR", "msg" => "Operacion no permitida")));
