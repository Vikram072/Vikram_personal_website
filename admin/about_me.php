<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>About Me</title>
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
    <!-- Dropzone css -->
    <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <!--Bootstrap Datepicker-->
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>
</head>

<body class="bg-theme bg-theme1">

<?php
    require_once("include/config.php");
    if(isset($_POST['fullname'])) {
        $query = "UPDATE about_me SET fullname=?, email=?, mobile=?, address=?, dob=?, resume=?, profile_pic=?, intro=? WHERE id=1";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            
            $isOK = true;

            if (isset($_FILES['profile_pic']) && count($_FILES) > 0 && $_FILES['profile_pic']['tmp_name'] != "") {
                $tempFile = $_FILES['profile_pic']['tmp_name'];
                $targetFile =  'uploads/'.  strtotime("now"). '_'. $_FILES['profile_pic']['name'];
                $isOK = move_uploaded_file($tempFile,$targetFile);
                if ($isOK == true) {
                    $filename = mysqli_query($con, "SELECT profile_pic FROM about_me WHERE id=1") -> fetch_assoc()['profile_pic'];
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }
            }else {
                $targetFile = str_replace("uploads/", "", $_POST['hidden_profile_pic']);
                $targetFile = "uploads/".$targetFile;
            }
            
            if ($isOK == true) {
                $resume_path = str_replace("uploads/", "", $_POST['hidden_resume']);
                $resume_path = "uploads/".$resume_path;

                $date = str_replace('/', '-', $_POST['dob']);
                $dob = date("Y-m-d", strtotime($date));
                
                mysqli_stmt_bind_param($stmt, "ssssssss", 
                    $_POST['fullname'], 
                    $_POST['email'],
                    $_POST['mobile'],
                    $_POST['address'],
                    $dob,
                    $resume_path, 
                    $targetFile, 
                    $_POST['intro']
                );

                if (mysqli_stmt_execute($stmt)){
                    show_success_alert('Changes Saved.');
                }else {
                    show_alert('Something went wrong. Please try again.');
                    debug_to_console(mysql_error($con));
                }
            } else {
                show_alert('Something went wrong. Please try again.');
            }

            
        }
    }

    // FILL DATA
    $select_query = "SELECT * FROM about_me WHERE id=1";
    $result = $con -> query($select_query);

    $about_me = array("fullname"=>"", "email"=>"", "mobile"=>"", "address"=>"", "dob"=>"", "resume"=>"", "profile_pic"=>"", "intro"=>"");
    if ($result) {
        if ($result -> num_rows > 0) {
            $about_me = $result->fetch_assoc();
            debug_to_console($about_me);
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
                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="POST" action="about_me.php" id="submit_about_me_form" enctype="multipart/form-data">
                                    <h4 class="form-header text-uppercase">About me</h4>
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <img src="<?php echo $about_me['profile_pic'] ?>" id="profile_pic_preview" class="rounded-circle shadow img-fluid" style="width: 110px; height: 110px;"> <br />
                                            <label for="profile_pic" class="my-3">
                                                <span class="btn btn-primary">Change</span>
                                            </label>
                                            <input type="file" id="profile_pic" name="profile_pic" accept="image/*" onchange="showPreview(this);" style="visibility: hidden; position: absolute;" class="form-control"><br>
                                            <input type="hidden" value="<?php echo $about_me['profile_pic'] ?>" name="hidden_profile_pic" id="hidden_profile_pic">
                                            <input type="hidden" value="<?php echo $about_me['resume'] ?>" name="hidden_resume" id="hidden_resume">
                                            <div class="dropzone my-3" id="dropzone" style="min-height: 100px;">
                                                <div class="dz-default dz-message my-0"><span>Upload Resume</span></div>
                                                <div class="fallback">
                                                    <input name="back_image" type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="fullname">Name</label>
                                                <input type="text" value="<?php echo $about_me['fullname'] ?>" name="fullname" class="form-control" placeholder="Enter name">
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="email">Email</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                                            </div>
                                                            <input type="text" name="email" value="<?php echo $about_me['email']; ?>" class="form-control" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="email">Mobile Number</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                            </div>
                                                            <input type="text" name="mobile" value="<?php echo $about_me['mobile']; ?>" class="form-control" placeholder="Mobile Number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="email">Birthday</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <input type="text" name="dob" value="<?php echo date_format(date_create($about_me['dob']),"d/m/Y"); ?>" id="autoclose-datepicker" onkeydown="return false" class="form-control" autocomplete="off" placeholder="Birthday">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="email">Location</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                                            </div>
                                                            <input type="text" name="address" value="<?php echo $about_me['address'] ?>" class="form-control" placeholder="Location">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="intro">Intro</label>
                                                <textarea name="intro" id="intro" rows="3" class="form-control" placeholder="Intro"><?php echo $about_me['intro']; ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="submit" id="dropzoneSubmit" class="btn btn-light btn-lg px-5">Save</button>
                                            </div>
                                        </div>
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
    <!-- Dropzone JS  -->
    <script src="assets/plugins/dropzone/js/dropzone.js"></script>
    <!--Bootstrap Datepicker Js-->
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#autoclose-datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });

        var file = document.getElementById("profile_pic");
        file.addEventListener("change", function(){ 
            // work with file (this) object 
        });

        function showPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile_pic_preview')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
                //$("#hidden_profile_pic").val(input.files[0]["name"]);
            }
        }
    </script>

    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            var myDropzone = new Dropzone("#dropzone", {
                url: "./include/file_upload.php",
                paramName: "file",
                autoProcessQueue: false,
                maxFiles: 1,
                maxFilesize: 2,
                uploadMultiple: true,
                acceptedFiles: ".pdf, .doc, .docx",
                addRemoveLinks: true,
                dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
                dictInvalidFileType: "Invalid File Type",
                dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed"
            });
        });

        Dropzone.options.dropzone = {
            init: function() {
                var myDropzone = this;

                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });

                $("#dropzoneSubmit").on("click", function(e) {
                    if (myDropzone.files != "") {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log("Form submitting with dropzone file.");
                        myDropzone.processQueue();
                    } else {
                        console.log("Form submitting without dropzone file.");
                        $("#submit_about_me_form").submit();
                    }
                });

                // on add file
                this.on("addedfile", function(file) {
                    console.log(file);
                });

                // on error
                this.on("error", function(file, response) {
                    showAlert('Something went wrong.\nError: ' + response);
                });

                this.on("success", function(file, response) {
                    // console.log("File Uploaded successfully");
                    $("#hidden_resume").val(file['name']);
                    $("#submit_about_me_form").submit();
                    $('#dropzoneSubmit').click();
                });

            }
        };
    </script>

</body>
</html>
