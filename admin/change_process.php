<?php
if ($_POST) {
    session_start();
    include 'db.php';
    $old = $_POST['old-password'];
    $new = $_POST['newp-password'];

    $old = md5($old);
    $new = md5($new);

    $query = sprintf("SELECT * from login WHERE id=%d AND password='%s'", $_SESSION['user'], $old);
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) != 1) {
        $_SESSION['status'] = 1;
        echo '<script> window.location.href="change.php"; </script>';
    } else {
        $query = sprintf("UPDATE login SET password='%s'",$new);
        $result = mysqli_query($link, $query);
        $_SESSION['status'] = 0;
        echo '<script> window.location.href="change.php"; </script>';
    }
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}

