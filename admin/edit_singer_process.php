<?php

if ($_POST) {
    include 'db.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $name = ucwords($name);

    //Check to see if star name already exist
    $query = sprintf("SELECT * FROM singers WHERE name='%s'", $name);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if (mysqli_num_rows($result) > 0) {
        echo '<script> window.location.href="view_singer.php?status=Name Unchanged or Another same Name Exists"; </script>';
        die();
    }

    //Edit Name    
    $query = sprintf("UPDATE singers SET name='%s' WHERE id=%d", $name, $id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    //PHP Upload Script
    if (!is_dir("stars")) {
        mkdir("stars");
    }

    $uploadpath = 'stars/';  // directory to store the uploaded files
    $max_size = 30000;          // maximum file size, in KiloBytes
    $allowtype = array('jpg', 'jpeg');        // allowed extensions

    if (isset($_FILES['image']) && strlen($_FILES['image']['name']) > 1) {

        $sepext = explode('.', strtolower($_FILES['image']['name']));
        $type = end($sepext);       // gets extension
        $err = '';         // to store the errors
        // Checks if the file has allowed type and size
        if (!in_array($type, $allowtype)) {
            $err .= 'The file: <b>' . $_FILES['image']['name'] . '</b> not has the allowed extension type.';
        }
        if ($_FILES['image']['size'] > $max_size * 1000) {
            $err .= '<br/>Maximum file size is: ' . $max_size . ' KB.';
        }

        $file = $name . '.' . $type;
        $uploadpath = $uploadpath . '/' . $file;     // gets the file name
        // If no errors, upload the image, else, output the errors
        if ($err == '') {
            /* Code to delete file if exists
              if (file_exists($uploadpath)) {
              chmod($uploadpath, 0755); //Change the file permissions if allowed
              unlink($uploadpath); //remove the file
              }
             */
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath)) {
                $query = sprintf("UPDATE stars SET image='%s' WHERE id=%d", $file, $id);
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
            } else {
                //header('Location: add_movie.php?status=2');
                echo '<script> window.location.href="view_singer.php?status=2"; </script>';
            }
        } else {
            //header('Location: add_movie.php?status='.$err.'');
            echo '<script> window.location.href="view_singer.php?status=' . $err . '"; </script>';
        }
    }

    echo '<script> window.location.href="view_singer.php?status=0"; </script>';
}

