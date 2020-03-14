<?php

    // define absolute folder path
    $storeFolder = '../uploads/';
    // if folder doesn't exists, create it
    if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
        mkdir($storeFolder);
    }

     if (isset($_FILES['p_upload_image']['name'])) {
        if (!$_FILES['p_upload_image']['error']) {
            $destination =  '../uploads/portfolio/'. strtotime("now") .'_' . $_FILES['p_upload_image']['name'];
            $location = $_FILES['p_upload_image']['tmp_name'];
            if (move_uploaded_file($location, $destination)) {
                echo 'http://'.$_SERVER['HTTP_HOST']. '/Vikram/personal/main/' . str_replace("../", "", $destination);//change this URL
            }
        }
        else
        {
          echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['p_upload_image']['error'];
        }
    }else {
        if (!empty($_FILES)) {
            foreach($_FILES['file']['tmp_name'] as $key => $value) {
                $tempFile = $_FILES['file']['tmp_name'][$key];
                echo(strtotime("now") .'_'.$_FILES['file']['name'][$key]);
                $targetFile =  $storeFolder. strtotime("now") .'_'.$_FILES['file']['name'][$key];
                $targetFile = preg_replace('/\s+/', "", $storeFolder.$targetFile);
                move_uploaded_file($tempFile,$targetFile);
            }
        }
    }
?> 
