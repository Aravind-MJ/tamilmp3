<?php

$param = json_decode(file_get_contents("php://input"));
$folder = $param->loc;
$alpha = $param->alpha;
$file = $param->file;

function folderlist($startdir, $alpha)
{
    $ignoredDirectory[] = '.';
    $ignoredDirectory[] = '..';
    $directorylist = array();
    if (is_dir($startdir)) {
        if ($dh = opendir($startdir)) {
            while (($folder = readdir($dh)) !== false) {
                if (!(array_search($folder, $ignoredDirectory) > -1)) {
                    if (filetype($startdir . $folder) == "dir") {
                        if ($alpha == "num") {
                            if (is_numeric($folder[0]) OR preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $folder[0])) {
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
    sort($directorylist);
    return ($directorylist);
}

if ($file == false) {
    $list = folderlist($folder, $alpha);
    $count = ceil(count($list) / 3);
    $rlist = array_chunk($list, $count);
    echo json_encode($rlist);
} else {
    $response = array();
    $ofile = fopen($folder, 'r') or die("Unable to open file!");
    while ($line = fgets($ofile)) {
        preg_match_all('/[\[][0-9][\]]{4}/', $line, $iyear);
        preg_match_all('/[\(\)0-9A-Za-z\+\- ]+/', $line, $iname);
        if ($alpha == 'num') {
            if (is_numeric($iname[0][0][0]) OR preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $iname[0][0][0])) {
                $response[$iname[0][0]] = new stdClass;
                $response[$iname[0][0]]->name = $iname[0][0];
                if (isset($iyear[0][0])) {
                    $response[$iname[0][0]]->year = $iyear[0][0];
                } else {
                    $response[$iname[0][0]]->year = null;
                }
            }
        } else {
            if ($iname[0][0][0] == strtolower($alpha) || $iname[0][0][0] == strtoupper($alpha)) {
                $response[$iname[0][0]] = new stdClass;
                $response[$iname[0][0]]->name = $iname[0][0];
                if (isset($iyear[0][0])) {
                    $response[$iname[0][0]]->year = $iyear[0][0];
                } else {
                    $response[$iname[0][0]]->year = null;
                }
            }

        }
    }
    $count = ceil(sizeof($response) / 3);
    sort($response);
    if (sizeof($response) >= 15) {
        $response = array_chunk($response, $count);
    }
    echo json_encode($response);
}
?>
