<style>
    div.jp-details {
        display: block !important;
    }
</style>
<div class="movie_ft">
    <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="fs_news_left ht_fs_news_left m-t-f-p">
            <div class="single_fs_news_left_text">
                <div class="single_fs_news_lft_img_h2">
                    <img ng-src="FileSystem/{{ place }}/{{ name }}/poster.jpg" width="300px" height="300px" alt="Friends Tamil Mp3">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="single_fs_news_right_text m-t-f-p">
            <h2><a href="#">{{ name }}</a></h2>

            <p ng-if="moviedetails.starring">Starring : {{ moviedetails.starring}} </p>

            <p ng-if="moviedetails.mdirector">Music Director : {{ moviedetails.mdirector }}</p>

            <p ng-if="moviedetails.director">Director : {{ moviedetails.director }}</p>

            <p ng-if="moviedetails.year">Year : {{ moviedetails.year }}</p>
        </div>
    </div>
    
        <div id="jplayer-affix">

        </div>
    </div>
</div>
<div class="jplayer_f">
<div class="col-lg-12 col-md-12">

    <div class="col-md-1 col-sm-1 col-xs-1">
    </div>
     <div class="col-md-10 col-sm-12 col-xs-12">
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
                        <div class="jp-playlist">
                            <ul>
                                <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                <li>&nbsp;</li>
                            </ul>
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
    </div></div></div>

        
     
<div class="button_f">
<div class="col-lg-12 col-md-12 playlist-section">

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

    <div class="col-md-4 ">
        <ul class="buttons-list">
            <li><a class="btn small" href="javascript:;"><i class="icon icon-download"><img src="images/dl-but.png"></i>
                    Download </a>
            </li>
        </ul>
    </div>

</div></div>

<form action="#">
    <div class="col-md-9 select-section">
        <div class="col-md-1 col-md-1 col-xs-1 col-sm-1" ng-show="list.song"><input type="checkbox" ng-model="checkall" id="checkAll" ng-/></div>
        <div class="col-md-11 col-xs-11 col-sm-11 selec-m" ng-show="list.song">Select All</div>
        <div class="col-md-11 col-xs-11 col-sm-11 selec-m" ng-show="!list.song">No Songs</div>
    </div>
    <div class="col-md-9" ng-repeat="x in list.song">
        <div class="col-md-1 col-md-1 col-xs-1 col-sm-1"><input type="checkbox" value="{{$index}}" ng-checked="checkall" class="styled"/>
        </div>
        <div class="col-md-11 col-xs-11 col-sm-11">
            <div id="main" class="release main-left main-medium">
                <!-- Article -->
                <article>
                    <ol id="release-list" class="tracklist">
                        <li>
                            <div class="track-details">
                                <div class="track-buttons">
                                    <a href="javascript:;" ng-click="playSong(x.downpath, x.name, $index, 'play')" class="googleplus-share"><i class="icon icon-soundcloud"><img
                                                src="images/playlist-play.png"> </i></a>
                                    <a href="javascript:;" class="googleplus-share" ng-click="playSong(x.downpath, x.name, $index, 'add')"><i class="icon icon-download"><img
                                                src="images/playlist-add.png"></i></a>
                                    <a href="{{ x.downpath }}" download="{{ x.name }}" class="googleplus-share"><i class="icon icon-download"><img
                                                src="images/playlist-dl.png"></i></a>
                                </div>
                                <a class="track sp-play-track" href="javascript:void(0)" data-cover="">
                                    <!-- cover -->
                                    <span class="track-title">{{ x.name}}</span>
                                    <!-- Artists -->
                                    <span class="track-artists">{{ detail[x.name].artist }} </span>
                                </a>

                                <div class="track-size">{{ detail[x.name].size / 1000000 | number:2 }}MB</div>

                            </div>
                        </li>
                    </ol>
                </article>

            </div>
        </div>
    </div>
</form>

<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>

