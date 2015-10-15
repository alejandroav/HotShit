<header>
	<nav>
		<div class="nav-wrapper" style="background-color:rgb(26,25,18)">
			<a href="index.php" class="brand-logo" style="color:black;margin-left:15px">
				<div style="padding:10px">
					<img src="resources/images/zlogo2_1.png" width="50px">
				</div>
			</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="#">
					<div class="chip">
						<img src="uploads/userimg/<?php echo $_SESSION['userimg'];?>" alt="#"><?php echo $_SESSION['username']; ?>
					</div>
					</a>
				</li>
				<li>
					<a href="operaciones.php?op=logout">
						<div class="chip">SALIR</div>
					</a>
				</li>
			</ul>
	   </div>
	</nav>
</header>
