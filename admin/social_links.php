<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Contacts</title>
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
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>
    
</head>

<body class="bg-theme bg-theme1">
<?php 

    require_once("include/config.php");
    if(isset($_POST['update_social_links']))
    {
        $update_query = "UPDATE social_links SET facebook=?, instagram=?, twitter=?, linkedin=?, google_plus=?, youtube=?, whatsapp=?, skype=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $id = "1";
            mysqli_stmt_bind_param($update_stmt, "ssssssssi", 
                $_POST['facebook'], 
                $_POST['instagram'], 
                $_POST['twitter'], 
                $_POST['linkedin'],
                $_POST['google_plus'],
                $_POST['youtube'],
                $_POST['whatsapp'],
                $_POST['skype'],
                $id
            );

            if (mysqli_stmt_execute($update_stmt)){
                show_success_alert('Social Links successfully updated.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    //FILL SOCIAL LINKS
    $select_query = "SELECT * FROM social_links WHERE id=1";
    $result = $con -> query($select_query);

    $link = array("facebook" => "", "instagram" => "", "linkedin"=> "", "twitter"=> "", "google_plus" => "", "youtube" => "", "whatsapp"=> "", "skype"=> "");
    if ($result) {
        if ($result -> num_rows > 0) {
            $link = $result->fetch_assoc();
        }
    }else {
        debug_to_console($con -> error);
    } 

 ?>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

        <?php require("include/sidemenu.php") ?>
        <?php require("include/header.php") ?>

        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form action="" method="post">
                                    <h4 class="form-header text-uppercase">Social Links</h4>
                                    <div class="row">
                                        <!-- Social Facebook -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-facebook-f"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="facebook" value="<?php echo $link['facebook']; ?>" placeholder="Facebook Link...." class="form-control" />
                                            </div>
                                        </div>
                                        <!-- Social Insta -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-instagram"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="instagram" value="<?php echo $link['instagram']; ?>" placeholder="Instagram Link...." class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Social Twitter -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-twitter"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="twitter" value="<?php echo $link['twitter']; ?>" placeholder="Twitter Link...." class="form-control" />
                                            </div>
                                        </div>
                                        <!-- Social Linkedin -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-linkedin"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="linkedin" value="<?php echo $link['linkedin']; ?>" placeholder="Linkedin Link...." class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Social Google Plus -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-google-plus"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="google_plus" value="<?php echo $link['google_plus']; ?>" placeholder="Google+ Link...." class="form-control" />
                                            </div>
                                        </div>
                                        <!-- Social YouTube -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-youtube"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="youtube" value="<?php echo $link['youtube']; ?>" placeholder="YouTube Link...." class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Social Whatsapp -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-whatsapp"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="whatsapp" value="<?php echo $link['whatsapp']; ?>" placeholder="Whatsapp Link...." class="form-control" />
                                            </div>
                                        </div>
                                        <!-- Social Skype -->
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-skype"></i>
                                                    </span>
                                                </div>
                                                <input type="url" name="skype" value="<?php echo $link['skype']; ?>" placeholder="Skype Link...." class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="update_social_links" class="btn btn-light btn-lg">Update</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </iv>
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
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>

</body>
</html>
