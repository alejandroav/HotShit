<header>
	<nav>
		<div class="nav-wrapper" style="background-color:#FBFF93">
			<a href="index.php" class="brand-logo" style="color:black;margin-left:15px">WeZee</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<div class="chip">
						CONTADOR likes / CONTADOR reproducciones
					</div>
				</li>
				<li>
					<div class="chip">
						<img src="uploads/userimg/<?php echo $_SESSION['userimg'];?>" alt="Contact Person"><?php echo $_SESSION['username']; ?>
					</div>
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
