<?php 

	require_once("../admin/include/config.php");
	// FILL DATA
    $select_query = "SELECT website_name, name, designation, profile_pic FROM global_setting, about_me WHERE global_setting.id=1 && about_me.id=1";
    $result = $con -> query($select_query);

    if ($result -> num_rows > 0) {
        $global_setting = $result->fetch_assoc();
    }else {
        $global_setting = array("website_name"=>"", "name"=>"", "designation"=>"");
    }

    //SOCIAL LINKS
    $social_link_query = "SELECT * FROM social_links WHERE id=1";
    $social_link_result = $con -> query($social_link_query);

    if ($social_link_result -> num_rows > 0) {
        $social_link = $social_link_result->fetch_assoc();
    }else {
        $social_link = array("facebook" => "", "instagram" => "", "linkedin"=> "", "twitter"=> "", "google_plus" => "", "youtube" => "", "whatsapp"=> "", "skype"=> "");
    }

 ?>
<div class="mobile-header py-2 px-3 mt-4"> 
	<button class="menu-icon mr-2"> 
		<span></span> 
		<span></span> 
		<span></span> 
	</button> 
	<a href="index.php" class="logo">
		<img src="../admin/<?php echo $global_setting['profile_pic']; ?>" alt="Logo" class="lazyload circle rounded-circle" />
	</a> 
	<a href="index.php" class="site-title dot ml-2"><?php echo $global_setting['name']; ?></a>
</div>
<header class="left float-left shadow-dark" id="header"> 
	<button type="button" class="close" aria-label="Close"> 
		<span aria-hidden="true">&times;</span> 
	</button>
	<div class="header-inner d-flex align-items-start flex-column"> 
		<a href="index.php">
			<img class="lazyload img-fluid rounded-circle" src="../admin/<?php echo $global_setting['profile_pic']; ?>" alt="Logo" />
		</a> 
		<a href="index.php" class="site-title dot mt-3"><?php echo $global_setting['name']; ?></a> 
		<span class="site-slogan"><?php echo $global_setting['designation']; ?></span>

		<nav>
			<ul id="menu-one-page-menu" class="vertical-menu onepage-menu">
				<li id="menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13">
					<a href="index.php#home"><i class="icon-home"></i>Home</a>
				</li>
				<li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14">
					<a href="index.php#about"><i class="icon-user"></i>About</a>
				</li>
				<li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15">
					<a href="index.php#services"><i class="icon-bulb"></i>Services</a>
				</li>
				<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16">
					<a href="index.php#resume"><i class="icon-graduation"></i>Resume</a>
				</li>
				<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17">
					<a href="index.php#works"><i class="icon-grid"></i>Works</a>
				</li>
				<li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18">
					<a href="index.php#blog"><i class="icon-pencil"></i>Blog</a>
				</li>
				<li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19">
					<a href="index.php#contact"><i class="icon-phone"></i>Contact</a>
				</li>
			</ul>
		</nav>

		<div class="footer mt-3">
			<ul class="social-icons list-inline">
				<li class="list-inline-item"> 
					<a href="<?php echo $social_link['facebook']; ?>" target="_blank"> 
						<i class="fab fa-facebook-f"></i> 
					</a>
				</li>
				<li class="list-inline-item"> 
					<a href="<?php echo $social_link['twitter']; ?>" target="_blank"> 
						<i class="fab fa-twitter"></i> 
					</a>
				</li>
				<li class="list-inline-item"> 
					<a href="<?php echo $social_link['instagram']; ?>" target="_blank"> 
						<i class="fab fa-instagram"></i> 
					</a>
				</li>
				<li class="list-inline-item"> 
					<a href="<?php echo $social_link['youtube']; ?>" target="_blank"> 
						<i class="fab fa-youtube"></i> 
					</a>
				</li>
				<li class="list-inline-item"> 
					<a href="<?php echo $social_link['linkedin']; ?>" target="_blank"> 
						<i class="fab fa-linkedin"></i> 
					</a>
				</li>
			</ul> 
			<span class="copyright"> &copy; <script>document.write(new Date().getFullYear());</script> Vikram Kumar </span><br>
			<span class="copyright"> All rights are reserved </span>
		</div>
	</div>
</header>
<!-- End of header section -->