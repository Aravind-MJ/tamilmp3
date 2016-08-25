<?php

$param = json_decode(file_get_contents("php://input"));
$file = $param->file; 
$col = $param->col;

$response = array();
$ofile = fopen($file, 'r') or die("Unable to open file!");
while ($line = fgets($ofile)) {
    preg_match_all('/[0-9]{4}/', $line, $iyear);
    preg_match_all('/[A-Za-z ]+/', $line, $iname);
    $response[$iname[0][0]] = new stdClass;
    $response[$iname[0][0]]->name = trim($iname[0][0]);
    if (isset($iyear[0][0])) {
        $response[$iname[0][0]]->year = $iyear[0][0];
    } else {
        $response[$iname[0][0]]->year = null;
    }
}
sort($response);
$count = ceil(sizeof($response)/$col);
$response = array_chunk($response,$count);
echo json_encode($response);





