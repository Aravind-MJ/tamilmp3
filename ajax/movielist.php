<?php

$file = "../text_files/featuredAlbum.txt";

$response = array();
$ofile = fopen($file, 'r') or die("Unable to open file!");
while ($line = fgets($ofile)) {
    preg_match_all('/[0-9]{4}/', $line, $iyear);
    preg_match_all('/[A-Za-z ]+/', $line, $iname);
//    preg_match_all('[0-9]{4}+/[A-Za-z ]/', $line, $istar);
    $response[$iname[0][0]] = new stdClass;
    $response[$iname[0][0]]->name = $iname[0][0];
//    $response[$iname[0][0]]->star = $istar[0][0];
    if (isset($iyear[0][0])) {
        $response[$iname[0][0]]->year = $iyear[0][0];
    } else {
        $response[$iname[0][0]]->year = null;
    }

}
$response = array($response);
echo json_encode($response);





