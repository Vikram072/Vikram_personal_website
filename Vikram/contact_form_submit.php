<?php 
	require_once("../admin/include/config.php");
    
    if(isset($_POST['submit_contact_form'])) {
        $query = "INSERT INTO get_in_touch SET name=?, email=?, subject=?, message=?";
        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $query)) {
        	header("Location: index.php?error=swn");
        }else{
            mysqli_stmt_bind_param($stmt, "ssss", $_POST['your-name'], $_POST['your-email'], $_POST['your-subject'], $_POST['your-message']);

            if (mysqli_stmt_execute($stmt)){
        		header("Location: index.php?success=true");
            }else {
	        	header("Location: index.php?error=swn");
            }
        }
    }


 ?>