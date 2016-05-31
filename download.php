<?php

if (isset($_POST)) {
    $filesToSend = $_POST['files'];
    $album = $_POST['album_name'];
    if (count($filesToSend) > 0) {
        $zipname = $album.".zip";
        $zip = new ZipArchive();
        $res = $zip->open($zipname, ZipArchive::CREATE);

        if ($res === TRUE) {

            foreach ($filesToSend as $file) {

                $zip->addFile($file,pathinfo($file, PATHINFO_BASENAME));
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
    }
}
?>