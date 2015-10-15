<header>
<div class="navbar-fixed">
	<nav>

		<div class="nav-wrapper" style="background-color:rgb(26,25,18)">
			 <ul id="slide-out" class="side-nav">
				<li><?php include("pages/sidebar.php");?></li>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
			<script> $(".button-collapse").sideNav();</script>
			<a href="index.php" class="brand-logo" style="color:black;margin-left:15px">
				<div style="margin-top:-6px">
					<div class="chip chip_yellow">
						<img src="uploads/userimg/<?php echo $_SESSION['userimg'];?>" alt="#"><?php echo $_SESSION['username']; ?>
					</div>
			</div>
			</a>
			<div class="brand-logo center">
				<div class="isotipo">
					<img src="resources/images/zlogo2_3.png" width="120px" style="margin-top:-7px;">
					<!--	<img src="resources/images/zlogo.png" width="130px"> -->
				</div>
			</div>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<a href="operaciones.php?op=logout">
						<div class="chip chip_yellow">SALIR</div>
					</a>
				</li>
			</ul>
	   </div>
	</nav>
</div>
</header>
