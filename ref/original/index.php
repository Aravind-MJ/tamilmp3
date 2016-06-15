<?php
ob_start(); 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-control" content="public">
<meta name="propeller" content="33139d64c50b7e0221fcc64bd8e621ca" />
<?php include('metatags.php'); ?>

<link rel="shortcut icon" href="images/fav2.png" />
<link href='http://fonts.googleapis.com/css?family=Quando|Courgette|Merienda+One|Mystery+Quest|Homenaje' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.sticky.js"></script>
<script>
  $(document).ready(function(){
    $("#sticker").sticky({ topSpacing: 300 });
  });
</script> 
  <style>
    body {
      height: 500px;
      padding: 0;
      margin: 0;
    }

    #sticker {
     
    }
  </style>
</head>

<body onload="playwhenload();">
<?php include_once("analyticstracking.php") ?>
 
<?php 
require_once('getid3/getid3.php');
/*
if(!isset($_REQUEST['page']))
{
header('Location: index.php?page=A-Z%20Movie%20Songs&cpage=A');
}*/
//echo 'Hello '.(isset($_COOKIE['filepath']) ? $_COOKIE['filepath'] : 'Guest');
include("functions.php"); ?>
<form name="mainform" action="searchalbum.php" method="post" onsubmit="return validations();">
<input type="hidden" name="useraddr" id="useraddr" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="footer">
  <tr>
    <td align="center" valign="top"><table width="900" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top"><img src="images/logo.jpg" width="600" height="161" /></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top">

<!--<img src="images/banner-bg.jpg" width="900" height="257" />--></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="menu">
          <tr>
            <td><a href="index.php" class="current">Home</a> | <a href="http://www.friendstamilmp3.com/chat" target="_blank">Chat</a> | <a href="http://www.friendstamilchat.com/forum" target="_blank">Forum</a> | <a href="http://www.friendstamilchat.com/fm" target="_blank">FM</a> | <a href="comments.php">Comments</a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  align="left" valign="top" id="searchbox">
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3" align="left" valign="top"><h2>Search Movies / Albums / Songs</h2></td>
                </tr>
                   <tr>
                <td width="24%" align="left" valign="top">&nbsp;</td>
                <td width="55%" align="left" valign="top" class="chckbox">
                <input type="radio" name="searchtype" checked="checked" value="movie" /> Movie / Album
                <input type="radio" name="searchtype" value="song" /> Song</td>
                <td width="21%" align="left" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><label>
                  <input type="text" name="txtsearch" class="txtbox" id="txtsearch" />
                </label></td>
                <td align="left" valign="top"><input type="submit" name="buttonsearch" id="buttonsearch" value="Search" class="but" /></td>
              </tr>
            </table>                      </td>
            <td align="right" valign="top"><div class="playerclass" id="players">              
<object type="application/x-shockwave-flash" data="player/player_mp3_multi.swf" width="359" height="119">
    <param name="movie" value="player/player_mp3_multi.swf" />
    <param name="bgcolor" value="#000000" />
    <param name="FlashVars" value="mp3=http%3A//www.friendstamilmp3.com/songs2/A-Z%20Movie%20Songs/Kaadhal%20Solla%20Vandhen/Chenbarathy%20Poove.mp3|http%3A//www.friendstamilmp3.com/songs2/A-Z%20Movie%20Songs/Kaadhalar%20Thinam/Kadhalenum.mp3&amp;title=Sembaruthi poove|Kadhalenum thervezhuthi&amp;width=359&amp;height=119&amp;showvolume=1&amp;sliderheight=13&amp;volumewidth=50&amp;volumeheight=8&amp;bgcolor1=5a0334&amp;bgcolor2=af0e6d&amp;slidercolor1=ff5db1&amp;slidercolor2=ef017c&amp;sliderovercolor=fe58ae" />
</object></div></td>
          </tr>
          <tr>
            <td  align="left" valign="top" id="searchbox2">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="27%" align="left" valign="top">
            <table cellpadding="0" cellspacing="0" border="0">
            <tr><td>


</td></tr>
            <tr><td>&nbsp;</td></tr>
            </table>
            <table width="243" border="0" cellspacing="0" cellpadding="0" class="pinkmenu">
              <tr>
                <td align="left" valign="top"><h3>Categories</h2></td>
              </tr>
              
              <tr>
                <td align="left" valign="top">
                <?php include("category.php"); ?></td>
              </tr>
              
            </table>           </td>
            <td width="2%" align="left" valign="top">&nbsp;</td>
            <td width="71%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td align="left" valign="top">
				<div id="sticker">
<a target="_blank" href="http://www.friendstamilmp3.com/chat/">
				<img align="right" src="/chat1.png"/></a> 
				
				</div>
				<?php 
				if(!isset($_REQUEST['page']))
				{include("home.php");}
				else
			
				{ include("lists.php"); } ?></td>
              </tr>
			  <tr>
                <td align="left" valign="top">
				
				<tr>
           </td> </table>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="menu">
          <tr>
            <td align="center">&copy; Copyright - <?php echo date("Y") ?> <a href="#">FriendsTamilMp3.com</a>. All rights reserved.</td>
          </tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
  
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
</table>
</form>

</body>
</html>
