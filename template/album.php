<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $img = $_GET['img'];
    $title = $_GET['title'];
    ?>
    <meta property="fb:app_id"             content="1121767714531757" /> 
    <meta property="og:url"                content="http://demox.imrokraft.com<?= $_SERVER['REQUEST_URI'] ?>" />
    <meta property="og:title"              content="<?= $title ?>" />
    <meta property="og:image"              content="http://www.demox.imrokraft.com/tamilmp3/fbshares/<?= $img ?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:description"        content="A nice album" />
    <?php
    echo '<script> window.location.href="' . $url . '"; </script>';
    die();
}
?>
<style>
    div.jp-details {
        display: block !important;
    }
</style>
<div class="movie_ft">
    <div class="Top_name1">
        <div class="shareBox">
            <div>Share this album.</div>
            <center>
                <ul id="share42" class="albumshare">
                    <li><a rel="nofollow" class="fa fa-facebook text-primary" href="" data-count="fb" ng-click="socialShare('facebook')" title="Share on Facebook" target="_blank"></a></li>
                    <li><a rel="nofollow" class="fa fa-twitter text-aqua" href="" data-count="gplus" ng-click="socialShare('twitter')" title="Share on Twitter" target="_blank"></a></li>
                    <li><a rel="nofollow" class="fa fa-google-plus text-danger" href="" data-count="twi" ng-click="socialShare('googleplus')" title="Share on Google+" target="_blank"></a></li>
                </ul>  
            </center>
        </div>
        <h2><a href="#">{{ name}}</a></h2> 
        <div class="fb-like" data-href="{{ $route.current.templateUrl}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
    </div>

    <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="fs_news_left ht_fs_news_left m-t-f-p">
            <div class="single_fs_news_left_text">
                <div class="single_fs_news_lft_img_h2">

                    <img ng-src="FileSystem/{{ place}}/{{ name}}/poster.jpg" width="350px" height="400px" alt="Friends Tamil Mp3">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="single_fs_news_right_text m-t-f-p">


            <p ng-if="moviedetails.starring">Starring : {{ moviedetails.starring}} </p>

            <p ng-if="moviedetails.mdirector">Music Director : {{ moviedetails.mdirector}}</p>

            <p ng-if="moviedetails.director">Director : {{ moviedetails.director}}</p>

            <p ng-if="moviedetails.year">Year : {{ moviedetails.year}}</p>
        </div>


    </div>

    <div id="jplayer-affix">
        <div class="jplayer_f">
            <div class="l_n">
                <div class="paly-media">
                    <div id="jp-player" ng-hide="playershow">
                        <div class="jp-type-playlist">
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
                                        <div class="jp-title"  aria-label="title">&nbsp;</div>
                                    </div>
                                    <div class="scrollList">
                                        <div class="jp-playlist">
                                            <ul>
                                                <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </div>
</div>


<form class="col-lg-12 col-md-12 b_n" action="download.php" method="post" id="zipForm">
    <input type="text" name="album_name" value="{{ name | removeSpaces}}" hidden>
    <div class="button_f">

        <div class="col-lg-12 col-md-12 col-xs-12 playlist-section">

            <div class="col-md-4">
                <ul class="buttons-list">
                    <li><a class="btn small" href="javascript:;" ng-click="playCurrentSong()"><i class="icon icon-download"><img
                                    src="images/play-but.png"></i> Play</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul class="buttons-list">
                    <li><a class="btn small" href="javascript:;" ng-click="addToPlaylist()"><i class="icon icon-download"><img
                                    src="images/add-but.png"></i> Add to Playlist </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4">
                <ul class="buttons-list" id="downZip">
                    <li><a class="btn small" href="javascript:;"><i  class="icon icon-download" ><img src="images/dl-but.png"></i>
                            Download </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="select-section row">
        <div class="col-md-1 col-md-1 col-xs-1 col-sm-1" ng-show="list.song"><input type="checkbox" ng-model="checkall" ng-click="checkAll()" id="checkAll"/></div>
        <div class="col-md-11 col-xs-11 col-sm-11 selec-m" ng-show="list.song">Select All</div>
        <div class="col-md-11 col-xs-11 col-sm-11 selec-m" ng-show="!list.song">No Songs</div>
    </div>
    <div class="song-item row" ng-repeat="x in list.song">
        <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1"><input type="checkbox" class="styled" ng-model="x.selected" value="{{ x.downpath}}" ng-checked="x.selected" name="files[]"/>
        </div>
        <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
            <div id="main" class="release main-left main-medium">
                <!-- Article -->
                <article>
                    <ol id="release-list" class="tracklist">
                        <li>
                            <div class="track-details">
                                <div class="track-buttons">
                                    <a href="javascript:;" ng-click="playSong(x.downpath, x.name, $index, 'play')" class="googleplus-share"><i class="icon icon-soundcloud">
                                            <img src="images/playlist-play.png" alt="Play"> </i></a>
                                    <a href="javascript:;" class="googleplus-share" ng-click="playSong(x.downpath, x.name, $index, 'add')"><i class="icon icon-download">
                                            <img src="images/playlist-add.png" alt="Add"></i></a>
                                    <a href="{{ x.downpath}}" download="{{ x.name}}" class="googleplus-share" target="_PARENT"><i class="icon icon-download">
                                            <img src="images/playlist-dl.png" alt="Download"></i></a>
                                </div>
                                <a class="track sp-play-track" href="javascript:void(0)" data-cover="">
                                    <!-- cover -->
                                    <span class="track-title">{{ x.name}}</span>
                                    <!-- Artists -->
                                    <span class="track-artists">{{ detail[x.name].artist}} </span>
                                </a>

                                <div class="track-size">{{ detail[x.name].size / 1000000 | number:2 }}MB</div>

                            </div>
                        </li>
                    </ol>
                </article>

            </div>
        </div>
        <div class="fb-like col-lg-1 col-md-1 col-xs-1 col-sm-1" data-href="{{ $route.current.templateUrl + '/' + x.name}}" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
    </div>
</form>
<center>
    <div class="fb-comments" data-href="{{ $route.current.templateUrl}}" data-numposts="5" data-colorscheme="light"></div>
</center>
<div id="alertModal" class="modal fade ngHide" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fa fa-info"></i> Note</h3>
            </div>
            <div class="modal-body">
                <p>Please Choose atleast one Song for downloading...</p>
                <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="width:200px;">Close</button>
                </center>
            </div>
        </div>

    </div>
</div>

<script>

            $("#downZip").click(function () {
                if ($("#zipForm input:checkbox:checked").length > 0) {
                    $("#zipForm").submit();
                } else {
                    $('#alertModal').modal('show');
                }

            });
</script>
