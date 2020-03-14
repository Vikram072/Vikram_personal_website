<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Vikram Kumar | Login</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
    <!-- notifications css -->
    <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css"/>
    <!--notification js -->
    <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="assets/plugins/notifications/js/notifications.min.js"></script>

    <script>
        function showAlert(message){
            Lobibox.notify('warning', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                icon: 'fa fa-exclamation-circle',
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: message
            });
        } 
    </script>

    <style>
        footer {
            bottom: 0px !important;
            position: relative !important;
            left: 0px !important;
        }
    </style>
  
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

<?php 
    session_start();
    require_once("include/config.php");

    if(isset($_SESSION['is_admin_login'])){
      header("Location: index.php");
    }
    
    if(isset($_POST['btn_login'])){
        $uname = md5($_POST['username']);
        $pass = md5($_POST['password']);

        $query = "SELECT id, enc_username, password FROM admin WHERE enc_username=? AND password=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "<script> showAlert('Something went wrong. Please try again.'); </script>";   
        }else{
            mysqli_stmt_bind_param($stmt, "ss",$uname,$pass);
            mysqli_stmt_execute($stmt);
        }
          //$tb = $stmt->fetchAll();
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) > 0) {
            $_SESSION['is_admin_login'] = true;
            $_SESSION['admin_username'] = $uname;
            $_SESSION['user_id'] = $res -> fetch_object() -> id;
            header("Location: index.php");
        }else{
            echo "<script> showAlert('The username or password do not match, please try again.'); </script>";
        }
    }
?>
<!-- Start wrapper-->
 <div id="wrapper">

    <!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

	<div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-authentication1 mx-auto my-5 animated">
                    <div class="user-lock rounded-top bg-dark-light">
                        <div class="user-lock-img">
                            <img src="assets/images/avatars/avatar-3.png" alt="user avatar" style="width: 130px; height: 130px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center mt-5 py-2">Vikram Kumar</h4>
                        <form method="post">
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" required="" autocomplete="off" autocapitalize="off" class="form-control" placeholder="Username" value='<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>'>
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" required="" class="form-control" placeholder="Password">
                                    <div class="form-control-position">
                                        <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mr-0 ml-0">
                                <div class="form-group col-6">
                                    <div class="icheck-material-white">
                                        <input type="checkbox" id="user-checkbox" checked="" />
                                        <label for="user-checkbox">Remember me</label>
                                    </div>
                                </div>
                                <div class="form-group col-6 text-right">
                                    <a href="reset-password.php">Reset Password</a>
                                </div>
                            </div>
                            <button type="submit" name="btn_login" class="btn btn-light btn-block waves-effect waves-light mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <?php include("include/theme.php") ?>

</div><!--wrapper-->
    <?php include("include/footer.php") ?>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
  
</body>
</html>
