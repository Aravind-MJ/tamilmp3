<?php

$params = json_decode(file_get_contents('php://input'), true);
if (isset($params)) {
    include 'db.php';
    $offset = $params['limit'] * $params['offset'];
    $data = array();
    
    

    $query = sprintf("SELECT s.name as song,m.name as movie FROM songs s LEFT JOIN movies m ON s.movie_id = m.id WHERE s.name LIKE '%%%s%%'", $params['search']);
    $result = mysqli_query($link, $query);
    $count = mysqli_num_rows($result);

    $query = sprintf("SELECT s.id as id,s.name as song,m.name as movie FROM songs s LEFT JOIN movies m ON s.movie_id = m.id WHERE s.name LIKE '%%%s%%' ORDER BY s.name LIMIT %d OFFSET %d", $params['search'], $params['limit'], $offset);
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_object($result)) {
        $full_row = new stdClass;
        $full_row->id = $row->id;
        $full_row->song = $row->song;
        $full_row->movie = $row->movie;
        
        $query = sprintf("SELECT s.id as id,name from singers s LEFT JOIN sung_by sb ON s.id = sb.singer_id WHERE sb.song_id = %d", $row->id);
        $result2 = mysqli_query($link, $query);
        $full_row->sname=array();
        while ($inner_row_singers = mysqli_fetch_object($result2)) {
            $singer = new stdClass;
            $singer->id = $inner_row_singers->id;
            $singer->name = $inner_row_singers->name;
            array_push($full_row->sname,$singer);
        }
        
        $query = sprintf("SELECT d.id as id,name from music_directors d LEFT JOIN directed_by db ON d.id = db.director_id WHERE db.song_id = %d", $row->id);
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
    $response['songs'] = $data;
    $response['pagelimit'] = ceil($count / $params['limit']);

    echo json_encode($response);
}