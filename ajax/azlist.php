<?php

$param = json_decode(file_get_contents("php://input"));
 $folder = $param->loc;
 $alpha = $param->alpha;
function folderlist($startdir, $alpha) {
    $ignoredDirectory[] = '.';
    $ignoredDirectory[] = '..';
    $directorylist = '';
    if (is_dir($startdir)) {
        if ($dh = opendir($startdir)) {
            while (($folder = readdir($dh)) !== false) {
                if (!(array_search($folder, $ignoredDirectory) > -1)) {
                    if (filetype($startdir . $folder) == "dir") {
                        if ($alpha == "num") {
                            if (is_numeric($folder[0])) {
                                $directorylist[$startdir . $folder]['name'] = $folder;
                                $directorylist[$startdir . $folder]['path'] = $startdir;
                            }
                        } else {
                            if ($folder[0] == strtolower($alpha) || $folder[0] == strtoupper($alpha)) {
                                $directorylist[$startdir . $folder]['name'] = $folder;
                                $directorylist[$startdir . $folder]['path'] = $startdir;
                            }
                        }
                    }
                }
            }
            closedir($dh);
        }
    }
    return($directorylist);
}
$list = folderlist($folder, $alpha);
$count = ceil(count($list) / 3);
$rlist = array_chunk($list, $count);
echo json_encode($rlist);
?>
