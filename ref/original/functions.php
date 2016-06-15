<?php
function folderlist($startdir){  
  $ignoredDirectory[] = '.'; 
  $ignoredDirectory[] = '..';
  $directorylist='';
   if (is_dir($startdir)){
	   if ($dh = opendir($startdir)){
		   while (($folder = readdir($dh)) !== false){
			   if (!(array_search($folder,$ignoredDirectory) > -1)){
				 if (filetype($startdir . $folder) == "dir"){
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
function songslist($startdir){  
  $ignoredDirectory[] = '.'; 
  $ignoredDirectory[] = '..';
  $mp3songs='';
   if (is_dir($startdir)){
	   if ($dh = opendir($startdir)){
		   while (($folder = readdir($dh)) !== false){
			   if (!(array_search($folder,$ignoredDirectory) > -1)){
				   if(filetype($startdir . $folder) == "file"){
					   $mp3songs[$startdir . $folder]['name'] = $folder;
					   $mp3songs[$startdir . $folder]['path'] = $startdir;
				   }
			   }
		   }
		   closedir($dh);
	   }
   }
return($mp3songs);
}
function fnSimpleXMLCreate($paths)
    {
               
        $library = new SimpleXMLElement('<songs />');        
		$songliests=songslist($paths);		
		if($songliests!="")
		{
			foreach ($songliests as $filen)
			{
				//$songnames[]= $filen['name'];
				//$songlistpath[]= $filen['path'];
				if(strtolower(substr($filen['name'], strlen($filen['name']) - 3, 3)) == "mp3") 
				{
				$arr = array('songname'=>$filen['name'], 'likes'=>'100');
				$book = $library->addChild('song');
				$book->addAttribute('songname', $arr['songname']);
				$book->addChild('likes', $arr['likes']);
				}
			}
		}
		
        /*for($i=0;$i<3;$i++)
        {
            $book = $library->addChild('song');
            $book->addAttribute('songname', $arr[$i]['songname']);
            $book->addChild('likes', $arr[$i]['likes']);
        }*/
       
        $library->asXML($paths.'details.xml');
    }
	
//Edit Title of book with author J.R.R.Tolkein

function fnSimpleXMLEditElementCond()
{
	$library = new SimpleXMLElement('library.xml',null,true);
	$book = $library->xpath('/library/book[author="J.R.R.Tolkein"]');
	$book[0]->title .= ' Series';
	header("Content-type: text/xml");
	echo $library->asXML();
}


function tagReader($file){
$id3v23 = array("TIT2","TALB","TPE1","TRCK","TDRC","TLEN","USLT");
$id3v22 = array("TT2","TAL","TP1","TRK","TYE","TLE","ULT");
$fsize = filesize($file);
$fd = fopen($file,"r");
$tag = fread($fd,$fsize);
$tmp = "";
fclose($fd);
if (substr($tag,0,3) == "ID3") {
    $result['FileName'] = $file;
    $result['TAG'] = substr($tag,0,3);
    $result['Version'] =    hexdec(bin2hex(substr($tag,3,1))).".".hexdec(bin2hex(substr($tag,4,1)));
}
if($result['Version'] == "4.0" || $result['Version'] == "3.0"){
    for ($i=0;$i<count($id3v23);$i++){
        if (strpos($tag,$id3v23[$i].chr(0))!= FALSE){
            $pos = strpos($tag, $id3v23[$i].chr(0));
            $len = hexdec(bin2hex(substr($tag,($pos+5),3)));
            $data = substr($tag, $pos, 10+$len);
            for ($a=0;$a<strlen($data);$a++){
                $char = substr($data,$a,1);
                if($char >= " " && $char <= "~") $tmp.=$char;
            }
            if(substr($tmp,0,4) == "TIT2") $result['Title'] = substr($tmp,4);
            if(substr($tmp,0,4) == "TALB") $result['Album'] = substr($tmp,4);
            if(substr($tmp,0,4) == "TPE1") $result['Author'] = substr($tmp,4);
            if(substr($tmp,0,4) == "TRCK") $result['Track'] = substr($tmp,4);
            if(substr($tmp,0,4) == "TDRC") $result['Year'] = substr($tmp,4);
            if(substr($tmp,0,4) == "TLEN") $result['Length'] = substr($tmp,4);
            if(substr($tmp,0,4) == "USLT") $result['Lyric'] = substr($tmp,7);
            $tmp = "";
        }
    }
}
if($result['Version'] == "2.0"){
    for ($i=0;$i<count($id3v22);$i++){
        if (strpos($tag,$id3v22[$i].chr(0))!= FALSE){
            $pos = strpos($tag, $id3v22[$i].chr(0));
            $len = hexdec(bin2hex(substr($tag,($pos+3),3)));
            $data = substr($tag, $pos, 6+$len);
            for ($a=0;$a<strlen($data);$a++){
                $char = substr($data,$a,1);
                if($char >= " " && $char <= "~") $tmp.=$char;
            }
            if(substr($tmp,0,3) == "TT2") $result['Title'] = substr($tmp,3);
            if(substr($tmp,0,3) == "TAL") $result['Album'] = substr($tmp,3);
            if(substr($tmp,0,3) == "TP1") $result['Author'] = substr($tmp,3);
            if(substr($tmp,0,3) == "TRK") $result['Track'] = substr($tmp,3);
            if(substr($tmp,0,3) == "TYE") $result['Year'] = substr($tmp,3);
            if(substr($tmp,0,3) == "TLE") $result['Lenght'] = substr($tmp,3);
            if(substr($tmp,0,3) == "ULT") $result['Lyric'] = substr($tmp,6);
            $tmp = "";
        }
    }
}
return $result;
}

    function getID3($filename=NULL)
    {
    $FrameData = array('AENC'=>'Audio encryption', 'APIC'=>'Attached picture', 'COMM'=>'Comments', 'COMR'=>'Commercial frame', 'ENCR'=>'Encryption method registration', 'EQUA'=>'Equalization', 'ETCO'=>'Event timing codes', 'GEOB'=>'General encapsulated object', 'GRID'=>'Group identification registration', 'IPLS'=>'Involved people list', 'LINK'=>'Linked information', 'MCDI'=>'Music CD identifier', 'MLLT'=>'MPEG location lookup table', 'OWNE'=>'Ownership frame', 'PRIV'=>'Private frame', 'PCNT'=>'Play counter', 'POPM'=>'Popularimeter', 'POSS'=>'Position synchronisation frame', 'RBUF'=>'Recommended buffer size', 'RVAD'=>'Relative volume adjustment', 'RVRB'=>'Reverb', 'SYLT'=>'Synchronized lyric/text', 'SYTC'=>'Synchronized tempo codes', 'TALB'=>'Album/Movie/Show title', 'TBPM'=>'BPM (beats per minute)', 'TCOM'=>'Composer', 'TCON'=>'Content type', 'TCOP'=>'Copyright message', 'TDAT'=>'Date', 'TDLY'=>'Playlist delay', 'TENC'=>'Encoded by', 'TEXT'=>'Lyricist/Text writer', 'TFLT'=>'File type', 'TIME'=>'Time', 'TIT1'=>'Content group description', 'TIT2'=>'Title/songname/content description', 'TIT3'=>'Subtitle/Description refinement', 'TKEY'=>'Initial key', 'TLAN'=>'Language(s)', 'TLEN'=>'Length', 'TMED'=>'Media type', 'TOAL'=>'Original album/movie/show title', 'TOFN'=>'Original filename', 'TOLY'=>'Original lyricist(s)/text writer(s)', 'TOPE'=>'Original artist(s)/performer(s)', 'TORY'=>'Original release year', 'TOWN'=>'File owner/licensee', 'TPE1'=>'Lead performer(s)/Soloist(s)', 'TPE2'=>'Band/orchestra/accompaniment', 'TPE3'=>'Conductor/performer refinement', 'TPE4'=>'Interpreted, remixed, or otherwise modified by', 'TPOS'=>'Part of a set', 'TPUB'=>'Publisher', 'TRCK'=>'Track number/Position in set', 'TRDA'=>'Recording dates', 'TRSN'=>'Internet radio station name', 'TRSO'=>'Internet radio station owner', 'TSIZ'=>'Size', 'TSRC'=>'ISRC (international standard recording code)', 'TSSE'=>'Software/Hardware and settings used for encoding', 'TYER'=>'Year', 'TXXX'=>'User defined text information frame', 'UFID'=>'Unique file identifier', 'USER'=>'Terms of use', 'USLT'=>'Unsychronized lyric/text transcription', 'WCOM'=>'Commercial information', 'WCOP'=>'Copyright/Legal information', 'WOAF'=>'Official audio file webpage', 'WOAR'=>'Official artist/performer webpage', 'WOAS'=>'Official audio source webpage', 'WORS'=>'Official internet radio station homepage', 'WPAY'=>'Payment', 'WPUB'=>'Publishers official webpage', 'WXXX'=>'User defined URL link frame');
    $Genres = array(0 => 'Blues', 1 => 'Classic Rock', 2 => 'Country', 3 => 'Dance', 4 => 'Disco', 5 => 'Funk', 6 => 'Grunge', 7 => 'Hip-Hop', 8 => 'Jazz', 9 => 'Metal', 10 => 'New Age', 11 => 'Oldies', 12 => 'Other', 13 => 'Pop', 14 => 'R&B', 15 => 'Rap', 16 => 'Reggae', 17 => 'Rock', 18 => 'Techno', 19 => 'Industrial', 20 => 'Alternative', 21 => 'Ska', 22 => 'Death Metal', 23 => 'Pranks', 24 => 'Soundtrack', 25 => 'Euro-Techno', 26 => 'Ambient', 27 => 'Trip-Hop', 28 => 'Vocal', 29 => 'Jazz+Funk', 30 => 'Fusion', 31 => 'Trance', 32 => 'Classical', 33 => 'Instrumental', 34 => 'Acid', 35 => 'House', 36 => 'Game', 37 => 'Sound Clip', 38 => 'Gospel', 39 => 'Noise', 40 => 'Alternative Rock', 41 => 'Bass', 42 => 'Soul', 43 => 'Punk', 44 => 'Space', 45 => 'Meditative', 46 => 'Instrumental Pop', 47 => 'Instrumental Rock', 48 => 'Ethnic', 49 => 'Gothic', 50 => 'Darkwave', 51 => 'Techno-Industrial', 52 => 'Electronic', 53 => 'Pop-Folk', 54 => 'Eurodance', 55 => 'Dream', 56 => 'Southern Rock', 57 => 'Comedy', 58 => 'Cult', 59 => 'Gangsta', 60 => 'Top 40', 61 => 'Christian Rap', 62 => 'Pop/Funk', 63 => 'Jungle', 64 => 'Native US', 65 => 'Cabaret', 66 => 'New Wave', 67 => 'Psychadelic', 68 => 'Rave', 69 => 'Showtunes', 70 => 'Trailer', 71 => 'Lo-Fi', 72 => 'Tribal', 73 => 'Acid Punk', 74 => 'Acid Jazz', 75 => 'Polka', 76 => 'Retro', 77 => 'Musical', 78 => 'Rock & Roll', 79 => 'Hard Rock', 80 => 'Folk', 81 => 'Folk-Rock', 82 => 'National Folk', 83 => 'Swing', 84 => 'Fast Fusion', 85 => 'Bebob', 86 => 'Latin', 87 => 'Revival', 88 => 'Celtic', 89 => 'Bluegrass', 90 => 'Avantgarde', 91 => 'Gothic Rock', 92 => 'Progressive Rock', 93 => 'Psychedelic Rock', 94 => 'Symphonic Rock', 95 => 'Slow Rock', 96 => 'Big Band', 97 => 'Chorus', 98 => 'Easy Listening', 99 => 'Acoustic', 100 => 'Humour', 101 => 'Speech', 102 => 'Chanson', 103 => 'Opera', 104 => 'Chamber Music', 105 => 'Sonata', 106 => 'Symphony', 107 => 'Booty Bass', 108 => 'Primus', 109 => 'Porn Groove', 110 => 'Satire', 111 => 'Slow Jam', 112 => 'Club', 113 => 'Tango', 114 => 'Samba', 115 => 'Folklore', 116 => 'Ballad', 117 => 'Power Ballad', 118 => 'Rhytmic Soul', 119 => 'Freestyle', 120 => 'Duet', 121 => 'Punk Rock', 122 => 'Drum Solo', 123 => 'Acapella', 124 => 'Euro-House', 125 => 'Dance Hall', 126 => 'Goa', 127 => 'Drum & Bass', 128 => 'Club-House', 129 => 'Hardcore', 130 => 'Terror', 131 => 'Indie', 132 => 'BritPop', 133 => 'Negerpunk', 134 => 'Polsk Punk', 135 => 'Beat', 136 => 'Christian Gangsta', 137 => 'Heavy Metal', 138 => 'Black Metal', 139 => 'Crossover', 140 => 'Contemporary C', 141 => 'Christian Rock', 142 => 'Merengue', 143 => 'Salsa', 144 => 'Thrash Metal', 145 => 'Anime', 146 => 'JPop', 147 => 'SynthPop');
     
    if (strtoupper($filename)=="GETFRAMES")
    RETURN $FrameData;
    if (strtoupper($filename)=="GETGENRES")
    RETURN $Genres;
     
    if (!$ID3Header = file_get_contents($filename,NULL,NULL,0,5000))
    trigger_error("File not found in getID3",E_USER_ERROR);
     
    $OutChar = $OutNum = $Explode = $ASCII = NULL;
    for ($i=0;$i<=strlen($ID3Header);$i++)
    {
    $ThisChar = substr($ID3Header,$i,1);
    if (ord($ThisChar)>31 && ord($ThisChar)<127)
    $ASCII .= $ThisChar;
    }
    //Detect the frame's start
    foreach($FrameData as $k => $v)
    {
    $FrameStart[$k] = stripos($ASCII,$k)+strlen($k);
    if ($FrameStart[$k]==4)
    unset($FrameStart[$k]);
    }
    //Detect conflicting frame to find end of frame
    foreach($FrameStart as $FSKey => $FSValue)
    {
    $ThisFrame = substr($ASCII,$FSValue,80);
    $LastCheck=80;
     
    foreach($FrameData as $k => $v)
    {
    if (stripos($ThisFrame,$k)<=$LastCheck && stripos($ThisFrame,$k)>0)
    $LastCheck = stripos($ThisFrame,$k);
    }
    $FrameLength[$FSKey] = $LastCheck;
    }
    foreach($FrameStart as $k => $v)
    {
    $FrameOut[$FrameData[$k]] = trim(substr($ASCII,$v,$FrameLength[$k]));
    $FrameOut[$k] = trim(substr($ASCII,$v,$FrameLength[$k]));
    }
    RETURN $FrameOut;
    }
	
function download_file($file_name) {

    if (!file_exists($file_name)) { die("<b>404 File not found!</b>"); }
   
    $file_extension = strtolower(substr(strrchr($file_name,"."),1));
    $file_size = filesize($file_name);
    $md5_sum = md5_file($file_name);
   
   //This will set the Content-Type to the appropriate setting for the file
    switch($file_extension) {
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "mpg":$ctype="video/mpeg"; break;
        case "avi": $ctype="video/x-msvideo"; break;

        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html":
        case "txt": die("<b>Cannot be used for ". $file_extension ." files!</b>"); break;

        default: $ctype="application/force-download";
    }
   
    if (isset($_SERVER['HTTP_RANGE'])) {
        $partial_content = true;
        $range = explode("-", $_SERVER['HTTP_RANGE']);
        $offset = intval($range[0]);
        $length = intval($range[1]) - $offset;
    }
    else {
        $partial_content = false;
        $offset = 0;
        $length = $file_size;
    }
   
    //read the data from the file
    $handle = fopen($file_name, 'r');
    $buffer = '';
    fseek($handle, $offset);
    $buffer = fread($handle, $length);
    $md5_sum = md5($buffer);
    if ($partial_content) $data_size = intval($range[1]) - intval($range[0]);
    else $data_size = $file_size;
    fclose($handle);
   
    // send the headers and data
    header("Content-Length: " . $data_size);
    header("Content-md5: " . $md5_sum);
    header("Accept-Ranges: bytes");   
    if ($partial_content) header('Content-Range: bytes ' . $offset . '-' . ($offset + $length) . '/' . $file_size);
    header("Connection: close");
    header("Content-type: " . $ctype);
    header('Content-Disposition: attachment; filename=' . $file_name);
    echo $buffer;
    flush();
} 

function isPartUppercase($string) {
    return (bool) preg_match('/[A-Z]/', $string);
}

?>
