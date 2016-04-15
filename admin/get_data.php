<?php

if ($_POST) {
    include 'db.php';
    if ($_POST['id']!="new") {
        $id = $_POST['id'];

        $query = sprintf("SELECT year FROM movies WHERE id='%s'", $id);
        $row = mysqli_fetch_assoc(mysqli_query($link, $query));

        $year = $row['year'];

        $query = sprintf("SELECT d.id,name FROM directors d INNER JOIN movie_directed_by md ON d.id = md.director_id WHERE md.movie_id = '%s' ", $id);
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $director = array();
        $data[2] = array();
        $i=0;
         while ($row = mysqli_fetch_assoc($result)) {
            $director[$i] = (object) ["id" => $row['id'], "text" => $row['name']];
            array_push($data[2], $row['id']);
            $i++;
        };

        $query = sprintf("SELECT s.id,name FROM stars s INNER JOIN starred_by sb ON s.id = sb.star_id WHERE sb.movie_id = '%s' ", $id);
        $result = mysqli_query($link, $query)or die(mysqli_error($link));
        $stars = array();
        $data[4] = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $stars[$i] = (object) ['id' => $row['id'], 'text' => $row['name']];
            array_push($data[4], $row['id']);
            $i++;
        }

        $data[0] = $year;
        $data[1] = $director;
        $data[3] = $stars;
        echo json_encode($data);
    } else {
        $query = sprintf("SELECT id,name FROM directors");
        $result = mysqli_query($link, $query);
        $director = array();
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
                $director[$i] = (object) ["id" => $row['id'], "text" => $row['name']];
                $i++;
        }
        
        
        $query = sprintf("SELECT id,name FROM stars");
        $result = mysqli_query($link, $query);
        $stars = array();
        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $stars[$i] = (object) ['id' => $row['id'], 'text' => $row['name']];
            $i++;
        }
        
        $data[0]=$director;
        $data[1]=$stars;
        echo json_encode($data);
        
    }
}
?>
