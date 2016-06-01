<?php

$param = json_decode(file_get_contents("php://input"));
$searchTerm = $param->search;
//$searchTerm = 'a';
$root = '..\FileSystem';
//$searchTerm = "A";

$iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
);

function check($string, $searchTerm) {
    if (strpos(strtolower($string), strtolower($searchTerm)) !== false) {
        return true;
    }
    return false;
}

$result = array();
$result[0] = array();
$result[1] = array();
foreach ($iter as $path => $dir) {
    if ($dir->isDir()) {
        $pathsplit = explode('\\', $path);
        $max = sizeof($pathsplit);
        if (check($pathsplit[$max - 1], $searchTerm) && $max > 3) {
            if (!isset($result[0][$pathsplit[$max - 2]])) {
                $result[0][$pathsplit[$max - 2]] = new stdClass();
            }
            $result[0][$pathsplit[$max - 2]]->in = $pathsplit[$max - 2];
            $result[0][$pathsplit[$max - 2]]->albums[] = $pathsplit[$max - 1];
        }
    } else {
        $pathsplit = explode('\\', $path);
        $max = sizeof($pathsplit);
        $ext = explode('.', $pathsplit[$max - 1]);
        if (array_pop($ext) == "mp3") {
            $name = implode('.', $ext);
            if (check($name, $searchTerm)) {
                if (!isset($result[1][$pathsplit[$max - 3]])) {
                    $result[1][$pathsplit[$max - 3]] = new stdClass();
                    $result[1][$pathsplit[$max - 3]]->name = $pathsplit[$max - 3];
                    $result[1][$pathsplit[$max - 3]]->albums = array();
                }
                if (!isset($result[1][$pathsplit[$max - 3]]->albums[$pathsplit[$max - 2]])) {
                    $result[1][$pathsplit[$max - 3]]->albums[$pathsplit[$max - 2]] = new stdClass();
                    $result[1][$pathsplit[$max - 3]]->albums[$pathsplit[$max - 2]]->name = $pathsplit[$max - 2];
                    $result[1][$pathsplit[$max - 3]]->albums[$pathsplit[$max - 2]]->songs = array();
                }
                $result[1][$pathsplit[$max - 3]]->albums[$pathsplit[$max - 2]]->songs[] = $pathsplit[$max - 1];
            }
        }
    }
}

sort($result[0]);
sort($result[1]);
//die();
echo json_encode($result);
?>