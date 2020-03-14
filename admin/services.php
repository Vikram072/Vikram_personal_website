<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Services</title>
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
    // New Service
    if(isset($_POST['add_service'])) {
        $query = "INSERT INTO services SET title=?, description=?, icon=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($stmt, "sss", $_POST['service_name'], $_POST['service_desc'], $_POST['service_icon']);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Service added successful.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    //UPDATE SERVICE
    if(isset($_POST['update_service'])) {
        $update_query = "UPDATE services SET title=?, description=?, icon=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($update_stmt, "sssi", $_POST['edit_service_name'], $_POST['edit_service_desc'], $_POST['edit_service_icon'], $_POST['edit_service_id']);

            if (mysqli_stmt_execute($update_stmt)){
                show_success_alert('Service details successfully updated.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }    

    //Delete Record
    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM services WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Service details successfully deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    // FILL INTRO DATA
    $select_query = "SELECT * FROM services";
    $result = $con -> query($select_query);
    $services = array("title" => "", "description" => "", "icon"=> "", "id"=> "");
    if ($result) {
        if ($result -> num_rows > 0) {
            $services = $result->fetch_assoc();
        }
    }else {
        debug_to_console($con -> error);
    } 

    // FILL SERVICES DATA
    $all_data_query = "SELECT * FROM services ORDER BY created_at DESC";
    $services_result = $con -> query($all_data_query);

    if (!$services_result) 
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
                                <form action="services.php" method="post">
                                    <h4 class="form-header text-uppercase">New Service</h4>
                                    <div class="form-group">
                                        <label for="skill_name">Service Name</label>
                                        <input type="text" name="service_name" class="form-control" placeholder="Service Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="skill_name">Description</label>
                                        <textarea name="service_desc" rows="2" class="form-control" placeholder="Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="skill_name">Icon</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="service_icon" onkeyup="updateIcon(this.value)" class="form-control" placeholder="Service Icon">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-globe" id="service_icon"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="add_service" class="btn btn-light btn-lg px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <span id="services" style="margin-top: -50px; padding-top: 50px;"></span>
                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <h4 class="card-title text-uppercase">Services</h4>
                                <div class="table-responsive"  data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-hover" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th> 
                                                <th scope="col">Icon</th>
                                                <th scope="col">Service</th>
                                                <th scope="col"  width="10px">Description</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if ($services_result -> num_rows > 0) {
                                                $sr = 1;
                                                while ($service = $services_result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?php echo $sr++; ?></th>
                                                <td class="align-middle"><i class="<?php echo $service['icon']; ?>"></i></td>
                                                <td class="align-middle"><?php echo $service['title']; ?></td>
                                                <td class="align-middle" style="white-space: normal; width: 45%">
                                                    <?php 
                                                        $txt = $service['description'];
                                                        $id = $service['id'];
                                                        $title = $service['title'];
                                                        $btn_read_more = "<a href='#btn_read_more' onclick='readMore(\"". $service['title']. "\", \"". $service['description']. "\")' class='text-info waves-effect waves-light my-1' data-toggle='modal'>More</a>";
                                                        echo ((strlen($txt) > 50) ? substr($txt, 0, 50)."...".$btn_read_more : $txt);
                                                     ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-light waves-effect waves-light my-1" data-toggle="modal" onclick="setEditableData(<?php echo $service['id']. ", '". $service['title']. "', '". $service['description']. "', '". $service['icon'] ."'"; ?>)" data-target="#editSkill"><i class="fa fa-pencil"></i></button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo "'".$title, "', ". $id; ?>)"><i class="fa fa-trash-o"></i></a>
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
                    <h5 class="modal-title" id="read_more_title">Development</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="read_more_description">
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Service -->
    <div class="modal animated bounceIn" id="editSkill">
        <div class="modal-dialog">
            <div class="modal-content gradient-forest rounded border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_service_header_title">Development</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <input type="hidden" name="edit_service_id", id="edit_service_id">
                            <label for="edit_service_name">Service Name</label>
                            <input type="text" name="edit_service_name" id="edit_service_name" class="form-control" placeholder="Service Name">
                        </div>

                        <div class="form-group">
                            <label for="edit_service_desc">Description</label>
                            <textarea name="edit_service_desc", id="edit_service_desc" rows="2" class="form-control" placeholder="Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_service_icon">Icon</label>
                            <div class="input-group mb-3">
                                <input type="text" name="edit_service_icon" id="edit_icon" class="form-control" placeholder="Service Icon">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-globe" id="edit_service_icon"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="update_service" class="btn btn-light px-5"> Update</button>
                        </div>
                    </form>
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

    <!--Ion range Slider-->
    <script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>

    <script>

        function readMore(service, description) {
            $('#read_more_title').text(service);
            $('#read_more_description').text(description);
        }

        function updateIcon(input) {
            $('#service_icon').attr('class', input);
        }

        function updateIconWhenEdit(input) {
            $('#edit_service_icon').attr('class', input);
        }

        function setEditableData(id, service, description, icon) {
            $('#edit_service_header_title').text(service);
            $('#edit_service_id').val(id);
            $('#edit_service_name').val(service);
            $('#edit_service_desc').val(description);
            $('#edit_icon').val(icon);
            $('#edit_service_icon').attr('class', icon);
        }

        function confirmDelete(title, id) {
            event.preventDefault();
            swal({
                title: "Are you sure to delete " + title + "?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                className: "gradient-forest"
            }) 
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "services.php?del=" + id + "#services";
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 
    </script>

</body>
</html>
