<?php
if($_POST){
    include 'db.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $password = md5($password);
    
    $query = sprintf("SELECT id,name,role FROM login WHERE email='%s' AND password='%s'",$email,$password);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));;
    
    if( mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        echo '<script> window.location.href="home.php"; </script>';
    } else {
        echo '<script> window.location.href="index.php?status=0"; </script>';
    }
    
    
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}

