<?php
if (!isset($_SESSION)) session_start();
if (isset($_GET['tipo'])) {
	include("../resources/libs/class.pdohelper.php");
	include("../config.php");
}
if (isset($_GET['c'])) {
	$contador = $_GET['c'];
} else $contador = 0;

include("video.class.php");

function Timeline($type, $contador) {
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
	global $servername, $username, $password, $db;
	$dbc = new PDOHelper($servername, $username, $password, $db);
	if (!isset($_GET['extra'])) {
		if ($type == "general") {
			$res = $dbc->query("SELECT id FROM videos ORDER BY trendlevel DESC LIMIT ".$contador.", 10");
		} else if ($type == "users") {
			$res = $dbc->query("SELECT id FROM videos where user in (select followed from follows where follower = ".$_SESSION['userid'].") ORDER BY date DESC LIMIT ".$contador.", 10");
		} else if ($type == "tags") {
			$res = $dbc->query("SELECT id FROM videos where id in (select video from tags where tag in (select tag from followtags where follower = ".$_SESSION['userid'].")) ORDER BY date DESC LIMIT ".$contador.", 10");
		}
	} else {
		if ($type == "users") {
			$res = $dbc->query("SELECT id FROM videos where user = ".$_GET['extra']." ORDER BY date DESC LIMIT ".$contador.", 10");
		} else if ($type == "tags") {
			$res = $dbc->query("SELECT id FROM videos where id in (select video from tags where tag = '".$_GET['extra']."') ORDER BY date DESC LIMIT ".$contador.", 10");
		}
	}

	$color = $contador;
	while ($row = $dbc->fetch($res)){
		$color++;
		$videoid=3;
		if ($color>31){
			$color = 30;
		}
		$video = new Video($type,$row["id"], $color);
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
	<div class="col s4" id="col-users">
		<?php Timeline("users", $contador);?>
	</div>
	<div class="col s4" id="col-tags">
		<?php Timeline("tags", $contador);?>
	</div>
<? } ?>
