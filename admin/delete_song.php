<?php

if ($_GET['id']) {
    include 'db.php';
    $id = $_GET['id'];
    
    //Code to delete Song file

    /*$query = sprintf("SELECT s.name as name,s.file as file,m.name as moviename FROM songs s LEFT JOIN movies m ON s.movie_id = m.id WHERE s.id=%d", $id);
    $row = mysqli_fetch_assoc(mysqli_query($link, $query));

    $filepath = "upload/" . $row['moviename'] . "/" . $row['file'];

    if (file_exists($filepath)) {
        chmod($filepath, 0777);
        if (unlink($filepath)) {
            echo '<script> window.location.href="view_song.php?status=1"; </script>';
        } else {
            echo '<script> window.location.href="view_song.php?status=File Deletion Failed"; </script>';
        }
    } else {
        echo '<script> window.location.href="view_song.php?status=Song File Not Found"; </script>';
    }*/
    
    $query = sprintf("DELETE FROM songs WHERE id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_song.php?status=Deletion at song Table failed"; </script>';
    }
    
    $query = sprintf("DELETE FROM sung_by WHERE song_id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_song.php?status=Deletion at sung_by Table failed"; </script>';
    }
    
    $query = sprintf("DELETE FROM directed_by WHERE song_id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_song.php?status=Deletion at directed_by Table failed"; </script>';
    }
    
    echo '<script> window.location.href="view_song.php?status=1"; </script>';
    
    
}

