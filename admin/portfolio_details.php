<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Portfolio</title>
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
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <style>
        .footer{
            position: initial !important;
        }
    </style>
</head>
<body>
<script>
  if (typeof(Storage) !== "undefined") {
      var theme = localStorage.getItem("selected_theme");

      if (theme) {
          let body = document.getElementsByTagName("body")[0];
          body.className = theme;
      }
  };
</script>

<?php

    require_once("include/config.php");
    // PRTFOLIO DETAILS
    $query = "SELECT title, category, cover_image, description, portfolio.created_at, admin.fullname AS username FROM portfolio, admin WHERE portfolio.id=? && admin.id=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        show_alert('Something went wrong. Please try again.');
    }else{
        mysqli_stmt_bind_param($stmt, "ii", $_GET['id'], $_SESSION['user_id']);

        if (mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            if ($res -> num_rows > 0) {
                $data = $res->fetch_assoc();
            }else {
                header("Location: error_404.php");
                exit();
                $data = array("title"=>"", "category"=>"", "cover_image"=> "", "description"=>"");
            }
        }
    }
?>
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner" >
                <div class="loader"></div>
            </div>
        </div>
    </div>
   <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="clearfix"></div>
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <h4><?php echo $data['title']; ?></h4>
                    <div class="row my-3">
                        <div class="col">
                            <a href="#" class="mr-3"><i class="fa fa-user pr-1"></i>
                                <?php echo $data['username']; ?>
                            </a>
                            <a href="#" class="mr-3"><i class="fa fa-calendar pr-1"></i>
                                <?php echo date_format(date_create($data['created_at']),"d/m/Y"); ?>
                            </a>
                            <a href="#"><i class="fa fa-share-alt pr-1"></i>
                                <?php echo $data['category']; ?>
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <img src="<?php echo $data['cover_image']; ?>" class="img-fluid rounded"  alt="" style="max-height: 340px;">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col my-3">
                            <?php echo $data['description']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <?php include("include/footer.php") ?>
        <?php include("include/theme.php") ?>
    </div>
    <!-- End Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
</body>
</html>