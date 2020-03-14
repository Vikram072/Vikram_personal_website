<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Testimonial</title>
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
        .upload-image {
            border: 2px dashed rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
    </style>
</head>
 
<body class="bg-theme bg-theme1">
<?php
    require_once("include/config.php");
    // New Testimonial
    if(isset($_POST['add_testimonial'])) {
        $tempFile = $_FILES['pic']['tmp_name'];
        $targetFile =  'uploads/'. strtotime("now"). '_' .$_FILES['pic']['name'];
        if (move_uploaded_file($tempFile,$targetFile)) {
            $query = "INSERT INTO testimonials SET name=?, designation=?, quote=?, image=?";
            $stmt = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt, $query)) {
                show_alert('Something went wrong. Please try again.');
            }else{
                mysqli_stmt_bind_param($stmt, "ssss", $_POST['name'], $_POST['designation'], $_POST['quote'], $targetFile);

                if (mysqli_stmt_execute($stmt)){
                    show_success_alert('Testimonial successfully added.');
                }else {
                    show_alert('Something went wrong. Please try again.');
                    debug_to_console(mysqli_error($con));
                }
            }
        }
    }

    //UPDATE TESTIMONIAL
    if(isset($_POST['update_testimonial'])) {
        $update_query = "UPDATE testimonials SET name=?, designation=?, quote=?, image=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $isOK = true;
            if (isset($_FILES['pic']) && count($_FILES) > 0 && $_FILES['pic']['tmp_name'] != "") {
                $filename = mysqli_query($con, "SELECT image FROM testimonials WHERE id=". $_POST['edit_id']) -> fetch_assoc()['image'];
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $update_TempFile = $_FILES['pic']['tmp_name'];
                $update_TargetFile =  'uploads/'. strtotime("now"). '_' . $_FILES['pic']['name'];
                $isOK =  move_uploaded_file($update_TempFile,$update_TargetFile);
            }else {
                $update_TargetFile = str_replace("uploads/", "", $_POST['hidden_pic']);
                $update_TargetFile = "uploads/".$update_TargetFile;
            }
            if ($isOK == true) {
                mysqli_stmt_bind_param($update_stmt, "ssssi", $_POST['name'], $_POST['designation'], $_POST['quote'], $update_TargetFile, $_POST['edit_id']);
                if (mysqli_stmt_execute($update_stmt)){
                    show_success_alert('Testimonial details successfully updated.');
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
        $set_query = "SELECT * FROM testimonials WHERE id=?";
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
                    header("Location: testimonial.php#");
                    exit();
                }
            }
        }
    }    

    //Delete Record
    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM testimonials WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Testimonial successfully deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    // FILL PORTFOLIO DATA
    $all_data_query = "SELECT * FROM testimonials ORDER BY created_at DESC";
    $test_result = $con -> query($all_data_query);

    if (!$test_result) 
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
                                <h4 class="card-title text-uppercase">Testimonials</h4>
                                <div class="table-responsive" data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="text-center">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Quote</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if ($test_result -> num_rows > 0) {
                                                $sr = 1;
                                                while ($testimonial = $test_result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?php echo $sr++; ?></th>
                                                <td class="align-middle text-center">
                                                    <img src="<?php echo $testimonial['image']; ?>" alt="" class="img-fluid rounded-circle" style="max-height: 70px; max-width: 70px">
                                                </td>
                                                <td class="align-middle"><?php echo $testimonial['name']; ?></td>
                                                <td class="align-middle"><?php echo $testimonial['designation']; ?></td>
                                                <td class="align-middle" style="white-space: normal; width: 45%">
                                                    <input type="hidden" id="hidden_quote<?php echo $sr; ?>" value="<?php echo $testimonial['quote']; ?>">
                                                    <?php 
                                                        $txt = $testimonial['quote'];
                                                        $btn_read_more = "<a href='#btn_read_more' onclick='setupReadMoreData(\"". $testimonial['name']. "\", $sr)' class='text-info waves-effect waves-light my-1' data-toggle='modal'>More</a>";
                                                        echo ((strlen($txt) > 50) ? substr($txt, 0, 50)."...".$btn_read_more : $txt);
                                                     ?>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="testimonial.php?edit=<?php echo $testimonial['id']; ?>#edit_testimonial" class="btn btn-light waves-effect waves-light my-1"><i class="fa fa-pencil"></i></a>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo $testimonial['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }else {
                                            ?>
                                            <tr>
                                                <th scope="row" colspan="7" class="text-center py-3">Data Not Available</th>
                                            </tr>
                                            <?php } ?>
                                             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <span id="edit_testimonial" style="margin-top: -50px; padding-top: 50px;"></span>
                <span id="new_testimonial" style="margin-top: -50px; padding-top: 50px;"></span>

                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="post" action="testimonial.php" onsubmit="return validateForm(this)" enctype="multipart/form-data">
                                    <h4 class="form-header text-uppercase">
                                        <?php 
                                            if (isset($_GET['edit'])) {
                                                echo "Edit Testimonial";
                                            }else {
                                                echo "New Testimonial";
                                                $edit_data = array('name' => '', 'designation' => '', 'quote' => '', 'id' => '', 'image' => '');
                                            }
                                         ?>
                                    </h4> 
                                    <div class="row">
                                        <div class="col-md-3 text-center mb-4">
                                            <label for="">Image</label>
                                            <div action="#" class="upload-image mx-auto text-center" style="height: 100px; width: 100px;">
                                                <img src="<?php echo $edit_data['image'] ?>" id="pic_preview" class="rounded" style="height: 95px; width: 90px;" alt="">
                                                <span style="line-height: 95px;" id='image_placeholder'>Image</span>
                                            </div> <br>
                                            <label for="pic">
                                                <span class="btn btn-light">Choose Image</span>
                                            </label>
                                            <input type="file" id="pic" name="pic" accept="image/*" onchange="showPreview(this);" style="visibility: hidden; position: absolute;" class="form-control"><br>
                                            <input type="hidden" value="<?php echo $edit_data['image'] ?>" name="hidden_pic" id="hidden_pic">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" value="<?php echo $edit_data['name']; ?>" class="form-control" placeholder="Enter name">
                                            </div>

                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <input type="text" name="designation" value="<?php echo $edit_data['designation']; ?>" class="form-control" placeholder="Designation">
                                            </div>

                                            <div class="form-group">
                                                <label for="intro">Quote</label>
                                                <textarea name="quote" id="quote" rows="3" class="form-control" placeholder="Quote"><?php echo $edit_data['quote']; ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <?php 
                                                    if (isset($_GET['edit'])) {
                                                ?>
                                                    <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                                                    <button type="submit" name="update_testimonial" class="btn btn-light btn-lg px-5">Update</button>
                                                    <a href="testimonial.php#new_testimonial" class="btn btn-light btn-lg px-5">New</a>
                                                <?php
                                                    }else {
                                                ?>
                                                    <button type="submit" name="add_testimonial" class="btn btn-light btn-lg px-5">Add</button>
                                                <?php } ?>
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

    <!-- Read More -->
    <div class="modal animated animated swing" id="btn_read_more">
        <div class="modal-dialog">
            <div class="modal-content gradient-forest rounded border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id='read_more_title'></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="read_more_text" style="white-space: pre-wrap;">
                    </p>
                </div>
            </div>
        </div>
    </div>
  

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
                    window.location = "testimonial.php?del=" + id;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 

        function setupReadMoreData(name, id) {
            $('#read_more_title').text(name);
            let quote = $('#hidden_quote'+id).val();
            $('#read_more_text').text(quote);
        }

        function showPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pic_preview')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
                $('#image_placeholder').attr('class', 'sr-only');
                $("#hidden_pic").val(input.files[0]["name"]);
            }
        }

        $(document).ready(function() {
            if ($('#pic_preview').attr('src') != 0) {
                $('#image_placeholder').attr('class', 'sr-only');
            }
        });

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

</body>
</html>
