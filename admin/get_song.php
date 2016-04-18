<?php
$params = json_decode(file_get_contents('php://input'),true);
if (isset($params)) {
    include 'db.php';
    $offset = $params['limit']*$params['offset'];
    $data = array();
    $query = sprintf("SELECT s.name as song,m.name as movie FROM songs s LEFT JOIN movies m ON s.movie_id = m.id WHERE s.name LIKE '%%%s%%' LIMIT %d OFFSET %d",$params['search'],$params['limit'],$offset);
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_object($result)) {
        array_push($data, $row);
    }
    echo json_encode($data);
}