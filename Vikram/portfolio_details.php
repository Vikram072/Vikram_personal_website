<?php 

	require_once("../admin/include/config.php");

    $query = "SELECT title, category, cover_image, description, portfolio.created_at, admin.fullname AS username FROM portfolio, admin WHERE portfolio.id=? && admin.id=(SELECT user_id FROM portfolio WHERE id=?)";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("Location: ../admin/error_404.php");
    }else{
        mysqli_stmt_bind_param($stmt, "ii", $_GET['id'], $_GET['id']);

        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            if ($res -> num_rows > 0) {
                $data = $res->fetch_assoc();
            }else {
                header("Location: ../admin/error_404.php");
                exit();
                $data = array("title"=>"", "category"=>"", "cover_image"=> "", "description"=>"");
            }
        }
    }

 ?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link media="all" href="asset/css/main.css" rel="stylesheet" />
		<title><?php echo $data['title']; ?> | Portfolio</title>

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
	<body class="portfolio-template-default single single-portfolio postid-112 elementor-default">
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

			<!-- MAIN SECTION -->
			<main class="content float-right">
				<section class="single-portfolio background-white rounded padding-50 shadow-blue">
					<h2 class="archive-header"><?php echo $data['title']; ?></h2>
					<ul class="list-inline portfolio-info mb-0 mt-4">
						<li class="list-inline-item">
							<i class="icon-user"></i><?php echo $data['username']; ?>
						</li>
						<li class="list-inline-item">
							<i class="icon-calendar"></i><?php echo date_format(date_create($data['created_at']),"d/m/Y"); ?>
						</li>
						<li class="list-inline-item">
							<i class="icon-link"></i>
							<a href="#"><?php echo $data['category']; ?></a>
						</li>
					</ul>
					<div class="spacer" data-height="40"></div> 
					<img src="../admin/<?php echo $data['cover_image']; ?>" class="img-fluid rounded lazyload attachment-bako-portfolio-single size-bako-portfolio-single wp-post-image"  alt="" style="max-height: 400px;">
			
					<div class="portfolio-content mt-5">
						<?php echo $data['description']; ?>						
					</div>
				</section>
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

		<script src="asset/js/main.js"></script>
	</body>
	</html>
