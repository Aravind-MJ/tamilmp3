<?php

$response = array();
foreach (glob("../banner/*") as $filename) {
    if (!strpos($filename, 'noimage')) {
        $response[0][] = substr($filename, 3, strlen($filename));
    }
}

$filename = "../text_files/news.txt";
$mode = "r";
if (file_exists($filename) && filesize($filename)>0) {
    $file = fopen($filename, $mode);
    $content = fread($file, filesize($filename));
    $response[1] = explode(PHP_EOL, $content);
}

//print_r($response);
echo json_encode($response);
