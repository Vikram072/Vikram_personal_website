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
		
    	<!-- notifications css -->
		<link rel="stylesheet" href="../admin/assets/plugins/notifications/css/lobibox.min.css"/>
		<!--notification js -->
		<script src="../admin/assets/js/jquery.min.js"></script>
		<script src="../admin/assets/plugins/notifications/js/lobibox.min.js"></script>
		<script src="../admin/assets/plugins/notifications/js/notifications.min.js"></script>

		<script>
			function showAlert(message, position="top right", isSuccess=false){
        		var alertType = "warning";
		        var alertIcon = "fa fa-exclamation-circle";
		        if (isSuccess == true) {
		            alertType = "success";
		            alertIcon = "fa fa-check-circle";
		        }
		        Lobibox.notify(alertType, {
		            pauseDelayOnHover: true,
		            size: 'mini',
		            rounded: false,
		            icon: alertIcon,
		            continueDelayOnInactiveTab: false,
		            position: position,
		            msg: message
		        });
		    } 
		</script>
	</head>
<body class="home page-template page-template-page-onepage page-template-page-onepage-php page page-id-8 elementor-default elementor-page elementor-page-8">
<?php 

	if (isset($_GET['error'])) {
		echo "<script>showAlert('Something went wrong. Please try again')</script>";
	}

	if (isset($_GET['success'])) {
		echo "<script>showAlert('Thank you for contacting me.', 'top right', true)</script>";
	}


 ?>

