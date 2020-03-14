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
    <!-- Sidebar CSS-->
    <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <!-- Note Editor -->
    <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote-bs4.css"/>
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>
    <style>
        .note-editor.note-frame.fullscreen .note-editable {
            background-color: #607D8B;
        }
        .note-editor.fullscreen .card-header {
            background-color: #1a1a1a;
        }
        .note-editor .modal .modal-content {
            background: linear-gradient(45deg, #000428, #004e92)!important;
            border-radius: .25rem !important;
            border: 0 !important;
        }
        .note-popover .popover-content {
            background: #2f4f4f;
        }
        .note-editor .modal .modal-content .note-group-image-url {
            overflow: inherit !important;
        }
        .note-editor .modal .modal-content .custom-control.custom-checkbox {
            padding-left: 0px;
        }
        .note-editor .modal .modal-content .custom-control.custom-checkbox .custom-control-input {
            position: initial; 
            opacity: 1; 
        }
    </style>
 
</head>

<body class="bg-theme bg-theme1">
<?php
    require_once("include/config.php");
    // New Service
    if(isset($_POST['add_portfolio'])) {
        $query = "INSERT INTO portfolio SET title=?, category=?, cover_image=?, description=?, user_id=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{

            $tempFile = $_FILES['portfolio_cover_image']['tmp_name'];
            $targetFile =  'uploads/'. strtotime("now"). '_' .$_FILES['portfolio_cover_image']['name'];
            if (move_uploaded_file($tempFile,$targetFile)) {
                 mysqli_stmt_bind_param($stmt, "ssssi", $_POST['portfolio_title'], $_POST['portfolio_category'], $targetFile, $_POST['portfolio_description'], $_SESSION['user_id']);

                if (mysqli_stmt_execute($stmt)){
                    show_success_alert('Portfolio successfully added.');
                }else {
                    show_alert('Something went wrong. Please try again.');
                    debug_to_console(mysqli_error($con));
                }
            }else {
                show_alert('Something went wrong. Please try again.');
            }
        }
    }

    //UPDATE PORTFOLIO
    if(isset($_POST['update_portfolio'])) {
        $update_query = "UPDATE portfolio SET title=?, category=?, cover_image=?, description=?, user_id=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $isOK = true;
            if (isset($_FILES['portfolio_cover_image']) && count($_FILES) > 0 && $_FILES['portfolio_cover_image']['tmp_name'] != "") {
                $filename = mysqli_query($con, "SELECT cover_image FROM portfolio WHERE id=". $_POST['edit_id']) -> fetch_assoc()['cover_image'];
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $update_TempFile = $_FILES['portfolio_cover_image']['tmp_name'];
                $update_TargetFile =  'uploads/'. strtotime("now"). '_' . $_FILES['portfolio_cover_image']['name'];
                $isOK =  move_uploaded_file($update_TempFile,$update_TargetFile);
            }else {
                $update_TargetFile = str_replace("uploads/", "", $_POST['hidden_cover_image']);
                $update_TargetFile = "uploads/".$update_TargetFile;
            }
            if ($isOK == true) {
                mysqli_stmt_bind_param($update_stmt, "ssssii", $_POST['portfolio_title'], $_POST['portfolio_category'], $update_TargetFile, $_POST['portfolio_description'], $_SESSION['user_id'], $_POST['edit_id']);
                if (mysqli_stmt_execute($update_stmt)){
                    show_success_alert('Portfolio details successfull updated.');
                }else {
                    show_alert('Something went wrong. Please try again.');
                    debug_to_console(mysqli_error($con));
                }
            }else {
                show_alert('Something went wrong. Please try again.');
            }
        }
    }

    //SET EDITABLE DATA
    if(isset($_GET['edit']) && $_GET['edit'] != "") {
        $set_query = "SELECT * FROM portfolio WHERE id=?";
        $set_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($set_stmt, $set_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($set_stmt, "i", $_GET['edit']);

            if (mysqli_stmt_execute($set_stmt)){
                $set_res = mysqli_stmt_get_result($set_stmt);

                if ($set_res -> num_rows > 0) {
                    $edit_data = $set_res->fetch_assoc();
                }else {
                    header("Location: portfolio.php#");
                    exit();
                }
            }
        }
    }    

    //Delete Record
    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM portfolio WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Portfolio successfully deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    // FILL PORTFOLIO DATA
    $all_data_query = "SELECT * FROM portfolio ORDER BY created_at DESC";
    $port_result = $con -> query($all_data_query);

    if (!$port_result) 
        debug_to_console($con -> error);
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
                                <h4 class="card-title text-uppercase">Portfolio</h4>
                                <div class="table-responsive" data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if ($port_result -> num_rows > 0) {
                                                $sr = 1;
                                                while ($portfolio = $port_result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?php echo $sr++; ?></th>
                                                <td class="align-middle"><?php echo $portfolio['title']; ?></td>
                                                <td class="align-middle">
                                                    <a href="portfolio_details.php?id=<?php echo $portfolio['id']; ?>" target="_blank" class="btn btn-light btn-sm"><i class="fa fa-eye fa-2x"></i></a>
                                                </td>
                                                <td class="align-middle"><?php echo $portfolio['category']; ?></td>
                                                <td>
                                                    <a href="portfolio.php?edit=<?php echo $portfolio['id']; ?>#edit_portfolio" class="btn btn-light waves-effect waves-light my-1"><i class="fa fa-pencil"></i></a>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo $portfolio['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }else {
                                            ?>
                                            <tr>
                                                <th scope="row" colspan="6" class="text-center py-3">Data Not Available</th>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <span id="new_portfolio" style="margin-top: -50px; padding-top: 50px;"></span>
                            <span id="edit_portfolio" style="margin-top: -50px; padding-top: 50px;"></span>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="post" action="portfolio.php" enctype="multipart/form-data">
                                    <h4 class="form-header text-uppercase">
                                        <?php 
                                            if (isset($_GET['edit'])) {
                                                echo "Edit Portfolio";
                                            }else {
                                                echo "New Portfolio";
                                                $edit_data = array('title' => '', 'category' => '', 'description' => '', 'id' => '', "cover_image" => '');
                                            }
                                         ?>
                                    </h4>
                                    <div class="form-group">
                                        <label for="portfolio_title">Title</label>
                                        <input type="text" required name="portfolio_title" value="<?php echo $edit_data['title']; ?>" class="form-control" placeholder="Portfolio Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="portfolio_category">Category</label>
                                        <input type="text" required name="portfolio_category" value="<?php echo $edit_data['category']; ?>" class="form-control" title="If category is not exist new category created." placeholder="Portfolio Category">
                                    </div>

                                    <div class="form-group">
                                        <label for="portfolio_cover_image">Cover Image</label>
                                        <input type="hidden" name="hidden_cover_image" value="<?php echo $edit_data['cover_image']; ?>">
                                        <input type="file" <?php if ($edit_data['cover_image'] == "") { echo 'required';} ?> name="portfolio_cover_image" class="form-control" placeholder="Cover Image">
                                    </div>

                                    <div class="card">
                                        <div class="card-header text-uppercase">Description</div>
                                        <div class="card-body pb-0">
                                            <textarea name="portfolio_description" id="summernoteEditor"><?php echo $edit_data['description']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php 
                                            if (isset($_GET['edit'])) {
                                        ?>
                                            <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                                            <button type="submit" name="update_portfolio" class="btn btn-light btn-lg px-5">Update</button>
                                            <a href="portfolio.php#new_portfolio" class="btn btn-light btn-lg px-5">New</a>
                                        <?php
                                            }else {
                                        ?>
                                            <button type="submit" name="add_portfolio" class="btn btn-light btn-lg px-5">Add</button>
                                        <?php } ?>
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

    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>

    <script src="assets/plugins/summernote/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernoteEditor').summernote({
                height: 400,
                tabsize: 2,
                dialogsFade: true,
                callbacks: {
                    onImageUpload: function(files) {
                        sendFile(files[0]);
                    }
                }
            });

            function sendFile(file) {
                data = new FormData();
                data.append("p_upload_image", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "./include/file_upload.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('#summernoteEditor').summernote('insertImage', url)
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        showAlert("Status: " + textStatus + "\nError: " + errorThrown);
                    } 
                });
            }
        })
    </script>

    <script>

        function confirmDelete(id) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                className: "gradient-forest"
            }) 
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "portfolio.php?del=" + id;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 
    </script>

</body>
</html>
