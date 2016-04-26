<?php
if($_POST){
    include 'db.php';
    $status = $_POST['status'];
    $id = $_POST['id'];
    
    $query = sprintf("UPDATE banner SET active=%d WHERE id=%d",$status,$id);
    if(mysqli_query($link, $query)){
        echo 'SUCCESS';
    }else{
        echo 'FAILED';
    }
    
}
