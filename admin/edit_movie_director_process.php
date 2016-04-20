<?php
if($_POST){
    include 'db.php';
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $name = ucwords($name);
    
    //Check to see if star name already exist
    $query = sprintf("SELECT * FROM directors WHERE name='%s'", $name);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if (mysqli_num_rows($result) > 0) {
        echo '<script> window.location.href="view_movie_director.php?status=Name unchanged or Same Name Exists"; </script>';
        die();
    }
    
    $query = sprintf("UPDATE directors SET name='%s' WHERE id=%d", $name,$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    
    echo '<script> window.location.href="view_movie_director.php?status=0"; </script>';
    
    
    
}

