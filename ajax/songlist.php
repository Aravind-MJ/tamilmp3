<?php

$param = json_decode(file_get_contents("php://input"));
$folder = $param->loc;


function songslist($startdir) {
    $ignoredDirectory[] = '.';
    $ignoredDirectory[] = '..';
    $mp3songs = '';
    if (is_dir($startdir)) {
        if ($dh = opendir($startdir)) {
            while (($folder = readdir($dh)) !== false) {
                if (!(array_search($folder, $ignoredDirectory) > -1)) {
//				   if(filetype($startdir . $folder) == "file"){
                    $mp3songs[$startdir . $folder]['name'] = $folder;
                    $mp3songs[$startdir . $folder]['path'] = $startdir;
                    $mp3songs[$startdir . $folder]['downpath'] = substr($startdir, 3);
//				   }
                }
            }
            closedir($dh);
        }
    }
    return($mp3songs);
}

// include getID3() library (can be in a different directory if full path is specified)
require_once('getID3/getid3/getid3.php');

// Initialize getID3 engine


/*
  Optional: copies data from all subarrays of [tags] into [comments] so
  metadata is all available in one location for all tag formats
  metainformation is always available under [tags] even if this is not called
 */

$songs = songslist($folder);
$detail = array();
foreach ($songs as $song) {
//    $detail[$song['name']]=tagReader($song['path'].'/'.$song['name']);
    $getID3 = new getID3;
    $filename = $song['path'] . '/' . $song['name'];

    $ThisFileInfo = $getID3->analyze($filename);

    $detail[$song['name']] = $ThisFileInfo['filesize'];
}
$songDetailMerge = array('detail' => $detail, 'song' => $songs);

echo json_encode($songDetailMerge);

