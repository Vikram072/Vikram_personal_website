<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Clients</title>
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
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>
    <style>
        .dropzone .dz-preview .dz-image {
            width: 80px; 
            height: 80px;
        }

        .dropzone .dz-preview{
            margin: 0px;
        }

        .dropzone {
            padding: 10px 20px;
        }
    
    </style>
 
</head>

<body class="bg-theme bg-theme1">
<?php
    require_once("include/config.php");
    // New Client
    if(isset($_POST['client_name'])) {
        $query = "INSERT INTO clients SET title=?, image=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $imagePath = str_replace("uploads/", "", $_POST['client_image']);
            $imagePath = preg_replace('/\s+/', "", "uploads/".$imagePath);

            mysqli_stmt_bind_param($stmt, "ss", $_POST['client_name'], $imagePath);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Client successfully added.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    //UPDATE CLIENT
    if(isset($_POST['update_client'])) {
        $update_query = "UPDATE clients SET title=?, image=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $isOK = true;
            if (isset($_FILES['edit_client_image']) && count($_FILES) > 0 && $_FILES['edit_client_image']['tmp_name'] != "") {
                $update_TempFile = $_FILES['edit_client_image']['tmp_name'];
                $update_TargetFile =  'uploads/'. strtotime("now") .'_'.$_FILES['edit_client_image']['name'];
                $isOK =  move_uploaded_file($update_TempFile,$update_TargetFile);
                if ($isOK == true) {
                    $filename = mysqli_query($con, "SELECT image FROM clients WHERE id=".$_POST['edit_client_id']) -> fetch_assoc()['image'];
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                }
            }else {
                $update_TargetFile = str_replace("uploads/", "", $_POST['hidden_client_image']);
                $update_TargetFile = preg_replace('/\s+/', "", "uploads/".$update_TargetFile);
            }
            if ($isOK == true) {
                mysqli_stmt_bind_param($update_stmt, "ssi", $_POST['edit_name'], $update_TargetFile, $_POST['edit_client_id']);
                if (mysqli_stmt_execute($update_stmt)){
                    show_success_alert('Client details successfully updated.');
                }else {
                    show_alert('Something went wrong. Please try again.');
                    debug_to_console(mysqli_error($con));
                }
            }else {
                show_alert('Something went wrong. Please try again.');
            }
            
        }
    }    

    //Delete Record
    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM clients WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Client successfully deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    // FILL CLIENTS DATA
    $all_data_query = "SELECT * FROM clients ORDER BY created_at DESC";
    $client_result = $con -> query($all_data_query);

    if (!$client_result) 
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

                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <h4 class="card-title text-uppercase">Clients</h4>
                                <div class="table-responsive"  data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th> 
                                                <th scope="col">Image</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if ($client_result -> num_rows > 0) {
                                            $sr = 1;
                                            while ($client = $client_result -> fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?php echo $sr++; ?></th>
                                                <td class="align-middle">
                                                    <img src="<?php echo $client['image']; ?>" class="img-fluid rounded" alt="" style="max-height: 60px;">
                                                </td>
                                                <td class="align-middle"><?php echo $client['title']; ?></td>
                                                <td class="align-middle">
                                                    <button type="button" onclick='setEditableData(<?php echo "$client[id], \"$client[title]\", \"$client[image]\""; ?>)' class="btn btn-light waves-effect waves-light my-1" data-toggle="modal" data-target="#editSkill"><i class="fa fa-pencil"></i></button>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo $client['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                                }
                                            }else {
                                            ?>
                                            <tr>
                                                <th scope="row" colspan="5" class="text-center py-3">Data Not Available</th>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <h4 class="card-title text-uppercase">New Client</h4>
                                <form action="clients.php" method="post" id="add_client_form">
                                    <div class="form-group">
                                        <label for="client_name">Name</label>
                                        <input type="text" name="client_name" class="form-control" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <div action="#" class="dropzone" id="dropzone" style="height: 120px; min-height: 100px;">
                                            <div class="dz-default dz-message my-0" style="font-size: 20px;"><span>Upload Image</span></div>
                                            <div class="fallback">
                                                <input type="file">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="client_image" id="client_image">
                                        <button type="submit" name="btn_add_client" id="dropzoneSubmit" class="btn btn-light px-5">Save</button>
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

    <!-- Edit Client -->
    <div class="modal animated bounceIn" id="editSkill">
        <div class="modal-dialog">
            <div class="modal-content gradient-forest rounded border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_client_header_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="clients.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="edit_client_name">Name</label>
                            <input type="text" name="edit_name" id="edit_client_name" class="form-control" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="edit_client_image">
                                        <span class="btn btn-light">Change Image</span>
                                    </label>
                                    <input type="file" id="edit_client_image" name="edit_client_image" accept="image/*" onchange="showPreview(this);" style="visibility: hidden; position: absolute;" class="form-control"><br>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="hidden_client_image" name="hidden_client_image">
                                    <img src="" id="edit_client_preview_image" class="img-fluid rounded" style="max-height: 80px;">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="edit_client_id" id="edit_client_id">
                            <button type="submit" name="update_client" class="btn btn-light px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  

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
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>

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
                    window.location = "clients.php?del=" + id;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 

        function setEditableData(id, title, image) {
            $('#edit_client_header_title').text(title);
            $('#edit_client_id').val(id);
            $('#edit_client_name').val(title);
            $('#hidden_client_image').val(image);
            $('#edit_client_preview_image').attr('src', image);
        }

        function showPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_client_preview_image')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
                $("#hidden_client_image").val(input.files[0]["name"]);
            }
        }

         function validateForm(form) {

            if (form.name.value.length == 0) {
                showAlert('Please enter name');
                return false;
            }else if (form.designation.value.length == 0) {
                showAlert('Please enter designation');
                return false;
            }else if (form.quote.value.length == 0) {
                showAlert('Please enter quote');
                return false;
            }else if (form.hidden_pic.value.length == 0) {
                showAlert('Please choose image');
                return false;
            }else {
                return true;
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
                acceptedFiles: ".png, .jpg, .jpeg",
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
                        $("#add_client_form").submit();
                    }
                });
                // on error
                this.on("error", function(file, response) {
                    showAlert('Something went wrong.\nError: ' + response);
                });

                this.on("success", function(file, response) {
                    console.log("File Uploaded successfukll");
                    $("#client_image").val(response);
                    $("#add_client_form").submit();
                });
            }
        };

    </script>

</body>
</html>
