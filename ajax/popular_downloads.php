<?php

$filename = "../DownloadCount/toplist.txt";
$mode = "r";
if (file_exists($filename)) {
    $file = fopen($filename, $mode);
    $content = fread($file, filesize($filename));
    $response = unserialize($content);
    echo json_encode($response);
} else {
    echo 'File Not Found';
}


