<?php

$param = json_decode(file_get_contents("php://input"));
$file = $param->file;

$response = array();
$ofile = fopen($file, 'r') or die("Unable to open file!");
while ($line = fgets($ofile)) {
    preg_match_all('/[A-Za-z ]+/', $line, $iname);
    $response[$iname[0][0]] = new stdClass;
    $response[$iname[0][0]]->name = $iname[0][0];

}
$count = ceil(sizeof($response)/2);
$response = array_chunk($response,$count);
echo json_encode($response);















