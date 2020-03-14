<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>My Skill</title>
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
    <!--Ion Range Slider-->
    <link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" type="text/css"/>
 
</head>

<body class="bg-theme bg-theme1">
<?php
    require_once("include/config.php");
    // Update Skill Intro
    if(isset($_POST['intro_update'])) {
        $query = "UPDATE matter SET description=? WHERE id=1";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($stmt, "s", $_POST['intro']);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('Changes Saved.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }

    // New Skill
    if(isset($_POST['add_new_skill'])) {
        $query = "INSERT INTO skills SET title=?, percentage=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($stmt, "ss", $_POST['skill_title'], $_POST['skill_perc']);

            if (mysqli_stmt_execute($stmt)){
                show_success_alert('New skill successfull added.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }

    //UPDATE SKILL
    if(isset($_POST['update_skill'])) {
        $update_query = "UPDATE skills SET title=?, percentage=? WHERE id=?";
        $update_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($update_stmt, $update_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($update_stmt, "sii", $_POST['edit_title'], $_POST['edit_perc'], $_POST['edit_skill_id']);

            if (mysqli_stmt_execute($update_stmt)){
                show_success_alert('Skill details successfull updated.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }    

    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM skills WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Skill details successfull deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysql_error($con));
            }
        }
    }

    // FILL INTRO DATA
    $select_query = "SELECT description FROM matter WHERE id=1";
    $result = $con -> query($select_query);
    $intro = array("description"=>"");
    if ($result) {
        if ($result -> num_rows > 0) {
            $intro = $result->fetch_assoc();
        }
    }else {
        debug_to_console($con -> error);
    } 

    // FILL SKILLS DATA
    $all_data_query = "SELECT * FROM skills ORDER BY created_at DESC";
    $skills_result = $con -> query($all_data_query);

    if (!$skills_result) 
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
                <!-- SKILL INTRO -->
                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="post">
                                    <h4 class="form-header text-uppercase">My Skills</h4>
                                    <div class="form-group">
                                        <label for="intro">Intro Text</label>
                                        <textarea name="intro" id="intro" rows="3" class="form-control" placeholder="Intro"><?php echo $intro['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="intro_update" class="btn btn-light btn-lg px-5">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NEW SKILL -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <form method="post" name="new_skill_form">
                                    <h4 class="form-header text-uppercase">New Skills</h4>
                                    <div class="form-group">
                                        <label for="skill_name">Title</label>
                                        <input type="text" name="skill_title" class="form-control" placeholder="Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="skill_perc">Percentage</label>
                                        <input type="text" id="skill_perc" data-min="0" data-from="50" name="skill_perc" />
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="add_new_skill" class="btn btn-light btn-lg px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                <span id="my_skills" style="margin-top: -50px; padding-top: 50px;"></span>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <h4 class="card-title text-uppercase">My Skills</h4>
                                <div class="table-responsive" data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Progress</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if ($skills_result -> num_rows > 0) {
                                                $sr = 1;
                                                while ($skill = $skills_result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row" class="align-middle"><?php echo $sr++; ?></th>
                                                <td class="align-middle"><?php echo $skill['title']; ?></td>
                                                <td class="align-middle">
                                                    <div class="progress-wrapper">
                                                        <div class="progress" style="height:5px;">
                                                            <div class="progress-bar" style="width:<?php echo $skill['percentage']; ?>%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-light waves-effect waves-light my-1" onclick="setEditableData(<?php echo $skill['id']. ", '". $skill['title'], "', ". $skill['percentage']; ?>)" data-toggle="modal" data-target="#editSkill"><i class="fa fa-pencil"></i></button>
                                                </td>
                                                <td>
                                                    <form action="" method="post" name="delete_record_form">
                                                        <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo "'".$skill['title'], "', ". $skill['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                    </form>
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

    <div class="modal animated bounceIn" id="editSkill">
        <div class="modal-dialog">
            <div class="modal-content gradient-forest rounded border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_skill_header_title">Unknown</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="my_skill.php">
                        <input type="hidden" name="edit_skill_id" id="edit_skill_id">
                        <div class="form-group">
                            <label for="edit_skill_title">Title</label>
                            <input type="text" name="edit_title" class="form-control" id="edit_skill_title" placeholder="Title">
                        </div> 

                        <div class="form-group">
                            <label for="edit_skill_perc">Percentage</label>
                            <input type="text" id="edit_skill_perc" value="" name="edit_perc" />
                        </div>

                        <div class="form-group">
                            <button type="submit" name="update_skill" class="btn btn-light px-5"> Update</button>
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

    <!--Ion range Slider-->
    <script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <!--Sweet Alerts -->
    <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>

    <script>
        $(function () {
            $("#skill_perc").ionRangeSlider({
                min: 0
            });
        })

        $(function () {
            $("#edit_skill_perc").ionRangeSlider({
                min: 0
            });
        });

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
                    window.location = "my_skill.php?del=" + id + "#my_skills";
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 

        function setEditableData(id, title, percentage) {
            $("#edit_skill_id").val(id);
            $("#edit_skill_title").val(title);
            $("#edit_skill_header_title").text(title);
            console.log(percentage);
            $("#edit_skill_perc").val(percentage);
            let slider = $("#edit_skill_perc").data("ionRangeSlider");
            
            slider.update({
                from: percentage
            })

        }
    </script>

</body>
</html>
