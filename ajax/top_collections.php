<?php

$file = "../text_files/topCollections.txt";

$response = array();

    $fopen = fopen($file, 'r') or die("Unable to open file!");

    $fread = fread($fopen,filesize($file));

    fclose($fopen);

    $remove = "\n";

    $response = explode($remove, $fread);
    
echo json_encode($response);





