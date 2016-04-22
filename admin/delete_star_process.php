<?php
if($_GET){
    include 'db.php';
    $id = $_GET['id'];
    $query = sprintf("SELECT * FROM starred_by WHERE star_id=%d",$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if(mysqli_num_rows($result)>0){
        echo '<script> window.location.href="view_stars.php?status=Cannot delete Star because a Movie exists for this Star. Delete those Movies to Continue!";</script>';
        die();
    }
    
    $query = sprintf("DELETE FROM stars WHERE id=%d",$id);
    $r = mysqli_query($link, $query);
    if(!$r){
        echo '<script> window.location.href="view_stars.php?status=Deletion at stars Table failed"; </script>';
        die();
    }
    
    echo '<script> window.location.href="view_stars.php?status=1"; </script>';
}