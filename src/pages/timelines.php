<?php
if (!isset($_SESSION))
	session_start();

if (isset($_POST['valor'])) {
	$contador = $_POST['valor'];
}


function hastags(){
 echo	"<p>";
	for($x = 0; $x <= 9; $x++) {
		echo " <a href='#'> #Tag$x </a> ";
	}
	echo  "</p>";
}


function Video($id){
	global $contador, $k;
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
	$color = $contador;
				for ($x = 0; $x <= 9; $x++) {
						$color++;
						$videoid=3;

						if ($color>31)
							$color = 30;

						echo
							'<div class="card green-white lighten-0" style="background-color: rgb(235, 235, '.round($color*(255/30)).')">
								<div class="card-content black-text">
									<span class="card-title black-text">Titulo tarjeta</span>
									<div class="divider" style="background-color:#CCCC00"></div>
									<p>
										<div id="test-'.$id.$x.'" class="hvideo" style="margin-top:10px;margin-bot:10px">
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
											<video width="640" height="480" poster="uploads/videothumb/poster.jpg" autobuffer>
												<source src="uploads/video/movie.mp4" type="video/mp4">
											</video>
										</div>
										<script>
											var video = $("#test-'.$id.$x.'").hvideo();

										</script>
										<div class="divider" style="background-color:#CCCC00"></div>
									</p>
									<div>';
										hastags();
									echo '</div>
								</div>
								<div class="divider" style="background-color:#CCCC00"></div>
								<div class="card-action">
									<div class="chip">
										<img src="uploads/userimg/'.$_SESSION["userimg"].'" alt="#">'.$_SESSION["username"].'
									</div>
									<a href="#"><img class="responsive-img ojo_imagen" src="resources/css/eye.png" alt="favoritos" width="25"/></a>
									<a href="javascript:like('.$videoid.','.$_SESSION['userid'].');" id="like'.$id.'"><span class="Zeeit">ZeeIt</span></a>
								</div>
							</div>';
					}
					$k++;
					if($k%3==0){
							$contador+=10;
					}

}

?>
<div class="col s4">
		<?php Video("principales");?>
</div>
<div class="col s4">
		<?php Video("users");?>
</div>
<div class="col s4">
	<?php Video("hashtags");?>
</div>
