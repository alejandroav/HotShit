<header>
<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper" style="background-color:rgb(26,25,18)">
			 <ul id="slide-out" class="side-nav" style="background-color:rgb(26,25,18)">
				 <?php include("pages/sidebar.php");?>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
			<script> $(".button-collapse").sideNav();</script>
			<a href="#" class="brand-logo" style="color:black;margin-left:15px">
			<ul class="left">
				<!--<li>
					<a href><i class="material-icons">settings</i></a>
				</li>-->
				<li>
				<a href="javascript:createPopup('<?php echo $rutaAbsoluta; ?>pages/profile.php');">
					<div class="chip chip_yellow">
						<img src="<?php echo $rutaAbsoluta; ?>uploads/userimg/<?php echo $_SESSION['userimg'];?>" alt="#"><?php echo $_SESSION['username']; ?>
					</div>
				</a>
				</li>

			</ul>
			</a>
			<div class="brand-logo center">
			<a href="<?php echo $rutaAbsoluta; ?>timelines">
				<div class="isotipo">
					<img src="<?php echo $rutaAbsoluta; ?>resources/images/zlogo2_3.png" width="120px" style="margin-top:-7px;">
					<!--	<img src="resources/images/zlogo.png" width="130px"> -->
				</div>
			</a>
			</div>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<a href="<?php echo $rutaAbsoluta; ?>operaciones.php?op=logout">
						<div class="chip chip_yellow">SALIR</div>
					</a>
				</li>
			</ul>
	   </div>
	</nav>
</div>
</header>
