<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Global Setting</title>
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
    if(isset($_POST['btn_save'])) {
        $query = "UPDATE global_setting SET website_name=?, name=?, designation=? WHERE id=1";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $website_name = $con -> real_escape_string($_POST['website_name']);
            $your_name = $con -> real_escape_string($_POST['your_name']);
            $desg = $con -> real_escape_string($_POST['desg']);

            mysqli_stmt_bind_param($stmt, "sss", $website_name, $your_name, $desg);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Changes Saved');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }

    // FILL DATA
    $select_query = "SELECT website_name, name, designation FROM global_setting WHERE id=1";
    $result = $con -> query($select_query);

    if ($result -> num_rows > 0) {
        $global_setting = $result->fetch_assoc();
    }else {
        $global_setting = array("website_name"=>"", "name"=>"", "designation"=>"");
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <h4>Global Setting</h4>
                        </div>
                    </div>
                </div>

                <div class="border-bottom p-0 m-0"></div>

                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="POST" onsubmit="return performValidation(this)">
                                    <div class="form-group">
                                        <label for="website_name">Wesite Name</label>
                                        <input type="text" name="website_name" value="<?php echo $global_setting['website_name']; ?>" class="form-control" id="website_name" placeholder="Enter Website Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="your_name">Your Name</label>
                                        <input type="text" name="your_name" value="<?php echo $global_setting['name']; ?>" class="form-control" id="your_name" placeholder="Enter Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="desg">Designation</label>
                                        <input type="text" name="desg" value="<?php echo $global_setting['designation']; ?>" class="form-control" id="desg" placeholder="Enter Your Designation">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="btn_save" class="btn btn-light btn-lg px-5"><i class="zmdi ti-save"></i> Save</button>
                                    </div>
                                </form>
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
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>

    <script>
        function performValidation(form) {

            if ($("#website_name").val().length == 0){
                showAlert('Please enter website name.',"center top");
                return false;
            }else if ($("#your_name").val().length == 0){
                showAlert('Please enter your name.',"center top");
                return false;
            }else if ($("#desg").val().length == 0){
                showAlert('Please enter your designation.',"center top");
                return false;
            }else {
                return true;
            }
        }
    </script>

</body>
</html>
