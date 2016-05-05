<?php
if($_GET){
    include 'db.php';
    $id = $_GET['id'];
    
    $query = sprintf("UPDATE news SET del_status=1,active=0 WHERE id=%d",$id);
    if(mysqli_query($link, $query)){
        $_SESSION['status'] = 6;
        echo '<script> window.location.href="news_control.php"; </script>';
    }else{
        $_SESSION['status'] = 7;
        echo '<script> window.location.href="news_control.php"; </script>';
    }
    
}

