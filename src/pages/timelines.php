<?php
if (!isset($_SESSION)) session_start();

if (isset($_GET['c'])) {
	$contador = $_GET['c'];
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
	//if ($type == "general") {
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
	}
}
if (isset($_GET['tipo'])) {
	Timeline($_GET['tipo'], $contador);
} else {
?>
	<div class="col s4" id="col-general">
		<?php Timeline("general", $contador);?>
	</div>
	<div class="col s4" id="col-usuarios">
		<?php Timeline("users", $contador);?>
	</div>
	<div class="col s4" id="col-tags">
		<?php Timeline("tags", $contador);?>
	</div>
<?php } ?>