<?php 
	require_once("../admin/include/config.php");

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

    $my_skill_intro_res = $con -> query("SELECT description FROM matter WHERE id=1");
    if ($my_skill_intro_res -> num_rows > 0) {
    	$my_skill_intro = $my_skill_intro_res -> fetch_assoc();
    }else {
    	$my_skill_intro = array('designation' => "");
    }

    //SERVICES
    $services_query = "SELECT * FROM services";
    $services_result = $con -> query($services_query);

    //EXPERIENCE
    $exp_query = "SELECT * FROM experiences";
    $exp_result = $con -> query($exp_query);

    //TESTIMONIALS
    $testimonial_query = "SELECT * FROM testimonials";
    $testimonial_result = $con -> query($testimonial_query);

    //CLIENTS
    $client_query = "SELECT * FROM clients";
    $client_result = $con -> query($client_query);

    //PORTFOLIO
    $portfolio_query = "SELECT * FROM portfolio";
    $portfolio_result = $con -> query($portfolio_query);

    //PORTFOLIO CATEGORY
    $portfolio_cat_query = "SELECT DISTINCT category FROM portfolio";
    $portfolio_cat_result = $con -> query($portfolio_cat_query);

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
			<?php require_once("include/sidemenu.php"); ?>

			<!-- Main Section -->
			<main class="content float-right">
				<div data-elementor-type="wp-post" data-elementor-id="8" class="elementor elementor-8" data-elementor-settings="[]">
					<div class="elementor-inner">
						<div class="elementor-section-wrap">
							<section style="background-image: url('../admin/<?php echo $intro['bg_image']; ?>');" class="elementor-element elementor-element-bf95336 elementor-section-height-min-height shadow-dark elementor-section-boxed elementor-section-height-default elementor-section-items-middle elementor-section elementor-top-section" data-id="bf95336" data-element_type="section" id="home">
								<div class="elementor-background-overlay"></div>
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-f2438ee elementor-column elementor-col-100 elementor-top-column" data-id="f2438ee" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-3f69f3f elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="3f69f3f" data-element_type="widget" data-widget_type="heading.default">
														<div class="elementor-widget-container">
															<h1 class="elementor-heading-title elementor-size-default"><?php echo $intro['heading']; ?><span class="dot"></span></h1>
														</div>
													</div>
													<div class="elementor-element elementor-element-c15fb9f elementor-widget elementor-widget-text-editor" data-id="c15fb9f" data-element_type="widget" data-widget_type="text-editor.default">
														<div class="elementor-widget-container">
															<div class="elementor-text-editor elementor-clearfix">
																<p><?php echo $intro['description']; ?></p>
															</div>
														</div>
													</div>
													<div class="elementor-element elementor-element-62c7ffb elementor-widget__width-auto elementor-widget elementor-widget-bako-button" data-id="62c7ffb" data-element_type="widget" data-widget_type="bako-button.default">
														<div class="elementor-widget-container"> 
															<a href="#works" class="btn btn-default btn-lg"> <i class="icon-grid"></i> View Portfolio </a>
														</div>
													</div>
													<div class="elementor-element elementor-element-113d6f7 elementor-widget__width-auto elementor-widget elementor-widget-bako-button" data-id="113d6f7" data-element_type="widget" data-widget_type="bako-button.default">
														<div class="elementor-widget-container"> 
															<a href="#contact" class="btn btn-border-light btn-lg"> <i class="icon-envelope"></i> Hire Me </a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="elementor-element elementor-element-6d67668 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="6d67668" data-element_type="section" id="about" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-ede915b elementor-column elementor-col-100 elementor-top-column" data-id="ede915b" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-fd830f6 elementor-widget elementor-widget-bako-section-title" data-id="fd830f6" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">About Me</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-a93180a elementor-widget elementor-widget-spacer" data-id="a93180a" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner">
																</div>
															</div>
														</div>
													</div>

													<section class="elementor-element elementor-element-28fff55 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="28fff55" data-element_type="section">
														<div class="elementor-container elementor-column-gap-default">
															<div class="elementor-row">
																<div class="elementor-element elementor-element-d65c8d2 elementor-column elementor-col-33 elementor-inner-column" data-id="d65c8d2" data-element_type="column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-element-d5bd739 elementor-widget elementor-widget-image" data-id="d5bd739" data-element_type="widget" data-widget_type="image.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-image"> 
																						<noscript>
																							<img width="150" height="150" src="../admin/<?php echo $about['profile_pic']; ?>" class="attachment-large size-large rounded-circle" alt="" />
																						</noscript>
																						
																						<img width="150" height="150" src="../admin/<?php echo $about['profile_pic']; ?>" class="lazyload attachment-large size-large rounded-circle" alt="" />
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="elementor-element elementor-element-cad0286 elementor-column elementor-col-66 elementor-inner-column" data-id="cad0286" data-element_type="column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-element-9c6553d elementor-widget elementor-widget-heading" data-id="9c6553d" data-element_type="widget" data-widget_type="heading.default">
																				<div class="elementor-widget-container">
																					<h2 class="elementor-heading-title elementor-size-default">Hello,</h2>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-3737e0f elementor-widget elementor-widget-spacer" data-id="3737e0f" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-9d2dba6 elementor-widget elementor-widget-text-editor" data-id="9d2dba6" data-element_type="widget" data-widget_type="text-editor.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-text-editor elementor-clearfix">
																						<p><?php echo $about['intro']; ?></p>
																					</div>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-042711a elementor-widget elementor-widget-spacer" data-id="042711a" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-7688d38 elementor-widget elementor-widget-html" data-id="7688d38" data-element_type="widget" data-widget_type="html.default">
																				<div class="elementor-widget-container">
																					<div class="row">
																						<div class="col-md-6">
																							<p class="mb-2">Name: <span class="text-dark"><?php echo $about['fullname']; ?></span></p>
																							<p class="mb-0">Birthday: <span class="text-dark"><?php echo date_format(date_create($about['dob']),"d F, Y"); ?></span></p>
																						</div>

																						<div class="col-md-6 mt-2 mt-md-0 mt-sm-2">
																							<p class="mb-2">Location: <span class="text-dark"><?php echo $about['address']; ?></span></p>
																							<p class="mb-0">Email: <span class="text-dark"><?php echo $about['email']; ?></span></p>
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-e2cbf88 elementor-widget elementor-widget-spacer" data-id="e2cbf88" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-7c95bda elementor-widget__width-auto elementor-widget elementor-widget-bako-button" data-id="7c95bda" data-element_type="widget" data-widget_type="bako-button.default">
																				<div class="elementor-widget-container"> 
																					<a href="../admin/<?php echo $about['resume']; ?>" target="_blank" class="btn btn-default "> <i class="icon-cloud-download"></i> Download CV </a>
																				</div>
																			</div>

																			<div class="elementor-element elementor-element-b436955 elementor-widget__width-auto elementor-widget elementor-widget-bako-button" data-id="b436955" data-element_type="widget" data-widget_type="bako-button.default">
																				<div class="elementor-widget-container"> 
																					<a href="#" class="btn btn-alt "> <i class="icon-envelope"></i> Hire Me </a>
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

							<section class="elementor-element elementor-element-5db37a3 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="5db37a3" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-beac6dc elementor-column elementor-col-100 elementor-top-column" data-id="beac6dc" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-b29a76a elementor-widget elementor-widget-bako-section-title" data-id="b29a76a" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">My skills</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-686750c elementor-widget elementor-widget-spacer" data-id="686750c" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-3695189 elementor-widget elementor-widget-text-editor" data-id="3695189" data-element_type="widget" data-widget_type="text-editor.default">
														<div class="elementor-widget-container">
															<div class="elementor-text-editor elementor-clearfix">
																<p><?php echo $my_skill_intro['description']; ?></p>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-55337b5 elementor-widget elementor-widget-spacer" data-id="55337b5" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<section class="elementor-element elementor-element-5c34dc1 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="5c34dc1" data-element_type="section">
														<div class="elementor-container elementor-column-gap-no">
															<div class="elementor-row row">
															<?php 
					                                            if ($skills_result -> num_rows > 0) {
					                                                $sr = 1;
					                                                while ($skill = $skills_result->fetch_assoc()) {
					                                        ?>
																<div class="col-md-6 mb-5 elementor-element elementor-column elementor-col-50 elementor-inner-column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-element-d20b90f elementor-widget elementor-widget-bako-skill" data-id="d20b90f" data-element_type="widget" data-widget_type="bako-skill.default">
																				<div class="elementor-widget-container">
																					<div class="skill-item">
																						<div class="skill-info clearfix">
																							<h4 class="float-left mb-3 mt-0"><?php echo $skill['title']; ?></h4> 
																							<span class="float-right"><?php echo $skill['percentage']; ?>%</span>
																						</div>
																						<div class="progress">
																							<div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo $skill['percentage']; ?>">
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
				                                                }
				                                            }else {
				                                            ?>
				                                            <h4 class="text-center">Data Not Available</h4>
				                                            <?php } ?>
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<!-- 
							<section class="elementor-element elementor-element-54a51a7 shadow-dark elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="54a51a7" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-background-overlay"></div>
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-835a2ca elementor-column elementor-col-25 elementor-top-column" data-id="835a2ca" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-cd48783 elementor-widget elementor-widget-bako-icon" data-id="cd48783" data-element_type="widget" data-widget_type="bako-icon.default">
														<div class="elementor-widget-container"> 
															<i class="icon-like icon-circle"></i>
														</div>
													</div>
													<div class="elementor-element elementor-element-be08f9e elementor-widget elementor-widget-counter" data-id="be08f9e" data-element_type="widget" data-widget_type="counter.default">
														<div class="elementor-widget-container">
															<div class="elementor-counter">
																<div class="elementor-counter-number-wrapper"> 
																	<span class="elementor-counter-number-prefix"></span> 
																	<span class="elementor-counter-number" data-duration="2000" data-to-value="157" data-from-value="0">0</span> 
																	<span class="elementor-counter-number-suffix"></span>
																</div>
																<div class="elementor-counter-title">Projects completed</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="elementor-element elementor-element-2a079eb elementor-column elementor-col-25 elementor-top-column" data-id="2a079eb" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-7502e5c elementor-widget elementor-widget-bako-icon" data-id="7502e5c" data-element_type="widget" data-widget_type="bako-icon.default">
														<div class="elementor-widget-container"> 
															<i class="icon-cup icon-circle"></i>
														</div>
													</div>
													<div class="elementor-element elementor-element-a1a75df elementor-widget elementor-widget-counter" data-id="a1a75df" data-element_type="widget" data-widget_type="counter.default">
														<div class="elementor-widget-container">
															<div class="elementor-counter">
																<div class="elementor-counter-number-wrapper"> 
																	<span class="elementor-counter-number-prefix"></span> 
																	<span class="elementor-counter-number" data-duration="2000" data-to-value="2765" data-from-value="0">0</span> 
																	<span class="elementor-counter-number-suffix"></span>
																</div>
																<div class="elementor-counter-title">Cup of coffee</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="elementor-element elementor-element-55b6a90 elementor-column elementor-col-25 elementor-top-column" data-id="55b6a90" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-66b1512 elementor-widget elementor-widget-bako-icon" data-id="66b1512" data-element_type="widget" data-widget_type="bako-icon.default">
														<div class="elementor-widget-container"> 
															<i class="icon-emotsmile icon-circle"></i>
														</div>
													</div>
													<div class="elementor-element elementor-element-188e405 elementor-widget elementor-widget-counter" data-id="188e405" data-element_type="widget" data-widget_type="counter.default">
														<div class="elementor-widget-container">
															<div class="elementor-counter">
																<div class="elementor-counter-number-wrapper"> 
																	<span class="elementor-counter-number-prefix"></span> 
																	<span class="elementor-counter-number" data-duration="2000" data-to-value="350" data-from-value="0">0</span> 
																	<span class="elementor-counter-number-suffix"></span>
																</div>
																<div class="elementor-counter-title">Happy customers</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="elementor-element elementor-element-24a682b elementor-column elementor-col-25 elementor-top-column" data-id="24a682b" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-1e4e7e4 elementor-widget elementor-widget-bako-icon" data-id="1e4e7e4" data-element_type="widget" data-widget_type="bako-icon.default">
														<div class="elementor-widget-container"> 
															<i class="icon-trophy icon-circle"></i>
														</div>
													</div>
													<div class="elementor-element elementor-element-6ebd00a elementor-widget elementor-widget-counter" data-id="6ebd00a" data-element_type="widget" data-widget_type="counter.default">
														<div class="elementor-widget-container">
															<div class="elementor-counter">
																<div class="elementor-counter-number-wrapper"> 
																	<span class="elementor-counter-number-prefix"></span> 
																	<span class="elementor-counter-number" data-duration="2000" data-to-value="29" data-from-value="0">0</span> 
																	<span class="elementor-counter-number-suffix"></span>
																</div>
																<div class="elementor-counter-title">Awards won</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						    -->

							<section class="elementor-element elementor-element-d37343a shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="d37343a" data-element_type="section" id="services" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-816c7b4 elementor-column elementor-col-100 elementor-top-column" data-id="816c7b4" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-f2334b4 elementor-widget elementor-widget-bako-section-title" data-id="f2334b4" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Services</h3>
														</div>
													</div>
													<div class="elementor-element elementor-element-bcb34d9 elementor-widget elementor-widget-spacer" data-id="bcb34d9" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<section class="elementor-element elementor-element-914e9ba elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="914e9ba" data-element_type="section">
														<div class="elementor-container elementor-column-gap-default">
															<div class="elementor-row row">
															<?php 
					                                            if ($services_result -> num_rows > 0) {
					                                                $sr = 1;
					                                                while ($service = $services_result->fetch_assoc()) {
					                                        ?>
																<div class="col-md-4 elementor-element elementor-column elementor-col-33 elementor-inner-column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-widget elementor-widget-bako-service" style="cursor: pointer;">
																				<div class="elementor-widget-container">
																					<div class="service-item text-center"> 
																						<i class="<?php echo $service['icon']; ?> icon-simple"></i>
																						<h4 class="my-3"><?php echo $service['title']; ?></h4>
																						<p class="mb-0" title="<?php echo $service['description']; ?>"><?php echo (strlen($service['description']) > 55) ? substr($service['description'], 0, 55)."..." : $service['description']; ?></p>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
				                                                }
				                                            }else {
				                                            ?>
				                                            <h4>Data Not Available</h4>
				                                        	<?php } ?>
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="elementor-element elementor-element-6035891 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="6035891" data-element_type="section" id="resume" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-622d1cb elementor-column elementor-col-100 elementor-top-column" data-id="622d1cb" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-2430684 elementor-widget elementor-widget-bako-section-title" data-id="2430684" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Experience</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-8c19699 elementor-widget elementor-widget-spacer" data-id="8c19699" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-dc80888 elementor-widget elementor-widget-bako-timeline" data-id="dc80888" data-element_type="widget" data-widget_type="bako-timeline.default">
														<div class="elementor-widget-container">
															<div class="timeline">
															<?php 
					                                            if ($exp_result -> num_rows > 0) {
					                                                $sr = 1;
					                                                while ($exp = $exp_result->fetch_assoc()) {
					                                        ?>
																<div class="entry">
																	<div class="title">
																		<?php 
																			$end_date = date_format(date_create($exp['end_date']),"M Y");
																			if (date_format(date_create($exp['end_date']),"d-M-y") == date_format(date_create($exp['created_at']),"d-M-y")) {
																				$end_date = "Present";
																			} 
																		?>
																		<span><?php echo date_format(date_create($exp['start_date']),"M Y"). ' - '. $end_date; ?></span>
																	</div>
																	<div class="body">
																		<h4 class="mt-0"><?php echo $exp['title'] ?></h4>
																		<p><?php echo $exp['description']; ?></p>
																	</div>
																</div>
															<?php
				                                                }
				                                            }else {
				                                            ?>
				                                            <h4>Data Not Available</h4>
				                                            <?php } ?>
																<span class="timeline-line"></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="elementor-element elementor-element-03637ba shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="03637ba" data-element_type="section" id="works" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-9884b88 elementor-column elementor-col-100 elementor-top-column" data-id="9884b88" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-96946c1 elementor-widget elementor-widget-bako-section-title" data-id="96946c1" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Portfolio</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-f39685f elementor-widget elementor-widget-spacer" data-id="f39685f" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-8496847 elementor-widget elementor-widget-bako-portfolio" data-id="8496847" data-element_type="widget" data-widget_type="bako-portfolio.default">
														<div class="elementor-widget-container">
															<ul class="portfolio-filter list-inline">
																<li class="current list-inline-item" data-filter="*">All Projects</li>
															<?php 
															if ($portfolio_cat_result -> num_rows > 0) 
															{
																while ($portfolio_cat = $portfolio_cat_result->fetch_assoc()) {
															?>
															<li class="list-inline-item" data-filter=".<?php echo str_replace(" ", "_", $portfolio_cat['category']); ?>"><?php echo($portfolio_cat['category']); ?></li>
															<?php
																}
															}
															?>
															</ul>

															<div class="pf-filter-wrapper mb-4"> 
																<select class="portfolio-filter-mobile form-control">
																	<option value="*">All Projects</option>
																	<?php 
																	mysqli_data_seek($portfolio_cat_result, 0);
																	if ($portfolio_cat_result -> num_rows > 0) 
																	{
																		while ($portfolio_cat_mobile = $portfolio_cat_result->fetch_assoc()) {
																	?>
																		<option value=".<?php echo str_replace(" ", "_", $portfolio_cat_mobile['category']); ?>"><?php echo $portfolio_cat_mobile['category']; ?></option> 
																	<?php } } ?>
																</select>
															</div>
															<div class="row portfolio-wrapper">
																<?php 

																if ($portfolio_result -> num_rows >0) {
																	while ($portfolio = $portfolio_result->fetch_assoc()) {
																?>
																<div class="col-md-4 col-sm-6 grid-item <?php echo str_replace(" ", "_", $portfolio['category']); ?>"> 
																	<a href="portfolio_details.php?id=<?php echo $portfolio['id']; ?>">
																		<div class="portfolio-item">
																			<div class="details">
																				<h4 class="title"><?php echo $portfolio['title']; ?></h4> 
																				<span class='term'><?php echo $portfolio['category']; ?></span>
																				<!-- <span class='term'>Creacive</span> -->
																			</div> 
																			<span class="plus-icon">+</span>
																			<div class="thumb">
																				<img width="420" height="315px" src='../admin/<?php echo $portfolio['cover_image']; ?>' />
																				<div class="mask"></div>
																			</div>
																		</div> 
																	</a>
																</div>
																<?php
																	} 
																}else { ?>
																	<h4>Data Not Found</h4>
																<?php }?>
															</div>

															<ul class="portfolio-pagination list-inline d-none">
																<li class='list-inline-item'>
																	<span aria-current="page" class="page-numbers current">1</span>
																</li>
																<li class='list-inline-item'>
																	<a class="page-numbers" href="#">2</a>
																</li>
															</ul>
															<div class="load-more text-center mt-4"> 
																<a href="javascript:" class="btn btn-default">
																	<i class="fas fa-circle-notch"></i>Load more
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>


							<section class="elementor-element elementor-element-dfcdc3c shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="dfcdc3c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-dad4586 elementor-column elementor-col-100 elementor-top-column" data-id="dad4586" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-22b3124 elementor-widget elementor-widget-bako-section-title" data-id="22b3124" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Testimonials</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-2760e3b elementor-widget elementor-widget-spacer" data-id="2760e3b" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-7805ba1 elementor-widget elementor-widget-bako-testimonial" data-id="7805ba1" data-element_type="widget" data-widget_type="bako-testimonial.default">
														<div class="elementor-widget-container">
															<div class="row testimonials-wrapper">
															<?php
																if ($testimonial_result -> num_rows > 0) {
						                                            while ($testimonial = $testimonial_result -> fetch_assoc()) {
						                                    ?>
																<div class="col-md-6">
																	<div class="testimonial-item"> 
																		<span class="symbol"><i class="fas fa-quote-left"></i></span>
																		<p><?php echo $testimonial['quote']; ?></p>
																		<div class="testimonial-details">
																			<div class="thumb"> 
																				<img class="lazyload img-fluid" src='../admin/<?php echo $testimonial['image']; ?>' alt="customer-name" />
																			</div>
																			<div class="info">
																				<h4><?php echo $testimonial['name']; ?></h4> 
																				<span><?php echo $testimonial['designation']; ?></span>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
				                                                }
				                                            }else {
				                                            ?>
				                                            	<h4>Data Not Available</h4>
				                                            <?php } ?>

															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="elementor-element elementor-element-25748d4 shadow-dark elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="25748d4" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-background-overlay"></div>
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-1f880db elementor-column elementor-col-100 elementor-top-column" data-id="1f880db" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-ec182da elementor-widget elementor-widget-bako-clients" data-id="ec182da" data-element_type="widget" data-widget_type="bako-clients.default">
														<div class="elementor-widget-container">
															<div class="clients-wrapper row">
																<?php
																	if ($client_result -> num_rows > 0) {
							                                            while ($client = $client_result -> fetch_assoc()) {
							                                    ?>
																<div class="col-md-3">
																	<div class="client-item">
																		<div class="inner"> 
																			<img src="../admin/<?php echo $client['image']; ?>">
																		</div>
																	</div>
																</div>
																<?php
					                                                }
					                                            }else {
					                                            ?>
					                                            	<h4>Data Not Available</h4>
					                                            <?php } ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="elementor-element elementor-element-c2eb944 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="c2eb944" data-element_type="section" id="blog" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-2c202f2 elementor-column elementor-col-100 elementor-top-column" data-id="2c202f3" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-5760157 elementor-widget elementor-widget-bako-section-title" data-id="5760157" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Recent posts</h3>
														</div>
													</div>
													<div class="elementor-element elementor-element-5484565 elementor-widget elementor-widget-spacer" data-id="5484565" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>
													<div class="elementor-element elementor-element-b0be048 elementor-widget elementor-widget-bako-posts" data-id="b0be048" data-element_type="widget" data-widget_type="bako-posts.default">
														<div class="elementor-widget-container">
															<div class="row">
																<div class="col-md-4">
																	<div class="blog-item">
																		<div class="thumb"> 
																			<a href="#">
																				<span class="category">Thoughts</span>
																			</a>
																			<a href="#">
																				<noscript>
																					<img width="243" height="182" src="asset/images/1.jpg" class="attachment-245x182 size-245x182 wp-post-image" alt="" srcset="asset/images/1.jpg 800w, asset/images/1-300x225.jpg 300w, asset/images/1-768x576.jpg 768w" sizes="(max-width: 243px) 100vw, 243px" />
																				</noscript>
																				<img width="243" height="182" src='data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20243%20182%22%3E%3C/svg%3E' data-src="asset/images/1.jpg" class="lazyload attachment-245x182 size-245x182 wp-post-image" alt="" data-srcset="asset/images/1.jpg 800w, asset/images/1-300x225.jpg 300w, asset/images/1-768x576.jpg 768w" data-sizes="(max-width: 243px) 100vw, 243px" />
																			</a>
																		</div>
																		<h4 class="mt-4 mb-0">
																			<a href="#">The Truth About Design In 3 Minutes</a>
																		</h4>
																		<ul class="list-inline meta mb-0 mt-3">
																			<li class="list-inline-item">08 April 2019</li>
																			<li class="list-inline-item">
																				<a href="#" rel="author">Vikram</a>
																			</li>
																		</ul>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="blog-item">
																		<div class="thumb"> 
																			<a href="#">
																				<span class="category">Blog</span>
																			</a>
																			<a href="#">
																				<noscript>
																					<img width="243" height="182" src="asset/images/2.jpg" class="attachment-245x182 size-245x182 wp-post-image" alt="" srcset="asset/images/2.jpg 800w, asset/images/2-300x225.jpg 300w, asset/images/2-768x576.jpg 768w" sizes="(max-width: 243px) 100vw, 243px" />
																				</noscript>
																				<img width="243" height="182" src='data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20243%20182%22%3E%3C/svg%3E' data-src="asset/images/2.jpg" class="lazyload attachment-245x182 size-245x182 wp-post-image" alt="" data-srcset="asset/images/2.jpg 800w, asset/images/2-300x225.jpg 300w, asset/images/2-768x576.jpg 768w" data-sizes="(max-width: 243px) 100vw, 243px" />
																			</a>
																		</div>
																		<h4 class="mt-4 mb-0">
																			<a href="#">The Ugly Truth About Design</a>
																		</h4>
																		<ul class="list-inline meta mb-0 mt-3">
																			<li class="list-inline-item">08 April 2019</li>
																			<li class="list-inline-item">
																				<a href="#" title="Posts by Vikram" rel="author">Vikram</a>
																			</li>
																		</ul>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="blog-item">
																		<div class="thumb"> 
																			<a href="#"><span class="category">Tech</span></a>
																			<a href="#">
																				<noscript>
																					<img width="243" height="182" src="asset/images/3.jpg" class="attachment-245x182 size-245x182 wp-post-image" alt="" srcset="asset/images/3.jpg 800w, asset/images/3-300x225.jpg 300w, asset/images/3-768x576.jpg 768w" sizes="(max-width: 243px) 100vw, 243px" />
																				</noscript>
																				<img width="243" height="182" src='data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20243%20182%22%3E%3C/svg%3E' data-src="asset/images/3.jpg" class="lazyload attachment-245x182 size-245x182 wp-post-image" alt="" data-srcset="asset/images/3.jpg 800w, asset/images/3-300x225.jpg 300w, asset/images/3-768x576.jpg 768w" data-sizes="(max-width: 243px) 100vw, 243px" />
																			</a>
																		</div>
																		<h4 class="mt-4 mb-0">
																			<a href="#">How To Become Better With UI Design</a>
																		</h4>
																		<ul class="list-inline meta mb-0 mt-3">
																			<li class="list-inline-item">07 April 2019</li>
																			<li class="list-inline-item">
																				<a href="#" title="Posts by Vikram" rel="author">Vikram</a>
																			</li>
																		</ul>
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

							<section class="elementor-element elementor-element-c2eb944 shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="688b47d" data-element_type="section" id="contact" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-91ecb8a elementor-column elementor-col-100 elementor-top-column" data-id="91ecb8a" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-59c6a94 elementor-widget elementor-widget-bako-section-title" data-id="59c6a94" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Get in touch</h3>
														</div>
													</div>
													<div class="elementor-element elementor-element-e5d8fe5 elementor-widget elementor-widget-spacer" data-id="e5d8fe5" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<section class="elementor-element elementor-element-32eaa98 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="32eaa98" data-element_type="section">
														<div class="elementor-container elementor-column-gap-default">
															<div class="elementor-row">
																<div class="elementor-element elementor-element-3f4ccb2 elementor-column elementor-col-33 elementor-inner-column" data-id="3f4ccb2" data-element_type="column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-element-fca804d elementor-widget elementor-widget-bako-contact" data-id="fca804d" data-element_type="widget" data-widget_type="bako-contact.default">
																				<div class="elementor-widget-container">
																					<div class="contact-info"> 
																						<i class="icon-phone"></i>
																						<div class="details">
																							<h5>Phone</h5> 
																							<span><?php echo $about['mobile']; ?></span>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="elementor-element elementor-element-c5713f0 elementor-widget elementor-widget-spacer" data-id="c5713f0" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>
																			<div class="elementor-element elementor-element-447fdff elementor-widget elementor-widget-bako-contact" data-id="447fdff" data-element_type="widget" data-widget_type="bako-contact.default">
																				<div class="elementor-widget-container">
																					<div class="contact-info"> 
																						<i class="icon-envelope"></i>
																						<div class="details">
																							<h5>Email address</h5> 
																							<span><?php echo $about['email']; ?></span>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="elementor-element elementor-element-e7f3dd5 elementor-widget elementor-widget-spacer" data-id="e7f3dd5" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>
																			<div class="elementor-element elementor-element-972adfd elementor-widget elementor-widget-bako-contact" data-id="972adfd" data-element_type="widget" data-widget_type="bako-contact.default">
																				<div class="elementor-widget-container">
																					<div class="contact-info"> 
																						<i class="icon-location-pin"></i>
																						<div class="details">
																							<h5>Location</h5> 
																							<span><?php echo $about['address']; ?></span>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="elementor-element elementor-element-ad7c6f4 elementor-column elementor-col-66 elementor-inner-column" data-id="ad7c6f4" data-element_type="column">
																	<div class="elementor-column-wrap  elementor-element-populated">
																		<div class="elementor-widget-wrap">
																			<div class="elementor-element elementor-element-503edda elementor-widget elementor-widget-spacer" data-id="503edda" data-element_type="widget" data-widget_type="spacer.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-spacer">
																						<div class="elementor-spacer-inner"></div>
																					</div>
																				</div>
																			</div>
																			<div class="elementor-element elementor-element-a477687 elementor-widget elementor-widget-shortcode" data-id="a477687" data-element_type="widget" data-widget_type="shortcode.default">
																				<div class="elementor-widget-container">
																					<div class="elementor-shortcode">
																						<div role="form">
																							<div class="screen-reader-response"></div>

																							<form action="contact_form_submit.php" method="post" onsubmit="return validateContactForm(this)">
																								<div class="row">
																									<div class="column col-md-6">
																										<p>
																											<div class="form-group"> 
																												<span class="your-name">
																													<input type="text" name="your-name" id="your_name" required="" value="" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="Your name" />
																												</span>
																											</div>
																										</p>
																									</div>
																									<div class="column col-md-6">
																										<p>
																											<div class="form-group"> 
																												<span class="your-email">
																													<input type="email" name="your-email" id="your_email" required="" value="" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="Email address" />
																												</span>
																											</div>
																										</p>
																									</div>
																									<div class="column col-md-12">
																										<p>
																											<div class="form-group"> 
																												<span class="your-subject">
																													<input type="text" name="your-subject" id="your_subject" required="" value="" size="40" class="form-control" aria-required="true" aria-invalid="false" placeholder="Subject" />
																												</span>
																											</div>
																										</p>
																									</div>
																									<div class="column col-md-12">
																										<p>
																											<div class="form-group"> 
																												<span class="your-message">
																													<textarea name="your-message" id="your_message" required="" cols="40" rows="4" class="form-control" aria-required="true" aria-invalid="false" placeholder="Message..."></textarea>
																												</span>
																											</div>
																										</p>
																									</div>
																								</div>
																								<p>
																									<button type="submit" name="submit_contact_form" id="" value="Submit" class="btn btn-default">Submit Message</button>
																								</p>
																							</form>

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

							<!-- Social -->
							<section class="elementor-element elementor-element-dfcdc3c shadow-blue elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="dfcdc3c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
								<div class="elementor-container elementor-column-gap-default">
									<div class="elementor-row">
										<div class="elementor-element elementor-element-dad4586 elementor-column elementor-col-100 elementor-top-column" data-id="dad4586" data-element_type="column">
											<div class="elementor-column-wrap  elementor-element-populated">
												<div class="elementor-widget-wrap">
													<div class="elementor-element elementor-element-22b3124 elementor-widget elementor-widget-bako-section-title" data-id="22b3124" data-element_type="widget" data-widget_type="bako-section-title.default">
														<div class="elementor-widget-container">
															<h3 class="section-title">Connect With</h3>
														</div>
													</div>

													<div class="elementor-element elementor-element-2760e3b elementor-widget elementor-widget-spacer" data-id="2760e3b" data-element_type="widget" data-widget_type="spacer.default">
														<div class="elementor-widget-container">
															<div class="elementor-spacer">
																<div class="elementor-spacer-inner"></div>
															</div>
														</div>
													</div>

													<div class="elementor-element elementor-element-7805ba1 elementor-widget elementor-widget-bako-testimonial" data-id="7805ba1" data-element_type="widget" data-widget_type="bako-testimonial.default">
														<div class="elementor-widget-container">
															<div class="row">
																<div class="social_w3ls_pvt">
															        <div class="container py-lg-5">
															            <ul class="py-4">
															                <li><a href="<?php echo $social_link['facebook']; ?>"><span class="fa fa-facebook"
															                            aria-hidden="true"></span></a></li>
															                <li><a href="<?php echo $social_link['twitter']; ?>"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
															                <li><a href="<?php echo $social_link['google_plus']; ?>"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>
															                <li><a href="<?php echo $social_link['linkedin']; ?>"><span class="fa fa-linkedin"
															                            aria-hidden="true"></span></a></li>
															                <li><a href="<?php echo "#"//$social_link['pinterest']; ?>"><span class="fa fa-pinterest" aria-hidden="true"></span></a></li>
															            </ul>
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
					    <!-- //social -->

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

			function validateContactForm(form) {
				if (form.your_name.value.length == 0) {
	                showAlert('Please enter name');
	                return false;
	            }else if (form.your_email.value.length == 0) {
	                showAlert('Please enter email address');
	                return false;
	            }else if (form.your_subject.value.length == 0) {
	                showAlert('Please enter your subject');
	                return false;
	            }else if (form.your_message.value.length == 0) {
	                showAlert('Please enter your message');
	                return false;
	            }else {
	                return true;
	            }
			}
		</script> 

		<script src="asset/js/main.js"></script>
</body>
</html>