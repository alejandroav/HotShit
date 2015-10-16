<?php
class Video{
	var $id;
	var $type;
	var $color;
	var $dbc;
	function Video($type, $id, $color){
		global $servername, $username, $password, $db;
		$this->id = $id;
		$this->type = $type;
		$this->color = $color;
		$this->dbc = new PDOHelper($servername, $username, $password, $db);
		$res = $this->dbc->query("SELECT * FROM video WHERE id=".$this->id);
		print_r($this->dbc->fetch($res));
	}
	function hashtags(){
		//$res = $dbc->query("SELECT FROM tags WHERE video=".$this->id);
		$tags = "<p>";
		for($x = 0; $x <= 9; $x++) {
			$tags .= "<div class='chip chip_tag'><a href='#'> #Tag$x </a></div>";
		}
		$tags .= "</p>";
		return $tags;
	}
	function showVideo() {
		echo '<div class="card green-white lighten-0" style="background-color: rgb(235, 235, '.round($this->color*(255/30)).')">
			<div class="card-content black-text">
				<span class="card-title black-text">Titulo tarjeta</span>
				<div class="divider" style="background-color:#CCCC00"></div>
				<p>
					<div id="'.$this->type.'-'.$this->id.'" class="hvideo" style="margin-top:10px;margin-bot:10px">
						<controls>
							<button class="play" title="Toggle playback"></button>
							<button class="play-pause paused" title="Toggle playback"></button>
							<extended>
								<bar class="position" title="Current position">
									<p class="meta">0:00</p>
								</bar>
								<bar class="total">
									<p class="meta" title="Total length">0:00</p>
								</bar>
								<bar class="buffered"></bar>
								<bar class="unbuffered"></bar>
								<button class="zoom" title="Zoom in/out"></button>
							</extended>
						</controls>
						<video width="640" height="480" poster="uploads/videothumb/poster.png" autobuffer>
							<source src="uploads/video/movie.mp4" type="video/mp4">
						</video>
					</div>
					<script>
						var video = $("#'.$this->type.'-'.$this->id.'").hvideo();
					</script>
					<div class="divider" style="background-color:#CCCC00"></div>
				</p>
				<div>'.
					$this->hashtags($this->id).
				'</div>
				<div>
					<p style="float:right">1000 <img class="responsive-img ojo_imagen" src="resources/css/eye.png" alt="favoritos" width="25"/></p>
				</div>
			</div>
			<div class="divider" style="background-color:#CCCC00"></div>
			<div class="card-action">
				<a href="">
					<div class="chip">
						<img src="uploads/userimg/'.$_SESSION["userimg"].'" alt="#"><span ><span style="text-transform:none">'.$_SESSION["username"].'</span>
					</div>
				</a>
				<a href="javascript:like('.$this->id.','.$_SESSION['userid'].');" id="like'.$this->id.'"><span class="Zeeit">ZeeIt</span></a>
			</div>
		</div>';
	}
}
?>