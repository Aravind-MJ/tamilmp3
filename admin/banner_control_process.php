<?php
    include 'db.php';
    //PHP Upload Script
    if (!is_dir("banner")) {
        mkdir("banner");
    }

    $max_size = 5000;          // maximum file size, in KiloBytes
    $allowtype = array('jpg', 'jpeg');        // allowed extensions

    if (isset($_FILES['image']) && strlen($_FILES['image']['name']) > 1) {

        $file = $_FILES['image']['name'];
        if (file_exists('banner/' . $file)) {
            $_SESSION['status'] = 0;
            echo '<script> window.location.href="banner_control.php"; </script>';
        }

        $sepext = explode('.', strtolower($_FILES['image']['name']));
        $type = end($sepext);       // gets extension
        // Checks if the file has allowed type and size
        if (!in_array($type, $allowtype)) {
            $_SESSION['status'] = 1;
            echo '<script> window.location.href="banner_control.php"; </script>';
        }
        if ($_FILES['image']['size'] > $max_size * 1000) {
            $_SESSION['status'] = 2;
            echo '<script> window.location.href="banner_control.php"; </script>';
        }
        $uploadpath = 'banner/' . $file;     // gets the file name
        // If no errors, upload the image, else, output the errors
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath)) {
            
            $query = sprintf("INSERT INTO banner SET file='%s',del_status=%d,active=%d",$file,0,0);
            if(mysqli_query($link, $query)){
                $_SESSION['status'] = 3;
                echo '<script> window.location.href="banner_control.php"; </script>';
            }
        } else {
            //header('Location: add_song.php?status=2');
            $_SESSION['status'] = 4;
            echo '<script> window.location.href="banner_control.php"; </script>';
        }
    }else{
        $_SESSION['status'] = 5;
        echo '<script> window.location.href="banner_control.php"; </script>';
    }

