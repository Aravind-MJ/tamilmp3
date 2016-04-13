<?php

if ($_POST) {
    include 'db.php';
    $id = $_POST['id'];

    $query = sprintf("SELECT * FROM movies WHERE id='%s'", $id);
    $row = mysqli_fetch_assoc(mysqli_query($link, $query));

    $year = $row['year'];

    $director = array();
    $dir = explode(',', $row['director']);

    $i = 0;
    $data[2] = array();
    foreach ($dir as $each_dir) {
        $director[$i] = (object) ["id" => $i, "text" => $each_dir];
        array_push($data[2], $i);
        $i++;
    };

    $query = sprintf("SELECT name FROM stars s INNER JOIN starred_by sb ON s.id = sb.star_id WHERE sb.movie_id = '%s' ", $id);
    $result = mysqli_query($link, $query);
    $stars = array();
    $i = 0;
    $data[4] = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $stars[$i] = (object) ['id' => $i, 'text' => $row['name']];
        array_push($data[4], $i);
        $i++;
    }

    $data[0] = $year;
    $data[1] = $director;
    $data[3] = $stars;
    echo json_encode($data);
}
?>
