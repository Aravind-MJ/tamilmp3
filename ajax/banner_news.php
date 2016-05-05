<?php
include 'db.php';
$query = sprintf("SELECT file FROM banner WHERE active=1 AND del_status=0");
$result  = mysqli_query($link, $query) or die(mysqli_error($link));
$response = array();
$response[0] = array();
$response[1] = array();
while($row = mysqli_fetch_assoc($result)){
    $response[0][]=$row['file'];
}
$query = sprintf("SELECT news FROM news WHERE active=1 AND del_status=0");
$result  = mysqli_query($link, $query) or die(mysqli_error($link));
while($row = mysqli_fetch_assoc($result)){
    $response[1][]=$row['news'];
}
echo json_encode($response);
