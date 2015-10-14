<?php
if (!isset($_SESSION)) session_start();
function Video(){
	// imprimimos tarjetas con cada video.
	// hay que pasar por parametro si queremos videos populares o tags populares
	echo "<ul>";
	echo "<div>
			<div class='col s4'>
			<h2>Titulo columna</h2>
			<div class='search-wrapper' style='background-color:transparent;'>
				<input id='search'>
				<a href='#'> <img src='resources/images/busqueda.png' alt='lupa' width='20'/></a>
				<div class='search-results'></div>
			</div>";
				for ($x = 0; $x <= 9; $x++) {
						echo 
							'<div class="card green-white lighten-0" style="background-color: rgb(255, 255, '.round($x*(255/9)).')">
								<div class="card-content black-text">
									<span class="card-title black-text">Titulo tarjeta</span>
									<p>Descripcion</p>
								</div>
								<div class="card-action">
									<div class="chip">
										<img src="uploads/userimg/'.$_SESSION["userimg"].'" alt="#">'.$_SESSION["username"].'
									</div>
									<a href="#"><img class="responsive-img" src="resources/images/wink.png" alt="favoritos" width="25"/></a>
									<a href="#">ZeeIt</a>
								</div>
							</div>';
					}
	echo "</div></div></ul>";
}
?>
<?php Video();?>
<?php Video();?>
<?php Video();?>