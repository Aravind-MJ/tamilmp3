<?php
$params = json_decode(file_get_contents('php://input'), true);
if (isset($params)) {
    include 'db.php';
    $offset = $params['limit'] * $params['offset'];
    $data = array();
    
    $query = sprintf("SELECT * FROM directors WHERE name LIKE '%%%s%%'", $params['search']);
    $result = mysqli_query($link, $query);
    $count = mysqli_num_rows($result);
    
    $query = sprintf("SELECT id,name FROM directors WHERE name LIKE '%%%s%%' ORDER BY name LIMIT %d OFFSET %d", $params['search'], $params['limit'], $offset);
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_object($result)) {
        array_push($data, $row);
    }
    
    $response['directors'] = $data;
    $response['pagelimit'] = ceil($count / $params['limit']);
    
    echo json_encode($response);
}