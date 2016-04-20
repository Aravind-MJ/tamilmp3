<?php

$params = json_decode(file_get_contents('php://input'), true);
if (isset($params)) {
    include 'db.php';
    $offset = $params['limit'] * $params['offset'];
    $data = array();
    
    

    $query = sprintf("SELECT * FROM movies WHERE name LIKE '%%%s%%'", $params['search']);
    $result = mysqli_query($link, $query);
    $count = mysqli_num_rows($result);

    $query = sprintf("SELECT id,name FROM MOVIES WHERE name LIKE '%%%s%%' ORDER BY name LIMIT %d OFFSET %d", $params['search'], $params['limit'], $offset);
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_object($result)) {
        $full_row = new stdClass;
        $full_row->id = $row->id;
        $full_row->movie = $row->name;
        
        $query = sprintf("SELECT s.id as id,s.name as name FROM stars s LEFT JOIN starred_by sb ON s.id = sb.star_id WHERE sb.movie_id = %d", $row->id);
        $result2 = mysqli_query($link, $query);
        $full_row->sname=array();
        while ($inner_row_stars = mysqli_fetch_object($result2)) {
            $star = new stdClass;
            $star->id = $inner_row_stars->id;
            $star->name = $inner_row_stars->name;
            array_push($full_row->sname,$star);
        }
        
        $query = sprintf("SELECT d.id as id,name from directors d LEFT JOIN movie_directed_by db ON d.id = db.director_id WHERE db.movie_id = %d", $row->id);
        $result3 = mysqli_query($link, $query);
        $full_row->dname=array();
        while ($inner_row_directors = mysqli_fetch_object($result3)) {
            $director = new stdClass;
            $director->id = $inner_row_directors->id;
            $director->name = $inner_row_directors->name;
            array_push($full_row->dname,$director);
        }
        
        array_push($data, $full_row);
    }
    $response['movies'] = $data;
    $response['pagelimit'] = ceil($count / $params['limit']);

    echo json_encode($response);
}