<script type="text/javascript">
	function like(videoid,userid) {
		Materialize.toast('YLELELELE video!', 3000);
			$.ajax({
			method: "POST",
			url: "operaciones.php?op=like",
			data: {video_id:videoid,user_id:userid},
			success: function(response) {
				// colorear el enlace de like
				if (IsJsonString(response)){
					response = $.parseJSON(response);
					if (response.status == "OK") {
						$('#like'+videoid).css('font-weight', 'bold');
							Materialize.toast('You liked this video!', 3000);
					} else {
						Materialize.toast('Error: video could not be liked', 3000);
					}
				}
			}
		});
	}
</script>
<?php
if (!isset($_SESSION)) session_start();
function Video($id){
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
				for ($x = 0; $x <= 9; $x++) {
						echo
							'<div class="card green-white lighten-0" style="background-color: rgb(255, 255, '.round($x*(255/9)).')">
								<div class="card-content black-text">
									<span class="card-title black-text">Titulo tarjeta</span>
									<p>
										<div id="test-'.$id.$x.'" class="hvideo">
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
											<video width="330" height="205" poster="uploads/videothumb/poster.jpg" autobuffer>
												<source src="uploads/video/movie.mp4" type="video/mp4">
											</video>
										</div>
										<script>
											var video = $("#test-'.$id.$x.'").hvideo();

										</script>
									</p>
								</div>
								<div class="card-action">
									<div class="chip">
										<img src="uploads/userimg/'.$_SESSION["userimg"].'" alt="#">'.$_SESSION["username"].'
									</div>
									<a href="#"><img class="responsive-img" src="resources/images/wink.png" alt="favoritos" width="25"/></a>
									<a onclick="jsfunction()" href="javascript:like('.$id.','.$_SESSION['userid'].');" id="like'.$id.'">ZeeIt</a>
								</div>
							</div>';
					}
}
?>
<ul>
	<div>
		<div class="col s4">
			<h2>Main</h2>
			<div class="search-wrapper" style="background-color:transparent">
				<input id="search">
				<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20"/></a>
				<div class="search-results"></div>
			</div>
		<?php Video("principales");?>
	</div>
	<div>
		<div class="col s4">
			<h2>Users</h2>
			<div class="search-wrapper" style="background-color:transparent">
				<input id="search">
				<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20"/></a>
				<div class="search-results"></div>
			</div>
		<?php Video("users");?>
	</div>
	<div>
		<div class="col s4">
			<h2>Tags</h2>
			<div class="search-wrapper" style="background-color:transparent">
				<input id="search">
				<a href="#"> <img src="resources/images/busqueda.png" alt="lupa" width="20"/></a>
				<div class="search-results"></div>
			</div>
		<?php Video("hashtags");?>
	</div>
</ul>
