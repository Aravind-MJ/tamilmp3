<?php
session_start();
if(!isset($_SESSION['user'])){
    echo '<script> window.location.href="login.php?status=0"; </script>';
}

