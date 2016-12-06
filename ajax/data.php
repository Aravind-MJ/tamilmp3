<?php
$root = '..'.DIRECTORY_SEPARATOR.'Filesystem';
$iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
);

// $ite = new RecursiveIteratorIterator(
//         new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
// );


$host = "localhost";
$dbname = "tamilmp3";
$dbuser = "root";
$dbpwd = "";
$link = mysqli_connect($host,$dbuser,$dbpwd,$dbname);
mysqli_query($link,'TRUNCATE Table demo3');
foreach ($iter as $path)
{
   $pathsplit = explode(DIRECTORY_SEPARATOR, $path);
   // $curPath = '';
   // for($i=2;$i<count($pathsplit);$i++){
   //      $curPath .= $pathsplit[$i].'/'; 
   // }
    $max = sizeof($pathsplit);
    $ext = explode('.', $pathsplit[$max - 1]);
        if (array_pop($ext) == "mp3")
        {            
            $album = $pathsplit[count($pathsplit)-2];
            $category = $pathsplit[count($pathsplit)-3];
            $i=4;
            while (((count($pathsplit)-$i)!=1))
            {
            $category = ($pathsplit[count($pathsplit)-$i]).'~'.$category;
              $i++;
            
            }
            $name = implode('.', $ext); 
             $query = sprintf("INSERT INTO demo3(category,mp3name,album,location) VALUES('%s','%s','%s','%s')",$category,$name,$album,$path);
             //print_r($query);
             $result = mysqli_query($link,$query);
        }
}
?>

