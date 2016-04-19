<?php

if ($_POST) {
    include 'db.php';

    $id = $_POST['song_id'];
    $movie_id = $_POST['movie_name'];
    $music_directors = $_POST['music_directors'];
    $singers = $_POST['singers'];
    $song_name = ucwords($_POST['song_name']);
    $status = 0;

    if (!is_numeric($movie_id)) { //condition True if a new movie is added
        $year = $_POST['year'];
        $director = $_POST['director'];
        $starring = $_POST['starring'];

        //Adding Movie name and year to the table movies
        $movie_id = ucwords($movie_id);
        $movie_name = $movie_id;
        $query = sprintf("INSERT INTO movies SET name='%s',year=%d", $movie_id, $year);
        mysqli_query($link, $query) or die(mysqli_error($link));
        $movie_id = mysqli_insert_id($link);

        //Adding new directors if not already present
        foreach ($director as $each_director) {
            if (!is_numeric($each_director)) {
                $each_director = ucwords($each_director);
                $query = sprintf("INSERT INTO directors SET name='%s'", $each_director);
                mysqli_query($link, $query) or die(mysqli_error($link));
                $director_id = mysqli_insert_id($link);
            } else {
                $director_id = $each_director;
            }
            //Updating movie_directed_by Table
            $query = sprintf("INSERT INTO movie_directed_by SET director_id=%d,movie_id=%d", $director_id, $movie_id);
            mysqli_query($link, $query) or die(mysqli_error($link));
        }

        //Adding new Stars if Not already present

        foreach ($starring as $star) {
            if (!is_numeric($star)) {
                $star = ucwords($star);
                $query = sprintf("INSERT INTO stars SET name='%s'", $star);
                mysqli_query($link, $query) or die(mysqli_error($link));
                $star_id = mysqli_insert_id($link);
            } else {
                $star_id = $star;
            }
            //Updating starred_by Table
            $query = sprintf("INSERT INTO starred_by SET star_id=%d,movie_id=%d", $star_id, $movie_id);
            mysqli_query($link, $query) or die(mysqli_error($link));
        }
    } else {
        $query = sprintf("SELECT name FROM movies WHERE id='%s'", $movie_id);
        $row = mysqli_fetch_assoc(mysqli_query($link, $query));
        $movie_name = $row['name'];
    }

    /* //PHP Upload Script
      if (!is_dir("upload")) {
      mkdir("upload");
      }

      $uploadpath = 'upload/' . $movie_name;      // directory to store the uploaded files
      if (!is_dir($uploadpath)) {
      mkdir($uploadpath);
      }
      $max_size = 30000;          // maximum file size, in KiloBytes
      $allowtype = array('wav', 'mp3');        // allowed extensions

      if (isset($_FILES['song_file']) && strlen($_FILES['song_file']['name']) > 1) {

      $sepext = explode('.', strtolower($_FILES['song_file']['name']));
      $type = end($sepext);       // gets extension
      $err = '';         // to store the errors
      // Checks if the file has allowed type and size
      if (!in_array($type, $allowtype)) {
      $err .= 'The file: <b>' . $_FILES['song_file']['name'] . '</b> not has the allowed extension type.';
      }
      if ($_FILES['song_file']['size'] > $max_size * 1000) {
      $err .= '<br/>Maximum file size is: ' . $max_size . ' KB.';
      }

      $file = $song_name . '.' . $type;
      $uploadpath = $uploadpath . '/' . $file;     // gets the file name
      // If no errors, upload the image, else, output the errors
      if ($err == '') {
      if (move_uploaded_file($_FILES['song_file']['tmp_name'], $uploadpath)) {

      } else {
      //header('Location: add_song.php?status=2');
      echo '<script> window.location.href="add_song.php?status=2"; </script>';
      }
      } else {
      //header('Location: add_song.php?status='.$err.'');
      echo '<script> window.location.href="add_song.php?status='.$err.'"; </script>';
      }
      } */

    //Editing song in Table songs
    $query = sprintf("UPDATE songs SET name='%s',movie_id=%d WHERE id=%d", $song_name, $movie_id, $id);
    mysqli_query($link, $query) or die(mysqli_error($link));
    $song_id = mysqli_insert_id($link);


    //Deleting existing records of singers
    $query = sprintf("DELETE FROM sung_by WHERE song_id=%d", $id);
    mysqli_query($link, $query) or die(mysqli_error($link));


    //Adding new singer to the Table singers
    foreach ($singers as $singer) {
        if (!is_numeric($singer)) {
            $singer = ucwords($singer);
            $query = sprintf("INSERT INTO singers SET name='%s'", $singer);
            mysqli_query($link, $query) or die(mysqli_error($link));
            $singer_id = mysqli_insert_id($link);
        } else {
            $singer_id = $singer;
        }

        //Updating sung_by Table
        $query = sprintf("INSERT INTO sung_by SET singer_id=%d, song_id=%d", $singer_id, $song_id);
        mysqli_query($link, $query) or die(mysqli_error($link));
    }

    //Deleting existing records of singers
    $query = sprintf("DELETE FROM directed_by WHERE song_id=%d", $id);
    mysqli_query($link, $query) or die(mysqli_error($link));



    //Adding new Music Director to Table music_directors
    foreach ($music_directors as $music_director) {
        if (!is_numeric($music_director)) {
            $music_director = ucwords($music_director);
            $query = sprintf("INSERT INTO music_directors SET name='%s'", $music_director);
            mysqli_query($link, $query) or die(mysqli_error($link));
            $music_director_id = mysqli_insert_id($link);
        } else {
            $music_director_id = $music_director;
        }

        //Updating directed_by Table
        $query = sprintf("INSERT INTO directed_by SET director_id=%d, song_id=%d", $music_director_id, $song_id);
        mysqli_query($link, $query) or die(mysqli_error($link));
    }

    //header('Location: add_song.php?status=0');
    echo '<script> window.location.href="view_song.php?status=0"; </script>';
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}

