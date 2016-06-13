<?php

if (isset($_POST)) {
    $filesToSend = $_POST['files'];

    $path = explode('/', $filesToSend[0]);
    array_pop($path);
    $max = sizeof($path);
    $loc = "Album/" . $path[$max - 3] . "/" . $path[$max - 2];
    $path = implode('/', $path);

    $album = $_POST['album_name'];
    if (count($filesToSend) > 0) {
        $zipname = $album . ".zip";
        $zip = new ZipArchive();
        $res = $zip->open($zipname, ZipArchive::CREATE);

        if ($res === TRUE) {

            foreach ($filesToSend as $file) {

                $zip->addFile($file, pathinfo($file, PATHINFO_BASENAME));
            }
        } else {

            echo 'failed, code:' . $res;
        }

        $zip->close();

        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-type: application/zip");
        header('Content-length: ' . filesize($zipname));
        header('Content-disposition: attachment; filename=' . basename($zipname));
        ob_clean();
        flush();
        readfile($zipname);
        @unlink($zipname);

        if (!is_dir("DownloadCount")) {
            mkdir("DownloadCount");
        }

        $cfile_name = "DownloadCount/" . $album . ".txt";
        if (file_exists($cfile_name)) {
            $cfile = fopen($cfile_name, "r");
            $count = fread($cfile, filesize($cfile_name));
            fclose($cfile);
            if (!is_numeric($count)) {
                $count = 0;
                $lfile = fopen("DownloadCount/log.txt", "a");
                fwrite($lfile, date('d/m/Y - h:m:s') . " - " . $album . ".txt File Corrupted. Count Restarted." . PHP_EOL);
                fclose($lfile);
            }
            $count++;
            echo $album . ' Count = ' . $count;
            $cfile = fopen($cfile_name, "w");
            fwrite($cfile, $count);
        } else {
            $count = 1;
            $cfile = fopen($cfile_name, "w");
            fwrite($cfile, $count);
            fclose($cfile);
            $lfile = fopen("DownloadCount/log.txt", "a");
            fwrite($lfile, date('d/m/Y - h:m:s') . " - Created file for " . $album . PHP_EOL);
            fclose($lfile);
        }

        $tfile_name = "DownloadCount/toplist.txt";
        $top_array = array();
        if (file_exists($tfile_name)) {
            $tfile = fopen($tfile_name, "r");
            if (filesize($tfile_name) > 0) {
                $content = fread($tfile, filesize($tfile_name));
                $top_array = unserialize($content);
            } else {
                $top_array = array();
            }

            if (!is_array($top_array)) {
                $top_array = array();
                $lfile = fopen("DownloadCount/log.txt", "a");
                fwrite($lfile, date('d/m/Y - h:m:s') . " - Toplist File Corrupted. Top list Restarted." . PHP_EOL);
                fclose($lfile);
            }

            if (isset($top_array[$album])) {
                $top_array[$album]->count = $count;
            } else {
                if (sizeof($top_array) == 4) {
                    $least = PHP_INT_MAX;
                    foreach ($top_array as $value) {
                        if ($value->count < $least) {
                            $least = $value->count;
                            $least_key = $value->name;
                        }
                    }
                    if ($least < $count) {
                        unset($top_array[$least_key]);
                        $top_array[$album] = new stdClass();
                        $top_array[$album]->name = $album;
                        $top_array[$album]->count = $count;
                        $top_array[$album]->path = $path;
                        $top_array[$album]->loc = $loc;
                    }
                } else {
                    $top_array[$album] = new stdClass();
                    $top_array[$album]->name = $album;
                    $top_array[$album]->count = $count;
                    $top_array[$album]->path = $path;
                    $top_array[$album]->loc = $loc;
                }
            }
            $content = serialize($top_array);
            $tfile = fopen($tfile_name, "w");
            fwrite($tfile, $content);
        } else {
            $top_array[$album] = new stdClass();
            $top_array[$album]->name = $album;
            $top_array[$album]->count = $count;
            $top_array[$album]->path = $path;
            $top_array[$album]->loc = $loc;
            $content = serialize($top_array);
            $tfile = fopen($tfile_name, "w");
            fwrite($tfile, $content);
        }
        fclose($tfile);
    }
}
?>