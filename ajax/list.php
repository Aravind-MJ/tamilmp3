<?php

$param = json_decode(file_get_contents("php://input"));
$folder = $param -> loc;

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

$rlist = folderlist($folder);
echo json_encode($rlist);
?>

