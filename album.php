<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]>
<html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>
<html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>
<html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>
<html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<?php
$css_inc = array(
    'font-awsome' => 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
    'bootstrap-css' => 'css/bootstrap.css',
    'style-css' => 'style.css',
    'responsive-css' => 'css/responsive.css',
    'jplayer-css'    => 'plugin/jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css'

);

$js_inc = array(
    'jquery' => 'https://code.jquery.com/jquery.min.js',
    'bootstrap-js' => 'js/bootstrap.min.js',
    'polyfill' => 'js/ie-opacity-polyfill.js',
    'theme-js'         => 'js/main.js',
    'jplayer'          => 'plugin/jplayer/dist/jplayer/jquery.jplayer.min.js',
    'jplayer-playlist' => 'plugin/jplayer/dist/add-on/jplayer.playlist.min.js'
);

include_once 'autoload.php';
$autoload = new Autoload();
$autoload->title = 'Tamil MP3';
$autoload->css_inc = $css_inc;
$autoload->js_inc = $js_inc;

?>

<?php include('header.php'); ?>

<body>

<!-- NAVIGATION -->
<?php include('nav.php'); ?>


<section class="main_news_wrapper cc_single_post_wrapper">
<div class="container">
<div class="row">
<?php include_once('left-menu.php'); ?>
<?php
    $movieId    = isset($_GET['id']) ? $_GET['id'] : 0;
    //get movie name, year and director
    $sqlMovie = sprintf("SELECT m.id, m.year,m.name as mname, d.name FROM movies m
        LEFT JOIN movie_directed_by mdb ON m.id = mdb.movie_id
        LEFT JOIN directors d ON mdb.director_id = d.id WHERE m.id = '%s'", $movieId);
    $resultMovies    = mysqli_query($link, $sqlMovie);
    $movieRow        = mysqli_fetch_assoc($resultMovies);
    $movieName       = isset($movieRow['mname']) ? $movieRow['mname'] : '';
    $movieYear       = isset($movieRow['year']) ? $movieRow['year'] : '';
    $directorName    = isset($movieRow['name']) ? $movieRow['name'] : '';

    $songArray       = array();
    $songIdArray     = array();
    $songPlaylist    = array();
    $sqlSong         = sprintf("SELECT * FROM songs s WHERE movie_id = '%s'", $movieId);
    $resultSong    = mysqli_query($link, $sqlSong);
    if (mysqli_num_rows($resultSong) > 0) {
        while ($songRow = mysqli_fetch_assoc($resultSong)) {
            $songIdArray[] = $songRow['id'];
            $songArray[] = array(
                'song_id'   => $songRow['id'],
                'song_name' => $songRow['name'],
                'song_file' => $songRow['file']
            );
            $songPlaylist[] = array('title' => $songRow['name'], 'mp3' => 'admin/upload/'.$movieName.'/'.$songRow['file']);

        }
    }

    $songString  = "'" . implode("','", $songIdArray) . "'";
    $singerArray = array();

    $sqlSungBy      = sprintf("SELECT s.name FROM sung_by sb JOIN singers s ON sb.singer_id = s.id WHERE song_id IN(%s)", $songString);
    $resultSungBy   = mysqli_query($link, $sqlSungBy);

    if (mysqli_num_rows($resultSungBy) > 0) {
        while ($sungByRow = mysqli_fetch_assoc($resultSungBy)) {
            $singerArray[] = $sungByRow['name'];
        }
    }

    $singers = implode(',', $singerArray);




?>

<div class="col-md-9 movie_ft">
    <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="fs_news_left ht_fs_news_left m-t-f-p">
            <div class="single_fs_news_left_text">
                <div class="single_fs_news_lft_img_h2">
                    <img src="images/movie-name.jpg" alt="Friends Tamil Mp3">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="single_fs_news_right_text m-t-f-p">
            <h2><a href="#"> <?php echo $movieName;?> </a></h2>


            <p>Starring : <?php //echo $singers;?></p>

            <p>Music Director : Ilaiyaraaja</p>

            <p>Singers : <?php echo $singers;?></p>

            <p>Director : <?php echo $directorName;?></p>

            <p>Year : <?php echo $movieYear;?></p>
        </div>
    </div>

    <div class="col-md-5">
        <div id="jp-player" >
            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
            <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <div class="jp-controls">
                            <button class="jp-play" role="button" tabindex="0">play</button>
                            <button class="jp-stop" role="button" tabindex="0">stop</button>
                        </div>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-controls">
                            <button class="jp-mute" role="button" tabindex="0">mute</button>
                            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                            <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                            <div class="jp-toggles">
                                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                            </div>
                        </div>
                    </div>
                    <div class="jp-details">
                        <div class="jp-title" aria-label="title">&nbsp;</div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
        </div>
        <div id="jplayer-affix">

        </div>
    </div>
</div>


<div class="col-md-9 playlist-section">

    <div class="col-md-4">
        <ul class="buttons-list">
            <li><a class="btn small" href="javascript:;"><i class="icon icon-download"><img
                            src="images/play-but.png"></i> Play</a>
            </li>
        </ul>
    </div>

    <div class="col-md-4">
        <ul class="buttons-list">
            <li><a class="btn small" href="javascript:;"><i class="icon icon-download"><img
                            src="images/add-but.png"></i> Add to Playlist </a>
            </li>
        </ul>
    </div>

    <div class="col-md-4 ">
        <ul class="buttons-list">
            <li><a class="btn small" href="javascript:;"><i class="icon icon-download"><img src="images/dl-but.png"></i>
                    Download </a>
            </li>
        </ul>
    </div>

</div>

<form action="#">

    <div class="col-md-9 select-section">
        <div class="col-md-1 col-md-1 col-xs-1 col-sm-1"><input type="checkbox" id="checkAll"/></div>
        <div class="col-md-11 col-xs-11 col-sm-11 selec-m">Select All</div>
    </div>

    <?php if (!empty($songArray)):?>
    <?php foreach ($songArray as $song):?>
    <div class="col-md-9">
        <div class="col-md-1 col-md-1 col-xs-1 col-sm-1"><input type="checkbox" name="a" class="styled"/>
        </div>
        <div class="col-md-11 col-xs-11 col-sm-11">
            <div id="main" class="release main-left main-medium">
                <!-- Article -->
                <article>
                    <ol id="release-list" class="tracklist">
                        <li>
                            <div class="track-details">
                                <div class="track-buttons">
                                    <a href="javascript:;" class="googleplus-share"><i class="icon icon-soundcloud"><img
                                                src="images/playlist-play.png"> </i></a>
                                    <a href="javascript:;" class="googleplus-share"><i class="icon icon-download"><img
                                                src="images/playlist-add.png"></i></a>
                                    <a href="javascript:;" class="googleplus-share"><i class="icon icon-download"><img
                                                src="images/playlist-dl.png"></i></a>
                                </div>
                                <a class="track sp-play-track" href="#" data-cover="">
                                    <!-- cover -->
                                    <span class="track-title"><?php echo $song['song_name']?></span>
                                    <!-- Artists -->
                                    <span class="track-artists">Unknown</span>
                                </a>

                                <div class="track-size">10.05 MB</div>

                            </div>
                        </li>
                    </ol>
                </article>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>







</form>
</div>
</div>
</section>

<?php include('footer.php'); ?>

<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>

<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function(){

        plist = <?php echo json_encode($songPlaylist)?>;
        var myPlaylist = new jPlayerPlaylist({
            jPlayer: "#jquery_jplayer_1",
            cssSelectorAncestor: "#jp_container_1"
        },  plist, {
            playlistOptions: {
                enableRemoveControls: true
            },
            swfPath: "plugin/jplayer/dist/jplayer",
            supplied: "mp3",
            smoothPlayBar: true,
            keyEnabled: true,
            audioFullScreen: true // Allows the audio poster to go full screen via keyboard
        });

        $('.icon-soundcloud').on('click', function(){
            //$('#jp-player').show();
            myPlaylist.pause();
            myPlaylist.play(0);
        });




    });
    //]]>
</script>


</body>
</html>
