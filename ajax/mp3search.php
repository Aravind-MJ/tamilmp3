<?php
//$param = json_decode(file_get_contents("php://input"));
$searchTerm = "I";
$host = "localhost";
$dbname = "tamilmp3";
$dbuser = "root";
$dbpwd = "";
$link = mysqli_connect($host,$dbuser,$dbpwd,$dbname);
$result = array();
$result[0] = array();
$result[1] = array();
$ai = 0;
$albums_limit = 0;
$songs_limit = 0;
$limit = 399;

//$sql = "SELECT * FROM demo3 WHERE mp3name LIKE'%$name%' or album LIKE'%$name%'";
//$result1 = $link->query($sql);
foreach ($link->query("SELECT * FROM demo3 WHERE mp3name LIKE'%$searchTerm%' or album LIKE'%$searchTerm%'") as $row)
{
    
        if($albums_limit>$limit){
            if($songs_limit>$limit){
                break;
            }else{
                continue;
            }
        }
       if (!isset($result[0][$row['album']])) {
                $result[0][$row['album']] = new stdClass();
                $ai = 0;
            $result[0][$row['album']]->in = $row['album'];
//            $highlighted = str_ireplace($searchTerm, "<span class='highlight'>" . $searchTerm . "</span>", $row['mp3name']);
            $highlighted = preg_replace('#' . preg_quote($searchTerm) . '#i', "<span class='highlight'>\\0</span>", $row['mp3name']);
            $result[0][$row['album']]->albums[$ai] = new stdClass();
            $result[0][$row['album']]->albums[$ai]->name = $row['mp3name'];
            $result[0][$row['album']]->albums[$ai]->show = $highlighted;
            $ai++;
            $albums_limit++;
        
        }
       elseif($songs_limit>$limit){
            if($albums_limit>$limit){
                break;
            }else{
                continue;
            }
        }
        
       
            
                if (!isset($result[1][$row['category']])) {
                    $result[1][$row['category']] = new stdClass();
                    $result[1][$row['category']]->name = $row['category'];
                    $result[1][$row['category']]->albums = array();
                }
                if (!isset($result[1][$row['category']]->albums[$row['album']])) {
                    $result[1][$row['category']]->albums[$row['album']] = new stdClass();
                    $result[1][$row['category']]->albums[$row['album']]->name = $row['album'];
                    $result[1][$row['category']]->albums[$row['album']]->songs = array();
                }
//                $highlighted = str_ireplace($searchTerm, "<span class='highlight'>" . $searchTerm . "</span>", $row['mp3name']);
                $highlighted = preg_replace('#' . preg_quote($searchTerm) . '#i', "<span class='highlight'>\\0</span>", $row['mp3name']);
                $result[1][$row['category']]->albums[$row['album']]->songs[] = $highlighted;
                $songs_limit++;
           
        
    }

//sort($result[0]);
//sort($result[1]);
print_r($result);
//die();
//echo json_encode($result);

?>