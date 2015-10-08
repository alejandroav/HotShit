
<header>
	<nav>
		<div class="nav-wrapper" style="background-color:#FBFF93">
			<a href="#" class="brand-logo" style="color:black;margin-left:15px">WeZee</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<div class="chip">
						<img src="uploads/userimg/<?php echo $_SESSION['userimg'];?>" alt="Contact Person"><?php echo $_SESSION['username']; ?>
					</div>
				</li>
				<li>
					<a href="operaciones.php?op=logout">SALIR</a>
				</li>
			</ul>
	   </div>
	</nav>
</header>
