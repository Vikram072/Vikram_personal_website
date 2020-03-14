<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Get in Touch</title>
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
    <link href="assets/css/app-style.css" rel="stylesheet"/> 
    <script src="assets/js/jquery.min.js"></script>
    <?php include('include/common_file.php') ?>
    
</head>

<body class="bg-theme bg-theme1">
<?php 
    require_once("include/config.php");
    //Delete Record
    if(isset($_REQUEST['del']) && $_REQUEST['del'] != "") {
        $delete_query = "DELETE FROM get_in_touch WHERE id=?";
        $delete_stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($delete_stmt, $delete_query)) {
            show_alert('Something went wrong. Please try again.');
        }else{
            mysqli_stmt_bind_param($delete_stmt, "i", $_REQUEST['del']);

            if (mysqli_stmt_execute($delete_stmt)){
                show_success_alert('Successfully deleted.');
            }else {
                show_alert('Something went wrong. Please try again.');
                debug_to_console(mysqli_error($con));
            }
        }
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
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-body"> 
                                <h4 class="card-title text-uppercase">Get in Touch</h4>
                                <div class="table-responsive" data-simplebar="" data-simplebar-auto-hide="true">
                                    <table class="table table-bordered border-top">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Reply</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $sr = 1;
                                            $q = "SELECT * FROM get_in_touch ORDER BY created_at DESC";
                                            $tb = mysqli_query($con, $q);

                                            if($row = mysqli_fetch_array($tb))
                                            {
                                                do
                                                { 
                                             ?>
                                            <tr>
                                                <td class="text-center"><?php echo $sr++;; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $row['subject']; ?></td>
                                                <td style="white-space: normal; width: 45%">
                                                    <?php 
                                                        $txt = $row['message'];
                                                        $btn_read_more = "<a href='#btn_read_more' onclick='showDetails(\" $txt \" )' class='text-info waves-effect waves-light my-1' data-toggle='modal'>More</a>";
                                                        echo ((strlen($txt) > 50) ? substr($txt, 0, 50)."...".$btn_read_more : $txt);
                                                     ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" data-toggle="modal" data-target="#showReplyForm" class="mx-auto d-block btn btn-light btn-sm" onclick="SetEmail(this)"><i class="fa fa-reply"></i> Reply</button>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-light waves-effect waves-light my-1" onclick="confirmDelete(<?php echo $row['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                </td>              
                                            </tr>
                                        <?php } while($row = mysqli_fetch_array($tb));
                                            }else{
                                                echo "<td colspan='8' class='text-center text-warning h4'> Data not found! </td>";;
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </iv>
                </div> 
                <!--start overlay-->
        	  <div class="overlay toggle-menu"></div>
              <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div>
        <!--End content-wrapper-->

        <!-- Read More -->
        <div class="modal animated animated swing" id="btn_read_more">
            <div class="modal-dialog">
                <div class="modal-content gradient-forest rounded border-0">
                    <div class="modal-header">
                        <h5 class="modal-title">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="read_more_message">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mail reply -->
        <div class="modal animated swing" id="showReplyForm">
            <div class="modal-dialog" role="document">
                <div class="modal-content gradient-forest rounded border-0">
                    <div class="modal-header">
                        <h4 class="modal-title text-white"><i class="fa fa-reply"></i>  Reply</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" TextMode="Email" placeholder="Sender Email...." class="form-control" autocomplete="false" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="subject" placeholder="Subject...." class="form-control" autocomplete="false" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-comment"></i>
                                        </span>
                                    </div>
                                    <textarea name="message" rows="6" placeholder="Compose Email...." class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="d-block text-center btn btn-light">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

         <script type="text/javascript">
            function SetEmail(link) {
                var row = link.parentNode.parentNode;
                var index = row.rowIndex - 1;
                var val = row.cells[2].innerHTML;
                document.getElementById("email").value = val
            }

            function showDetails(desc) {
                document.getElementById("read_more_message").innerHTML = desc;
            }
        </script>

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
                    window.location = "contacts.php?del=" + id;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        } 
    </script>

</body>
</html>
