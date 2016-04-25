<?php
if($_GET){
    include 'db.php';
    $id = $_GET['id'];
    $query = sprintf("SELECT * FROM sung_by WHERE singer_id=%d",$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if(mysqli_num_rows($result)>0){
        echo '<script> window.location.href="view_singer.php?status=Cannot delete Singer because a Song exists for this Singer. Delete those Songs to Continue!";</script>';
        die();
    }
    
    $query = sprintf("DELETE FROM singers WHERE id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_singer.php?status=Deletion at stars Table failed"; </script>';
        die();
    }
    
    echo '<script> window.location.href="view_singer.php?status=1"; </script>';
}