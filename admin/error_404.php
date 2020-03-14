<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Page Not Found</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">
<script>
  if (typeof(Storage) !== "undefined") {
      var theme = localStorage.getItem("selected_theme");

      if (theme) {
          let body = document.getElementsByTagName("body")[0];
          body.className = theme;
      }
  };
</script>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center error-pages">
                        <h1 class="error-title text-white"> 404</h1>
                        <h2 class="error-sub-title text-white">404 not found</h2>

                        <p class="error-message text-white text-uppercase">Sorry, an error has occured, Requested page not found!</p>
                        
                        <div class="mt-4">
                          <a href="javascript:history.go(-1)" class="btn btn-light btn-round m-1">Go Back </a>
                        </div>

                        <div class="mt-4">
                            <p class="text-white">Copyright © <script>document.write(new Date().getFullYear());</script> Vikram Kumar | All rights reserved.</p>
                        </div>
                           <hr class="w-50 border-light">
                        <div class="mt-2">
                            <a href="javascript:void()" class="btn-social btn-social-circle waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>
                            <a href="javascript:void()" class="btn-social btn-social-circle waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>
                            <a href="javascript:void()" class="btn-social btn-social-circle waves-effect waves-light m-1"><i class="fa fa-behance"></i></a>
                            <a href="javascript:void()" class="btn-social btn-social-circle waves-effect waves-light m-1"><i class="fa fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->

 </div><!--wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
	
</body>
</html>
