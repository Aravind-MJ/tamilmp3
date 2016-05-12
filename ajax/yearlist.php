<?php

$param = json_decode(file_get_contents("php://input"));
$folder = $param->loc;

function songslist($strdir) {
    $txtyears = array();
    if (is_dir($strdir)) {
        $list = glob($strdir . "/*.txt");
        foreach ($list as $file) {
            $files = explode('/', $file);
            $txtyears[$files[sizeof($files) - 1]]['name'] = $files[sizeof($files) - 1];
            $txtyears[$files[sizeof($files) - 1]]['name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $txtyears[$files[sizeof($files) - 1]]['name']);
            if (!is_numeric($txtyears[$files[sizeof($files) - 1]]['name'])) {
                unset($txtyears[$files[sizeof($files) - 1]]);
            }
        }
    }
    return($txtyears);
}

$years = songslist($folder);
$years = array_reverse($years, true);
$count = ceil(sizeof($years) / 4);
$years = array_chunk($years, $count);
echo json_encode($years);

