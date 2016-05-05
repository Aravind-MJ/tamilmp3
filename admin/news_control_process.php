<?php
    include 'db.php';
    $news = $_POST['news'];
    $query = sprintf("INSERT INTO news SET news='%s',active=0,del_status=0",$news);
    mysqli_query($link, $query) or die(mysqli_error($link));
    echo '<script> window.location.href="news_control.php"; </script>';
