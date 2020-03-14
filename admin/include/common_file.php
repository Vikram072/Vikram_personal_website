<!-- notifications css -->
<link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css"/>
<!--notification js -->
<script src="assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="assets/plugins/notifications/js/notifications.min.js"></script>

<script>
    function showAlert(message, position="top right", isSuccess=false){
        var alertType = "warning";
        var alertIcon = "fa fa-exclamation-circle";
        if (isSuccess == true) {
            alertType = "success";
            alertIcon = "fa fa-check-circle";
        }
        Lobibox.notify(alertType, {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: alertIcon,
            continueDelayOnInactiveTab: false,
            position: position,
            msg: message
        });
    } 
</script>

<?php 
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log(".json_encode(var_export($data, true)).");</script>";
        //'<script>console.log("'."Debug Objects: " . $output . '" );</script>';
    }

    function show_alert($msg, $position="top right") {
        echo "<script> showAlert('$msg', '$position', false); </script>";
    }

    function show_success_alert($msg, $position="top right") {
        echo "<script> showAlert('$msg', '$position', true); </script>";
    }
 ?>