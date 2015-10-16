<?php
if (!isset($_SESSION)) session_start();

if (isset($_POST['valor'])) {
	$contador = $_POST['valor'];
} else $contador = 0;

include("video.class.php");
if (!file_exists("resources/libs/class.pdohelper.php")) $extra = "../";
else $extra = ""; 
include($extra."resources/libs/class.pdohelper.php");
include($extra."config.php");

function Timeline($type, $contador) {
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
	global $servername, $username, $password, $db;
	$dbc = new PDOHelper($servername, $username, $password, $db);
	$res = $dbc->query("SELECT id FROM videos ORDER BY date DESC LIMIT ".$contador.", 10");
	$color = $contador;
	while ($row = $dbc->fetch($res)){
		$color++;
		$videoid=3;
		if ($color>31){
			$color = 30;
		}
		$video = new Video($type, $row["id"], $color);
		$video->showVideo();
		//echo "<script>console.log('".$row["id"]."');</script>";
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
