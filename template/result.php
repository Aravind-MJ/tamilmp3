<style>
    .res-table{
        width: 100%;
    }
    .res-tr{
        float:left;
        width: 100%;
        border-bottom: 1px solid #aaa;
        color:#111;
    }
    .res-td{
        float:left;
        width: 50%;
        padding: 10px;
    }
    .res-td:last-child{
        text-align: center;
    }
    .res-tr:hover{
        background-color: #eee;
        border-bottom: 1px solid #de4197;
    }
</style>
<div class="row">
    <div class="m-t-f-p m-b-f-p-l">
        <ul class="top-filter-select">
            <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> SEARCH RESULT </a> </li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class = "m-b-f-p2" id = "a-zlist-affix">
            <ul class="nav nav-tabs s_h">
                <li ng-class="{'active':tab}" ng-click="tab = true"><a>ALBUMS</a></li>
                <li ng-class="{'active':!tab}" ng-click="tab = false"><a>SONGS</a></li>
            </ul>
            <div class="f_d" ng-show="tab"><br>
                <div class="f_d1" ng-show="!noalbum">
                    <div ng-repeat = "dir in result track by $index" ng-show="check($index, 'album')" class="res-table">
                        <div ng-repeat="album in dir.albums track by $index">
                            <a href = "Album/{{ dir.in | removeSpaces }}/{{ album.name}}" ng-if="dir.in !== 'Devotional Collections'" class="res-tr">
                                <div class="res-td">
                                    <span ng-bind-html="album.show | trust"></span>                         
                                </div>
                                <div class="res-td">
                                    <span ng-bind="dir.in"></span>
                                </div>
                            </a>
                            <a href = "{{ album.name | removeSpaces }}" ng-if="dir.in === 'Devotional Collections'" class="res-tr">
                                <div class="res-td">
                                    <span ng-bind-html="album.show | trust"></span>                         
                                </div>
                                <div class="res-td">
                                    <span ng-bind="dir.in"></span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <center class="pager">{{ pageOf('album')}}</center>
                    <a href="#" class="button pull-right" ng-class="{'disabled':pagination.albumpage / 3 + 1 >= (pagination.albumlimit / 3)}" ng-click="next('album')">Next ></a>
                    <a href="#" class="button" ng-class="{'disabled':pagination.albumpage === 0}" ng-click="prev('album')">< Previous</a>

                </div>
                <div class="f_d1" ng-show="noalbum">
                    NO ALBUMS FOUND
                </div>
            </div>
            <div class="f_d" ng-show="!tab"><br>
                <div class="f_d1" ng-show="!nosong">

                    <div ng-repeat = "category in songs track by $index" ng-show="check($index, 'song')">
                        <div ng-repeat = "album in category.albums track by $index" class="res-table">
                            <a class="album_name" href = "Album/{{ category.name | removeSpaces }}/{{ album.name}}">
                                <div ng-repeat = "song in album.songs track by $index" class="res-tr">
                                    <div class="res-td">
                                        <span ng-bind-html="song | trust"></span>
                                    </div>
                                    <div class="res-td">
                                        <span ng-bind="category.name"></span> | <span ng-bind="album.name"></span> 
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <center class="pager">{{ pageOf('song')}}</center>
                    <a href="#" class="button pull-right" ng-class="{'disabled':pagination.songpage / 3 + 1 >= (pagination.songlimit / 3)}" ng-click="next('song')">Next ></a>
                    <a href="#" class="button " ng-class="{'disabled':pagination.songpage === 0}" ng-click="prev('song')">< Previous</a>

                </div>
                <div class="f_d1" ng-show="nosong">
                    NO SONGS FOUND
                </div>
            </div>
        </div> 
    </div>
    <script>
                $(".button").click(function () {
                    $("html, body").animate({scrollTop: $('#a-zlist-affix').offset().top}, "slow");
                    return false;
                });

    </script>
</div>