<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Introduction</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Dropzone css -->
    <link href="assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
    <!-- Dropzone JS  -->
    <script src="assets/plugins/dropzone/js/dropzone.js"></script>
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
    if(isset($_POST['page_heading'])) {
        $query = "UPDATE intro SET heading=?, description=?, bg_image=? WHERE id=1";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $target_file_path = str_replace("uploads/", "", $_POST['filename']);
            $target_file_path = preg_replace('/\s+/', "", "uploads/".$target_file_path);

           // $bg_filename = mysqli_query($con, "SELECT bg_image FROM intro WHERE id=1") -> fetch_assoc()['bg_image'];
            //if (file_exists($bg_filename)) {
            ///    unlink($bg_filename);
            //}

            mysqli_stmt_bind_param($stmt, "sss", $_POST['page_heading'], $_POST['description'], $target_file_path);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Changes Saved.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }

    // FILL DATA
    $select_query = "SELECT heading, description, bg_image FROM intro WHERE id=1";
    $result = $con -> query($select_query);
    $intro = array("page_heading"=>"", "description"=>"", "bg_image"=>"");
    if ($result) {
        if ($result -> num_rows > 0) {
            $intro = $result->fetch_assoc();
            debug_to_console($intro);
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
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="POST" action="intro.php" id="intro_update_form" enctype="multipart/form-data">
                                    <h4 class="form-header text-uppercase">Introduction</h4>
                                    <div class="form-group">
                                        <label for="page_heading">Heading</label>
                                        <input type="text" name="page_heading" value="<?php echo $intro['heading']; ?>" class="form-control" id="page_heading" placeholder="Page Heading">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" rows="4" placeholder="Description"><?php echo $intro['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="desg">Background Image</label><br>
                                        <?php 
                                            if ($intro['bg_image']) {
                                        ?>
                                            <img src="<?php echo $intro['bg_image']; ?>" id="preview" class="rounded shadow img-fluid" style="max-height: 240px;" alt="">
                                        <?php
                                            }
                                        ?>
                                        <input type="hidden" name="filename" id="filename" value="<?php echo $intro['bg_image']; ?>">
                                        <div class="dropzone my-4" id="dropzone" style="min-height: 100px;">
                                            <div class="dz-default dz-message my-1" style="font-size: 15px;">
                                                <span>Change image.<br>Drop image here to upload</span>
                                            </div>
                                            <div class="fallback">
                                                <input name="back_image" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn_save" id="dropzoneSubmit" class="btn btn-light btn-lg px-5"><i class="zmdi ti-save"></i> Save</button>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>

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
                acceptedFiles: "image/*",
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
                    e.preventDefault();
                    e.stopPropagation();
                    if (myDropzone.files != "") {
                        myDropzone.processQueue();
                    } else {
                        console.log("Form submitting without dropzone file.");
                        $("#intro_update_form").submit();
                    }
                });

                // on add file
                this.on("addedfile", function(file) {
                    console.log(file);
                });

                // on error
                this.on("error", function(file, response) {
                    showAlert('Something went wrong. Please try again.\nError: ' + response);
                });

                this.on("success", function(file, response) {
                    $("#filename").val(response);
                    $("#intro_update_form").submit();
                });

            }
        };
    </script>

</body>
</html>
