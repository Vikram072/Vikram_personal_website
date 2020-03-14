<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Vibur" rel="stylesheet">
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

    <style>
        .welcome {
            display: flex;
             justify-content: center;
             align-items: center;
             font-family: 'Vibur', cursive;
             font-size: 2em;
             color: #666;
        }
    </style>
 
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

        <?php require("include/sidemenu.php") ?>
        <?php require("include/header.php") ?>

        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
            		    <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
                <!-- End Breadcrumb-->
                <div class="row mt-5 py-5">
                    <div class="col-lg-12">
                        <div class="welcome">
                            <div id="welcome-message" class="mr-3">
                            </div>
                        </div>
                    </div>
                </div>
                <!--start overlay-->
        	  <div class="overlay toggle-menu"></div>
              <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div>
        <!--End content-wrapper-->

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
    	
    	<?php include("include/footer.php") ?>
        <?php include("include/theme.php") ?>

    </div><!--End wrapper-->
  

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

    <!-- WELCOME MESSAGE -->
    <script type="text/javascript">
        var today = new Date();
        var hourNow = today.getHours();
        var greeting;
        var icon;

        if (hourNow < 12){
          greeting = "Good Morning";
        }
        else if (hourNow < 20){
          greeting = 'Good afternoon!';
        }
        else if (hourNow < 24){
          greeting = "Good evening"
        }
        else {
          greeting = "Welcome";
        }

        document.getElementById("welcome-message").innerHTML = "<h3>" + greeting + <?php echo "' $user[fullname]'"; ?> + " </h1>";
    </script>

</body>
</html>
