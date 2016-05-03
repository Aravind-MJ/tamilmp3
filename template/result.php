
<div class="row">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> Search Result </a> </li>

        </ul>

    </div>
    <div class = "m-b-f-p" id = "a-zlist-affix">
        <div>
            <ul class = "searchList">
                <li ng-repeat = "dir in result track by $index">
                    Inside {{ dir.in }}
                    <div class = "searchItem" ng-repeat="album in dir.albums track by $index">
                        <a href = "#/Album/{{ dir.place }}/{{ album }}"> {{ album }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>