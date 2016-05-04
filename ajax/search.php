<?php
$param = json_decode(file_get_contents("php://input"));
$searchTerm = $param->search;
$root = '..\FileSystem';
//$searchTerm = "A";

$iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
);

function check($string, $searchTerm) {
    if (strpos($string, ucwords($searchTerm)) !== false) {
        return true;
    }
    if (strpos($string, strtolower($searchTerm)) !== false) {
        return true;
    }
    if (strpos($string, strtoupper($searchTerm)) !== false) {
        return true;
    }

    return false;
}

$result = array();
foreach ($iter as $path => $dir) {
    if ($dir->isDir()) {
        $pathsplit = explode('\\', $path);
        $max = sizeof($pathsplit);
        if (check($pathsplit[$max - 1], $searchTerm) && $max > 3) {
            if (!isset($result[$pathsplit[$max - 2]])) {
                $result[$pathsplit[$max - 2]] = new stdClass();
            }
            $result[$pathsplit[$max - 2]]->in = $pathsplit[$max - 2];
            $result[$pathsplit[$max - 2]]->albums[] = $pathsplit[$max - 1];
        }
//        var_dump($path);
//        echo '<br>';
    }
}
echo json_encode($result);
?>