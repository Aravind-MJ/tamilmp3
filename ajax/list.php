<?php

$param = json_decode(file_get_contents("php://input"));
$folder = $param->loc;
$col = $param->col;

function folderlist($startdir) {
    $ignoredDirectory[] = '.';
    $ignoredDirectory[] = '..';
    $directorylist = '';
    if (is_dir($startdir)) {
        if ($dh = opendir($startdir)) {
            while (($folder = readdir($dh)) !== false) {
                if (!(array_search($folder, $ignoredDirectory) > -1)) {
                    if (filetype($startdir . $folder) == "dir") {
                        $directorylist[$startdir . $folder]['name'] = $folder;
                        $directorylist[$startdir . $folder]['path'] = $startdir;
                    }
                }
            }
            closedir($dh);
        }
    }
    return($directorylist);
}

$list = folderlist($folder);
$count = ceil(count($list) / $col);
$rlist = array_chunk($list, $count);
echo json_encode($rlist);
?>