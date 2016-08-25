<style>
    .res-table{
        width: 100%;
    }
    .res-tr{
        float:left;
        width: 100%;
        border-bottom: 1px solid #eee;
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
    }
    .s_h a{
        cursor: pointer;
    }
    .toTop{
        position: fixed;
        right: 5px;
        bottom: 5px;
        width: 50px;
        height: 40px;
        background-color: #000;
        color: #fff;
        font-size: 30px;
        text-align: center;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="m-t-f-p m-b-f-p-l">
        <ul class="top-filter-select">
            <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> SEARCH RESULT </a> </li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 result-white">
        <div class = "m-b-f-p2" id = "a-zlist-affix">
            <ul class="nav nav-tabs s_h">
                <li ng-class="{'active':tab}" ng-click="tab = true"><a>ALBUMS</a></li>
                <li ng-class="{'active':!tab}" ng-click="tab = false"><a>SONGS</a></li>
            </ul>
            <div ng-show="tab">
                <div ng-show="!noalbum">
                    <div ng-repeat = "dir in result track by $index">
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

                </div>
                <div class="f_d1" ng-show="noalbum">
                    NO ALBUMS FOUND
                </div>
            </div>
            <div ng-show="!tab"><br>
                <div ng-show="!nosong">

                    <div ng-repeat = "category in songs track by $index">
                        <div ng-repeat = "album in category.albums track by $index">
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

                </div>
                <div class="f_d1" ng-show="nosong">
                    NO SONGS FOUND
                </div>
            </div>
        </div>
        <div class="toTop"><span class="fa fa-angle-up"></span></div>
    </div>
    <script>
                $(".toTop").click(function () {
                    $("html, body").animate({scrollTop: $('#a-zlist-affix').offset().top}, "slow");
                    return false;
                });

    </script>
</div>