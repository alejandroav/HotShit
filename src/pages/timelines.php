<?php
if (!isset($_SESSION)) session_start();

if (isset($_POST['valor'])) {
	$contador = $_POST['valor'];
} else $contador = 0;

include("video.class.php");
if (!file_exists("resources/libs/class.pdohelper.php")) $extra = "../";
else $extra = ""; 
include($extra."resources/libs/class.pdohelper.php");

function Timeline($type, $contador) {
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
	global $servername, $username, $password, $db;
	$dbc = new PDOHelper($servername, $username, $password, $db);
	$res = $dbc->query("SELECT * FROM video");
	print_r($dbc->fetch($res));
	$k = 0;
	$color = $contador;
	for ($x = 0; $x <= 9; $x++) {
		$color++;
		$videoid=3;
		if ($color>31){
			$color = 30;
		}
		$video = new Video($type, $contador+$k, $color);
		$video->showVideo();
		$k++;
	}
}
?>
<div class="col s4">
	<?php Timeline("principales", $contador);?>
</div>
<div class="col s4">
	<?php Timeline("users", $contador);?>
</div>
<div class="col s4">
	<?php Timeline("hashtags", $contador);?>
</div>
