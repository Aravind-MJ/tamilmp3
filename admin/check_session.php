<?php
session_start();
if(!isset($_SESSION['user'])){
    echo '<script> window.location.href="index.php?status=0"; </script>';
}

