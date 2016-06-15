
<?php 
$folders = folderlist('songs2/');
$fullnames=array();
$names1=array("A-Z Movie Songs","New Releases","ILaiyaraja Hits","A R Rahman Hits");
$names2=array("Star Hits","Music Director Hits","Singer Hits");
$names3=array("Old Collections","Old Hits (Singers)","M.S.Viswanathan Hits");
$names4=array("Album Songs","Comedy Dramas","Devotional Collections","Remix Collections","Special Collections","TV Serial Songs");
$names5=array("Birthday Songs","Comedy (Ulta) Songs","Festival Songs","Friendship Songs","Gana Songs","Kuthu Songs","Mothers Special","Songs With Dialogue","Philosophical Songs","Sister Sentiment Songs","Wedding Songs");
$names6=array("Ring Tones","Tamil Karaoke","New Karaoke","Theme Music - Tamil","Theme Music - English");
$kar=0;
foreach ($folders as $folder)
{
	$fullnames[] = $folder['name'];
}

$newrcfile = fopen("textfiles/new.txt", "r") or exit("Unable to open file!");
while(!feof($newrcfile))
{
	$newcfiles[]= str_replace("\n","",fgets($newrcfile));
}
fclose($newrcfile);

displaycat($names1,$fullnames,$newcfiles);
echo '<span class="br">&nbsp;</span>';
displaycat($names2,$fullnames,$newcfiles);
echo '<span class="br">&nbsp;</span>';
displaycat($names6,$fullnames,$newcfiles);
echo '<span class="br">&nbsp;</span>';
displaycat($names3,$fullnames,$newcfiles);
echo '<span class="br">&nbsp;</span>';
displaycat($names4,$fullnames,$newcfiles);
echo '<span class="br">&nbsp;</span>';
displaycat($names5,$fullnames,$newcfiles);


			
function displaycat($newnames,$oldnames, $newcfiles)
{
	foreach($newnames as $catnames)
	{
		if(in_array($catnames,$oldnames))
		{
			$atoz="";
			$name1 =str_replace("&"," and ",$catnames);
			if(substr($catnames, 0, 3)=="A-Z" || $catnames=="ILaiyaraja Hits" || $catnames=="Tamil Karaoke" || $catnames =="M.S.Viswanathan Hits")
			{
				$atoz="&cpage=A";
			}
			if(in_array($catnames, $newcfiles))
			{
				$cattitle=$catnames. ' <img src="images/new.gif" />';
			}
			else
			{
				$cattitle=$catnames;		
			}
			if(isset($_REQUEST['page']) && $_REQUEST['page']==$name1)
			{echo '<a class="current" href="index.php?page='.$name1."".$atoz.'">'.$cattitle.'</a>';}
			else
			{echo '<a href="index.php?page='.$name1."".$atoz.'">'.$cattitle.'</a>';}
		}
	}
}


/*
foreach ($folders as $folder)
{
	$path = $folder['path'];
	$name = $folder['name'];
	$atoz="";
	$name1 =str_replace("&"," and ",$name);
	if(substr($name, 0, 3)=="A-Z" || $name=="ILaiyaraja Hits")
	{
		$atoz="&cpage=A";
	}
	if(isset($_REQUEST['page']) && $_REQUEST['page']==$name1)
	{echo '<a class="current" href="index.php?page='.$name1."".$atoz.'">'.$name.'</a>';}
	else
	{echo '<a href="index.php?page='.$name1."".$atoz.'">'.$name.'</a>';}
}*/

?>
