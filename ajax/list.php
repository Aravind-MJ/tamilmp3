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
                        //read caption from text file
                        $response = array();
                        $caption = ''; 
                        $cap = explode('/', $startdir, 3);
                        $capdir = end($cap);
                        if($capdir == 'Star Hits/'){
                            $caption = 'images/star_images';
                        } elseif ($capdir == 'Singer Hits/') {
                            $caption = 'images/singer_images';
                        }elseif ($capdir == 'Music Director Hits/') {
                            $caption = 'images/director_images';
                        }
                        $file  = "../".$caption."/".$directorylist[$startdir . $folder]['name'].".txt";
                        if(file_exists($file) == true){
                        $ofile = fopen($file, 'r') or die("Unable to open file!");
                        while ($line = fgets($ofile)) {
                            preg_match_all('/[A-Za-z ]+/', $line, $iname);
                            $response[$iname[0][0]] = new stdClass;
                            $response[$iname[0][0]]->name = $iname[0][0];
                            $directorylist[$startdir . $folder]['caption'] = $response[$iname[0][0]]->name;

                        }
                        }
                       //end of read file 
                    }
                }
            }
            closedir($dh);
        }
    }
    return($directorylist);
}

$list = folderlist($folder);
sort($list);
if ($col == 2 && (count($list) < 20)) {
    $rlist[0] = $list;
    $rlist[1] = '';
} else {
    $count = ceil(count($list) / $col);
    $rlist = array_chunk($list, $count);
}
echo json_encode($rlist);
?>