<?php

$param = json_decode(file_get_contents("php://input"));
$file = $param->file;

function songslist($strdir) {
    $mp3songs = array();
    if (is_dir($strdir)) {
        $list = glob($strdir . "/*.txt");
        foreach ($list as $file) {
            $files = explode('/', $file);
            $mp3songs[]['name'] = substr($files[sizeof($files)-1],0,  sizeof($files[sizeof($files)-1])-5);
        }
    }
    return($mp3songs);
}

$response = songslist($file);

$count = ceil(sizeof($response)/2);
$response = array_chunk($response,$count);
echo json_encode($response);















