<?php

if ($_POST) {
    include 'db.php';
    $id = $_POST['id'];
    
    $data = array();
    $movies = array();
    $director = array();
    $stars = array();
    $singers = array();
    $music_directors = array();
    
    $data[1] = array();
    $data[4] = array();
    $data[5] = array();
    $data[6] = array();
    $data[7] = array();
    $data[8] = array();
    $data[9] = array();
    $data[10] = array();
    $data[11] = array();
    
    $query = sprintf("SELECT name,movie_id FROM songs WHERE id=%d",$id);
    $row = mysqli_fetch_assoc(mysqli_query($link, $query));
    $data[0] = $row['name']; //Song name
    $movie_id = $row['movie_id'];
    $data[2] = $row['movie_id']; //Selected Movie id
    
    $query = sprintf("SELECT id,name FROM movies");
    $result = mysqli_query($link, $query);
    $i=0;
    while($row = mysqli_fetch_assoc($result)){
        $movies[$i] = (object) ["id" => $row['id'], "text" => $row['name']];
        $i++;
    }
    
    $data[1] = $movies; // All movies
    $data[3] = $row['year']; //year

    $query = sprintf("SELECT id,name FROM directors ORDER BY name");
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $i=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $director[$i] = (object) ["id" => $row['id'], "text" => $row['name']];
        $i++;
    }
    $data[4]=$director; //All directors
    
    $query = sprintf("SELECT director_id FROM movie_directed_by WHERE movie_id=%d",$movie_id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data[5], $row['director_id']); //Selected director id
    }

    $query = sprintf("SELECT * FROM stars ORDER BY name");
    $result = mysqli_query($link, $query)or die(mysqli_error($link));
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $stars[$i] = (object) ['id' => $row['id'], 'text' => $row['name']];
        $i++;
    }
    $data[6] = $stars; //All stars
    
    $query = sprintf("SELECT star_id FROM starred_by WHERE movie_id=%d",$movie_id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data[7], $row['star_id']); //Selected stars id
    }
    
    $query = sprintf("SELECT * FROM singers ORDER BY name");
    $result = mysqli_query($link, $query)or die(mysqli_error($link));
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $singers[$i] = (object) ['id' => $row['id'], 'text' => $row['name']];
        $i++;
    }
    $data[8] = $singers; //All stars
    
    $query = sprintf("SELECT singer_id FROM sung_by WHERE song_id=%d",$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data[9], $row['singer_id']); //Selected stars id
    }
    
    $query = sprintf("SELECT * FROM music_directors ORDER BY name");
    $result = mysqli_query($link, $query)or die(mysqli_error($link));
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $music_directors[$i] = (object) ['id' => $row['id'], 'text' => $row['name']];
        $i++;
    }
    $data[10] = $music_directors; //All Music Directors
    
    $query = sprintf("SELECT director_id FROM directed_by WHERE song_id=%d",$id);
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data[11], $row['director_id']); //Selected music directors id
    }
    
    
    echo json_encode($data);
}
?>
