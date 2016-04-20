<?php
if($_POST){
    include 'db.php';
    
    $name = $_POST['name'];
    $name = ucwords($name);
    
    //Check to see if star name already exist
    $query = sprintf("SELECT * FROM directors WHERE name='%s'", $name);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if (mysqli_num_rows($result) > 0) {
        echo '<script> window.location.href="add_movie_director.php?status=1"; </script>';
        die();
    }
    
    $query = sprintf("INSERT INTO directors SET name='%s'", $name);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    
    echo '<script> window.location.href="add_movie_director.php?status=0"; </script>';
    
    
    
}

