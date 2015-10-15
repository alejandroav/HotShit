<header>
<!-- #f4ff2b -->
	<nav>
		<div class="nav-wrapper" style="background-color:rgb(26,25,18)">
			<a href="index.php" class="brand-logo" style="color:black;margin-left:15px">
				<img src="resources/images/logofinal.png" width="55px" style="margin-top:5px;">
				
			</a>
			<div class="brand-logo center">
				<img src="resources/images/zlogo2_3.png" width="120px">
				<!--	<img src="resources/images/zlogo.png" width="130px"> -->
			</div>
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
