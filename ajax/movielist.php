<?php

$file = "../text_files/featuredAlbum.txt";

$response = array();

    $fopen = fopen($file, 'r') or die("Unable to open file!");

    $fread = fread($fopen,filesize($file));

    fclose($fopen);

    $remove = "\n";

    $split = explode($remove, $fread);
    
    $del = ':';

    foreach ($split as $string)
    {
        
        $value = explode($del, $string);
        $rowArray = array(
                'name'  => isset($value[0]) ? $value[0] : null,
                'year'  => isset($value[1]) ? $value[1] : null,
                'star'  => isset($value[2]) ? $value[2] : null,
                'music'  => isset($value[3]) ? $value[3] : null,
                'director'  => isset($value[4]) ? $value[4] : null,
            );
        
        array_push($response,$rowArray);

    }
 array_pop($response);
$response = array($response);
echo json_encode($response);





