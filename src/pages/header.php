<header>
	<nav>
		<div class="nav-wrapper" style="background-color:#FFF700">
			<a href="index.php" class="brand-logo" style="color:black;margin-left:15px">
				<div style="color:yellow;padding:10px">
					<img src="resources/images/zlogo2.png" width="50px">
					<img src="resources/images/zlogo.png" width="130px">
				</div>
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
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
