<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Experience</title>
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
    <!-- vertical timeline CSS-->
    <link href="assets/plugins/vertical-timeline/css/vertical-timeline.css" rel="stylesheet"/>
    <!--Bootstrap Datepicker-->
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>

</head>

<body class="bg-theme bg-theme1">
<?php
    require_once("include/config.php");

    // Add experience
    if(isset($_POST['add_exp'])) {
        $query = "INSERT INTO experiences SET title=?, start_date=?, end_date=?, description=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            $tmp_start_date = str_replace('/', '-', $_POST['start_date']);
            $tmp_start_date = '01-'.date("m-Y", strtotime($tmp_start_date));
            $db_start_date = date_format(date_create($tmp_start_date),"Y-m-d");
            
            if (isset($_POST['end_date'])) {
                $tmp_end_date = str_replace('/', '-', $_POST['end_date']);
                $tmp_end_date = '01-'.date("m-Y", strtotime($tmp_end_date));
                $db_end_date = date_format(date_create($tmp_end_date),"Y-m-d");
            }else {
                $db_end_date = date('Y-m-d');
            }

            mysqli_stmt_bind_param($stmt, "ssss", $_POST['exp_title'], $db_start_date, $db_end_date, $_POST['exp_desc']);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Experience successfully added.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    //UPDATE Experience
    if (isset($_POST['update_record'])) {
        $id = $_POST["hidden_id"];
        $title = $_POST["edit_title".$id];
        $edit_desc = $_POST["edit_desc".$id];

        $tmp_edit_start_date = str_replace('/', '-', $_POST["edit_start_date".$id]);
        $tmp_edit_start_date = '01-'.date("m-Y", strtotime($tmp_edit_start_date));
        $db_edit_start_date = date_format(date_create($tmp_edit_start_date),"Y-m-d");
        
        if (isset($_POST["edit_end_date".$id])) {
            $tmp_edit_end_date = str_replace('/', '-', $_POST["edit_end_date".$id]);
            $tmp_edit_end_date = '01-'.date("m-Y", strtotime($tmp_edit_end_date));
            $db_edit_end_date = date_format(date_create($tmp_edit_end_date),"Y-m-d");
        }else {
            $db_edit_end_date = date('Y-m-d');
        }

        $update_query = "UPDATE experiences SET title=?, start_date=?, end_date=?, description=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($update_stmt, "ssssi", $title, $db_edit_start_date, $db_edit_end_date, $edit_desc, $id);

            if (mysqli_stmt_execute($update_stmt)){
                show_success_alert('Experience details successfull updated.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM experiences WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Experience details successfull deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
    }

    // FILL EXPERIENCE DATA
    $all_data_query = "SELECT * FROM experiences ORDER BY created_at DESC";
    $exp_result = $con -> query($all_data_query);

    if (!$exp_result) 
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
                                <form method="POST">
                                    <h4 class="form-header text-uppercase">Add Experience</h4>
                                    <div class="form-group">
                                        <label for="exp_title">Title</label>
                                        <input type="text" name="exp_title" required="" class="form-control" placeholder="Experience Title">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="start_date">Start Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" name="start_date" required="" id="start_date" onkeydown="return false" class="form-control" autocomplete="off" placeholder="Start Date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="end_date">End Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" name="end_date" required="" id="end_date" onkeydown="return false" class="form-control" autocomplete="off" placeholder="End Date">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text py-0">
                                                            <div class="icheck-material-white">
                                                                <input type="checkbox" id="present_date">
                                                                <label for="present_date">Present</label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exp_desc">Description</label>
                                        <textarea name="exp_desc" rows="3" required="" class="form-control" placeholder="Description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="add_exp" class="btn btn-light btn-lg px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-lg-12">
                        <section class="cd-timeline js-cd-timeline">
                            <div class="cd-timeline__container">
                                <?php 
                                
                                if ($exp_result -> num_rows > 0) {
                                    $sr = 0;
                                    while ($experience = $exp_result->fetch_assoc()) {
                                        $sr++;
                                ?>

                                <div class="cd-timeline__block js-cd-block">
                                    <div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
                                        <h5 class="heading-text"></h5> 
                                        <!-- <img src="assets/images/timeline/cd-icon-picture.svg" alt="Picture"> -->
                                    </div> <!-- cd-timeline__img -->

                                    <form action="" method="POST" name="TestbyVikram">
                                        <input type="hidden" name="hidden_id" value="<?php echo $experience['id']; ?>"> <!-- FIXME: Store id -->
                                        <div class="cd-timeline__content js-cd-content">
                                            <div class="form-group">
                                                <span for="" class="control-label">
                                                    <h4 id="title<?php echo $sr; ?>" onclick="editTitle(this)"><?php echo $experience['title']; ?></h4>
                                                </span>
                                                <input type="text" name="edit_title<?php echo $experience['id']; ?>" required="" value="<?php echo $experience['title']; ?>" id="edit_title<?php echo $sr; ?>" onfocusout="titleEdited(this)" class="form-control" placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <span for="" class="control-label">
                                                    <p onclick="editDescription(this)" id="desc<?php echo $sr; ?>"><?php echo $experience['description']; ?></p>
                                                </span>
                                                <textarea name="edit_desc<?php echo $experience['id']; ?>" required="" id="edit_desc<?php echo $sr; ?>" class="form-control" rows="3" placeholder="Description" onfocusout="descriptionEdited(this)"><?php echo $experience['description']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Start Date</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                            <input type="text" name="edit_start_date<?php echo $experience['id']; ?>" value="<?php echo date_format(date_create($experience['start_date']),"M/Y"); ?>" required="" id="edit_start_date<?php echo $sr; ?>" onkeydown="return false" class="form-control" autocomplete="off" placeholder="Start Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">End Date</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                    <input type="text" name="edit_end_date<?php echo $experience['id']; ?>" value="<?php echo date_format(date_create($experience['end_date']),"M/Y"); ?>" required="" id="edit_end_date<?php echo $sr; ?>" onkeydown="return false" class="form-control" autocomplete="off" placeholder="End Date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <div class="icheck-material-white float-right">
                                                                    <input type="checkbox" id="edit_present_date<?php echo $sr; ?>" onclick="editPresentDate(this)">
                                                                    <label for="edit_present_date<?php echo $sr; ?>">Present</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button type="submit" name="update_record" class="btn float-left text-capitalize cd-timeline__read-more">Update</button>
                                                </div>
                                                <div class="col">
                                                    <a href="" onclick="confirmDelete(<?php echo $experience['id']; ?>)" class="btn float-right text-capitalize cd-timeline__read-more"><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </div>
                                            <span class="cd-timeline__date"><?php echo date_format(date_create($experience['start_date']),"M y"). ' - '. date_format(date_create($experience['end_date']),"M y"); ?></span>
                                        </div> <!-- cd-timeline__content -->
                                    </form>
                                </div> <!-- cd-timeline__block -->
                                <?php
                                    }
                                }else {
                                ?>
                                <div class="text-center">
                                    <style>
                                        .cd-timeline__container::before {
                                            width: 0px !important;
                                        }
                                    </style>
                                    <span class="h4 text-center py-3">Experince Data Not Available </span>
                                </div>
                                <?php } ?>
                                <!-- End time line content. Second item will be sit below. -->
                            </div>
                        </section> <!-- cd-timeline -->
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

    <!-- Vertical timeline js -->
    <script src="assets/plugins/vertical-timeline/js/vertical-timeline.js"></script>
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
    <!--Bootstrap Datepicker Js-->
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    
    <script>
        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "M/yyyy",
            startView: "months",
            minViewMode: "months"
        });
        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "M/yyyy",
            startView: "months",
            minViewMode: "months"
        });

        //Setting Present Date
        $("#present_date").click(function(){
            if ($(this).is(":checked")) {
                var date = new Date();
                $('#end_date').val(date.toLocaleString("en-us", {month: "short"}) + "/" + date.getFullYear());
                $('#end_date').prop('disabled', true);
            }else {
                $('#end_date').prop('disabled', false);
            }
        })

        //Edit Experience
        function setupTimeLine(elements) {
            var cnt = elements;
            for (var i = 1; i <= cnt; i++) {
                $("#edit_title" + i).hide();
                $("#edit_desc" + i).hide();

                $('#edit_start_date' + i).datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "M/yyyy",
                    startView: "months",
                    minViewMode: "months"
                });

                $('#edit_end_date' + i).datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "M/yyyy",
                    startView: "months",
                    minViewMode: "months"
                });
            }
        };


        //Setting Edit Present Date
        function editPresentDate(self) {
            var txt = $(self).attr("id").replace("edit_present_date", "#edit_end_date");
            if ($(self).is(":checked")) {
                var date = new Date();
                $(txt).val(date.toLocaleString("en-us", {month: "short"}) + "/" + date.getFullYear());
                $(txt).attr("disabled", "disabled");
            }else {
                $(txt).removeAttr("disabled");
            }
        }

        function editTitle(self) {
           $(self).hide();
           var txt = $(self).attr("id").replace("title", "#edit_title");
           $(txt).show().focus();
           $(txt).val($(self).text());
        }

        function titleEdited(self) {
            $(self).hide();
            var lbl = $(self).attr("id").replace("edit_", "#");
            $(lbl).show();
            $(lbl).text($(self).val());
        }

        function editDescription(self) {
           $(self).hide();
           var txt = $(self).attr("id").replace("desc", "#edit_desc");
           $(txt).show().focus();
           $(txt).val($(self).text());
        }

        function descriptionEdited(self) {
            $(self).hide();
            var lbl = $(self).attr("id").replace("edit_", "#");
            $(lbl).show();
            $(lbl).text($(self).val());
        }
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
                    window.location = "experience.php?del=" + id;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 
    </script>

    <?php 
        echo "<script> setupTimeLine(".$exp_result -> num_rows."); </script>";
    ?>

</body>
</html>
