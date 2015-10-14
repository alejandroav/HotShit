<sidebar>

	<?php
		function suscriptores(){
			for ($x = 0; $x <= 9; $x++) {
				echo "<div style='padding:2px'>
					<img class='circle' src='uploads/userimg/1.bmp' alt='emoji' width='15'>
					Usuario $x </img>
					</div>";
			}
		}

		function tags(){
			for($x = 0; $x <= 9; $x++) {
				echo "<div>
				<p> Tag $x </p>
				</div>";
			}
		}
	?>
	<div class="z-depth-2" style="padding:5px;border:1px solid light-grey;margin:10px;border-radius:10px;">
		<div>
			<p style="font-size:120%;margin-bottom:-1px;"><b>Perfil de <?php echo $_SESSION['username'];?></b></p>
		</div>
		<div class="profile_pic">
			<img src="uploads/userimg/<?php echo $_SESSION['userimg']; ?>" alt="Usuario" height="150px">
		</div>
		<div class="barra_lateral">
			<div>
				<p style="font-size:120%;margin-bottom:-1px;"><b>Suscripciones</b></p>
			</div>
			<div class="divider">
			</div>
			<div class="align-center" style="padding:5px">
				<?php suscriptores() ?>
			</div>
		</div>

		<div class="barra_lateral">
			<div>
				<p style="font-size:120%;margin-bottom:-1px;"><b>Tags</b></p>
			</div>
			<div class="divider">
			</div>
			<div class="align-center">
				<?php tags() ?>
			</div>
		</div>
	</div>
</sidebar>
