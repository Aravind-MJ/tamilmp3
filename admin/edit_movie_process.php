<?php

if ($_POST) {
    include 'db.php';
    $id = $_POST['id'];
    $movie_name = $_POST['name'];
    $movie_name = ucwords($movie_name);
    $year = $_POST['year'];
    $director = $_POST['director'];
    $starring = $_POST['starring'];


    $query = sprintf("UPDATE movies SET name='%s',year=%d WHERE id=%d", $movie_name, $year,$id);
    mysqli_query($link, $query) or die(mysqli_error($link));
    $movie_id = mysqli_insert_id($link);
    
    //Deleting existing records of director
    $query = sprintf("DELETE FROM movie_directed_by WHERE movie_id=%d",$id);
    mysqli_query($link, $query) or die(mysqli_error($link));
    
    //Adding new directors if not already present
    foreach ($director as $each_director) {
        if (!is_numeric($each_director)) {
            $each_director = ucwords($each_director);
            $query = sprintf("INSERT INTO directors SET name='%s'", $each_director);
            mysqli_query($link, $query) or die(mysqli_error($link));
            $director_id = mysqli_insert_id($link);
        } else {
            $director_id = $each_director;
        }
        
        //Updating movie_directed_by Table
        $query = sprintf("INSERT INTO movie_directed_by SET director_id=%d,movie_id=%d", $director_id, $id);
        mysqli_query($link, $query) or die(mysqli_error($link));
    }

    //Deleting existing records of stars
    $query = sprintf("DELETE FROM starred_by WHERE movie_id=%d",$id);
    mysqli_query($link, $query) or die(mysqli_error($link));
    
    //Adding new Stars if Not already present
    foreach ($starring as $star) {
        if (!is_numeric($star)) {
            $star = ucwords($star);
            $query = sprintf("INSERT INTO stars SET name='%s'", $star);
            mysqli_query($link, $query) or die(mysqli_error($link));
            $star_id = mysqli_insert_id($link);
        } else {
            $star_id = $star;
        }
        //Updating starred_by Table
        $query = sprintf("INSERT INTO starred_by SET star_id=%d,movie_id=%d", $star_id, $id);
        mysqli_query($link, $query) or die(mysqli_error($link));
    }

    //PHP Upload Script
    if (!is_dir("upload")) {
        mkdir("upload");
    }

    $uploadpath = 'upload/' . $movie_name;      // directory to store the uploaded files
    if (!is_dir($uploadpath)) {
        mkdir($uploadpath);
    }
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

        $file = $movie_name . '.' . $type;
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
                $query = sprintf("UPDATE movies SET image='%s' WHERE id=%d", $file, $movie_id);
                mysqli_query($link, $query) or die(mysqli_error($link));
            } else {
                //header('Location: add_movie.php?status=2');
                echo '<script> window.location.href="view_movie.php?status=2"; </script>';
            }
        } else {
            //header('Location: add_movie.php?status='.$err.'');
            echo '<script> window.location.href="view_movie.php?status=' . $err . '"; </script>';
        }
    }
    echo '<script> window.location.href="view_movie.php?status=0"; </script>';
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}

