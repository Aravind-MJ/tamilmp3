<?php
if($_GET){
    include 'db.php';
    $id = $_GET['id'];
    $query = sprintf("SELECT * FROM movie_directed_by WHERE director_id=%d",$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if(mysqli_num_rows($result)>0){
        echo '<script> window.location.href="view_movie_director.php?status=Cannot delete Director because a Movie exists for this Director. Delete those Movies to Continue!";</script>';
        die();
    }
    
    $query = sprintf("DELETE FROM directors WHERE id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_movie_director.php?status=Deletion at directors Table failed"; </script>';
        die();
    }
    
    echo '<script> window.location.href="view_movie_director.php?status=1"; </script>';
}