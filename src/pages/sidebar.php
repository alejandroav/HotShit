<sidebar>
	<?php
		global $dbc;
		$dbc = new PDOHelper($servername, $username, $password, $db);
		function suscriptores(){
			global $dbc, $rutaAbsoluta;
			$query = $dbc->query("SELECT followed FROM follows where follower = ".$_SESSION['userid']);
			while ($result = $dbc->fetch($query)){
				$res = $dbc->query("SELECT id, username, img FROM users WHERE id=".$result["followed"]);
				$info = $dbc->fetch($res);
				if ($info["img"] == NULL) $info["img"] = 'nouser.jpg';
				echo "<div style='padding:2px'>
					<img class='circle' src='".$rutaAbsoluta."uploads/userimg/".$info["img"]."' width='30'/>@".$info["username"]."
					</div>";
			}
		}

		function tags(){
			global $dbc, $rutaAbsoluta;
			$query = $dbc->query("SELECT tag FROM followtags where follower = ".$_SESSION['userid']. " ORDER BY tag asc");
			while ($result = $dbc->fetch($query)){
				echo "<div>
				<p>".$result["tag"]."</p>
				</div>";
			}
		}
	?>
	<div style="background-color:rgb(26,25,18)">
		<div>
			<p style="font-size:120%;margin-bottom:-1px;text-align:center;"><b> <?php echo $_SESSION['username'];?></b></p>
		</div>
		<div class="profile_pic">
			<img src="<?php echo $rutaAbsoluta; ?>uploads/userimg/<?php echo $_SESSION['userimg']; ?>" alt="Usuario" height="150px">
		</div>
		<div class="barra_lateral" style="background-color:rgb(26,25,18)">
			<div>
				<p style="font-size:120%;margin-bottom:-1px;"><b>Suscripciones</b></p>
			</div>
			<div class="divider">
			</div>
			<div class="align-center" style="padding:5px">
				<?php suscriptores() ?>
			</div>
		</div>

		<div class="barra_lateral" style="background-color:rgb(26,25,18)">
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
	<script type="text/javascript">
	var container = document.getElementById('container');
	</script>
</sidebar>
