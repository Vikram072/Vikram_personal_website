<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link media="all" href="asset/css/main.css" rel="stylesheet" />
		<title>Vikram Kumar - iOS Developer</title>

		<link rel="stylesheet" href="asset/css/mystyle.css">
		<link rel='stylesheet' id='bako-fonts-css'  href='https://fonts.googleapis.com/css?family=Open+Sans%3A400%2C400i%2C600%2C600i%2C700%2C700i%7CPoppins%3A400%2C400i%2C500%2C500i%2C600%2C600i%2C700%2C700i&ver=1.0.0' type='text/css' media='all' />

		<link rel='stylesheet' id='elementor-global-css'  href='asset/css/single_elementor.css' type='text/css' media='all' />
		<link rel='stylesheet' id='elementor-post-8-css'  href='asset/css/single_helper.css' type='text/css' media='all' />
		<link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CPoppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=5.3.2' type='text/css' media='all' /> 
		
		<script type='text/javascript' src='asset/js/jquery.js'></script> 
		
		<link rel="icon" href="asset/images/favicon.png" sizes="32x32" />
		<link rel="icon" href="asset/images/favicon.png" sizes="192x192" />
		<link rel="apple-touch-icon-precomposed" href="asset/images/favicon.png" />
		<meta name="msapplication-TileImage" content="asset/images/favicon.png" />
	</head>
<body class="home page-template page-template-page-onepage page-template-page-onepage-php page page-id-8 elementor-default elementor-page elementor-page-8">

<?php 
	require_once("../admin/include/config.php");
	// FILL DATA
    $select_query = "SELECT website_name, name, designation FROM global_setting WHERE id=1";
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

    //INTRO
    $intro_query = "SELECT heading, description, bg_image FROM intro WHERE id=1";
    $intro_result = $con -> query($intro_query);

    if ($intro_result -> num_rows > 0) {
        $intro = $intro_result->fetch_assoc();
    }else {
        $intro = array("page_heading"=>"", "description"=>"", "bg_image"=>"");
    }

    //ABOUT ME
    $about_query = "SELECT * FROM about_me WHERE id=1";
    $about_result = $con -> query($about_query);

    if ($about_result -> num_rows > 0) {
        $about = $about_result->fetch_assoc();
    }else {
        $about = array("fullname"=>"", "email"=>"", "mobile"=>"", "address"=>"", "dob"=>"", "resume"=>"", "profile_pic"=>"", "intro"=>"");
    }

    //MY SKILL
    $skill_query = "SELECT * FROM skills";
    $skills_result = $con -> query($skill_query);

    if ($skills_result -> num_rows > 0) {
        $skill = $skills_result->fetch_assoc();
    }else {
        $skill = array("title"=>"", "percentage"=>"");
    }

    $my_skill_intro_res = $con -> query("SELECT description FROM matter WHERE id=1");
    if ($my_skill_intro_res -> num_rows > 0) {
    	$my_skill_intro = $my_skill_intro_res -> fetch_assoc();
    }else {
    	$my_skill_intro = array('designation' => "");
    }

?>


		<!-- PRELOADER -->
		<div id="preloader" style="display: none;">
			<div class="outer">
				<div class="spinner">
					<div class="dot1"></div>
					<div class="dot2"></div>
				</div>
			</div>
		</div>
		<!-- END OF PRELOADER -->

		<!-- SITE WRAPPER -->
		<div class="site-wrapper">
			<div class="mobile-header py-2 px-3 mt-4"> 
				<button class="menu-icon mr-2"> 
					<span></span> 
					<span></span> 
					<span></span> 
				</button> 
				<a href="index.html" class="logo">
					<img src="../admin/<?php echo $about['profile_pic']; ?>" alt="Logo" class="lazyload circle rounded-circle" />
				</a> 
				<a href="index.html" class="site-title dot ml-2"><?php echo $global_setting['name']; ?></a>
			</div>
			<header class="left float-left shadow-dark" id="header"> 
				<button type="button" class="close" aria-label="Close"> 
					<span aria-hidden="true">&times;</span> 
				</button>
				<div class="header-inner d-flex align-items-start flex-column"> 
					<a href="index.html">
						<img class="lazyload img-fluid rounded-circle" src="../admin/<?php echo $about['profile_pic']; ?>" alt="Logo" />
					</a> 
					<a href="index.html" class="site-title dot mt-3"><?php echo $global_setting['name']; ?></a> 
					<span class="site-slogan"><?php echo $global_setting['designation']; ?></span>

					<nav>
						<ul id="menu-one-page-menu" class="vertical-menu onepage-menu">
							<li id="menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-13">
								<a href="#home"><i class="icon-home"></i>Home</a>
							</li>
							<li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14">
								<a href="#about"><i class="icon-user"></i>About</a>
							</li>
							<li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-15">
								<a href="#services"><i class="icon-bulb"></i>Services</a>
							</li>
							<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16">
								<a href="#resume"><i class="icon-graduation"></i>Resume</a>
							</li>
							<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17">
								<a href="#works"><i class="icon-grid"></i>Works</a>
							</li>
							<li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18">
								<a href="#blog"><i class="icon-pencil"></i>Blog</a>
							</li>
							<li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19">
								<a href="#contact"><i class="icon-phone"></i>Contact</a>
							</li>
						</ul>
					</nav>

					<div class="footer mt-auto">
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

			<!-- Main Section -->
	<main class="content float-right">
		<div data-elementor-type="wp-post" data-elementor-id="8" class="elementor elementor-8" data-elementor-settings="[]">
			<div class="elementor-inner">
				<div class="elementor-section-wrap">
					
					<section class="elementor-element elementor-element-5db37a3 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="5db37a3" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
							<div class="elementor-row">
								<div class="elementor-element elementor-element-beac6dc elementor-column elementor-col-100 elementor-top-column" data-id="beac6dc" data-element_type="column">
									<div class="elementor-column-wrap  elementor-element-populated">
										<div class="elementor-widget-wrap">




