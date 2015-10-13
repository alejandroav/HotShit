<sidebar>

	<?php
		function suscriptores(){
			for ($x = 0; $x <= 9; $x++) {
				echo "<div style='padding:5px'>
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
	<div class="z-depth-2" style="padding:20px;border:1px solid light-grey;margin:10px;">
		<div style="border:1px solid black">
			<img src="uploads/userimg/<?php echo $_SESSION['userimg']; ?>" alt="Usuario" height="150"/>
		</div>
		<div style="padding:10px"></div>
		<div style="background-color:#F9FE6F;padding:10px">
			<div>
				<p style="font-size:120%"><b>Suscripciones</b></p>	
			</div>
			<div class="divider">
			</div>
			<div class="align-center" style="padding:5px">
				<?php suscriptores() ?>
			</div>
		</div>
		
		<div style="padding:10px"></div>
		
		<div style="background-color:#F9FE6F;padding:10px">
			<div>
				<p style="font-size:120%"><b>Tags</b></p>	
			</div>
			<div class="divider">
			</div>
			<div class="align-center">
				<?php tags() ?>
			</div>
		</div>
	</div>
</sidebar>