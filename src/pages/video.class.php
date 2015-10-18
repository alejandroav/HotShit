<?php
class Video{
	var $id;
	var $color;
	var $dbc;
	var $videoinfo;
	var $userinfo;
	function Video($id, $color){
		global $servername, $username, $password, $db;
		$this->id = $id;
		$this->color = $color;
		$this->dbc = new PDOHelper($servername, $username, $password, $db);
		$res = $this->dbc->query("SELECT * FROM videos WHERE id=".$this->id);
		$this->videoinfo = $this->dbc->fetch($res);
		$res = $this->dbc->query("SELECT * FROM users WHERE id=".$this->videoinfo["user"]);
		$this->userinfo = $this->dbc->fetch($res);
	}
	function hashtags(){
		$res = $this->dbc->query("SELECT * FROM tags WHERE video=".$this->id);
		$tags = "";
		if ($this->dbc->numRows($res)){
			$tags .= "<p>";
			while ($row = $this->dbc->fetch($res)){
				$tags .= "<div class='chip chip_tag'><a href='#'> #".$row["tag"]." </a></div>";
			}
			$tags .= "</p>";
		}
		return $tags;
	}
	function showVideo() {
		global $rutaAbsoluta;
		if ($this->userinfo["img"] == NULL) $this->userinfo["img"] = 'nouser.jpg';
		echo '<div class="card green-white lighten-0" style="background-color: rgb(235, 235, '.round($this->color*(255/30)).')">
			<div class="card-content black-text">
				<span class="card-title black-text"><a href="video/'.$this->id.'">'.$this->videoinfo["name"].'</a></span>
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
						<video width="640" height="480" poster="'.$rutaAbsoluta.'uploads/videothumb/'.$this->videoinfo["thumbnail"].'" autobuffer>
							<source src="'.$rutaAbsoluta.'uploads/video/'.$this->videoinfo["file"].'" type="video/mp4">
						</video>
					</div>
					<script>
						var video = $("#'.$this->type.'-'.$this->id.'").hvideo('.$this->id.');
					</script>
					<div class="divider" style="background-color:#CCCC00"></div>
				</p>
				<div>'.
					$this->hashtags($this->id).
				'</div>
				<div style="margin-bottom: 3px;">
					<p style="float:right"><span class="views-'.$this->id.'">'.$this->videoinfo["views"].'</span> <img class="responsive-img ojo_imagen" src="'.$rutaAbsoluta.'resources/css/eye.png" alt="favoritos" width="25"/></p>
				</div>
			</div>
			<div class="divider" style="background-color:#CCCC00"></div>
			<div class="card-action">
				<a href="javascript:followuser('.$_SESSION['userid'].','.$this->videoinfo["user"].');">
					<div class="chip">
						<img src="'.$rutaAbsoluta.'uploads/userimg/'.$this->userinfo["img"].'" alt="#"><span ><span style="text-transform:none">@'.$this->userinfo["username"].'</span>
					</div>
				</a>
				<a href="javascript:like('.$this->id.','.$_SESSION['userid'].');" id="like'.$this->id.'"><span class="Zeeit">ZeeIt</span></a>
			</div>
		</div>';
	}
}
?>