<section class="elementor-element elementor-element-5c34dc1 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="5c34dc1" data-element_type="section">
	<div class="elementor-container elementor-column-gap-no">
		<div class="elementor-row row">

			<div class="elementor-column col-md-6 elementor-col-50">
				<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-d20b90f elementor-widget elementor-widget-bako-skill" data-id="d20b90f" data-element_type="widget" data-widget_type="bako-skill.default">
							<div class="elementor-widget-container">
								<div class="skill-item">
									<div class="skill-info clearfix">
										<h4 class="float-left mb-3 mt-0">WordPress</h4> 
										<span class="float-right">85%</span>
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="85">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="elementor-column col-md-6 elementor-col-50">
				<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-d20b90f elementor-widget elementor-widget-bako-skill" data-id="d20b90f" data-element_type="widget" data-widget_type="bako-skill.default">
							<div class="elementor-widget-container">
								<div class="skill-item">
									<div class="skill-info clearfix">
										<h4 class="float-left mb-3 mt-0">WordPress</h4> 
										<span class="float-right">85%</span>
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="85">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="elementor-element elementor-element-686750c elementor-widget elementor-widget-spacer" data-id="686750c" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>
			<div class="elementor-column col-md-6 elementor-col-50">
				<div class="elementor-column-wrap  elementor-element-populated">
					<div class="elementor-widget-wrap">
						<div class="elementor-element elementor-element-d20b90f elementor-widget elementor-widget-bako-skill" data-id="d20b90f" data-element_type="widget" data-widget_type="bako-skill.default">
							<div class="elementor-widget-container">
								<div class="skill-item">
									<div class="skill-info clearfix">
										<h4 class="float-left mb-3 mt-0">WordPress</h4> 
										<span class="float-right">85%</span>
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="85">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>




		</div>
	</div>
</section>









										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

				</div>
			</div>
		</div>
	</main>
</div> 

		<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a> 
		<noscript>
			<style>.lazyload{display:none;}</style>
		</noscript>
		<script data-noptimize="1">
			window.lazySizesConfig=window.lazySizesConfig||{};
			window.lazySizesConfig.loadMode=1;
		</script>
		<script async data-noptimize="1" src='asset/js/lazysizes.min.js?ao_version=2.6.1'></script>
		<script type='text/javascript'>
			var wpcf7 = {
				"apiSettings":{
					"root":"https:\/\/pxltheme.com\/wp\/bako\/wp-json\/contact-form-7\/v1",
					"namespace":"contact-form-7\/v1"
				}
			};
		</script>
		<script type='text/javascript'>
			var elementorFrontendConfig = {
				"environmentMode":{
					"edit":false,
					"wpPreview":false
				},
				"is_rtl":false,
				"breakpoints":{
					"xs":0,
					"sm":480,
					"md":768,
					"lg":1025,
					"xl":1440,
					"xxl":1600
				},
				"version":"2.8.5",
				"settings":{
					"page":[],
					"general":{
						"elementor_global_image_lightbox":"yes"
					},
					"editorPreferences":[]
				},
				"post":{
					"id":8,
					"title":"Home Page",
					"excerpt":""
				}
			};
		</script>

		<script>
			function calcExperince() {
				var df = new Date("06/18/2019");
				var dt = new Date();
				var startMonth = df.getFullYear() * 12 + df.getMonth();
				var endMonth = dt.getFullYear() * 12 + dt.getMonth();
				var monthInterval = (endMonth - startMonth);

				var yearsOfExperience = Math.floor(monthInterval/12);
				var monthsOfExperience = monthInterval%12;

				var experience = "";
				if (yearsOfExperience > 1) {
					experience += yearsOfExperience + " years "
				}else if (yearsOfExperience > 0) {
					experience += yearsOfExperience + " year "
				}

				experience += monthsOfExperience + " months";

				document.getElementById("experience").innerHTML = experience;
			}
			calcExperince();
		</script> 

		<script src="asset/js/main.js"></script>
</body>
</html>