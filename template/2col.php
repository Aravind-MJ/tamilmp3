<div class="row">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="#/{{ listlocation}}" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> {{ listlocationname}} </a> </li>

        </ul>

    </div>
    <div class = "m-b-f-p" id = "a-zlist-affix">
        <div class = "col-md-4 col-sm-4 col-xs-12">
            <ul class = "lineup">
                <li ng-repeat = "name in list1 track by $index">
                    <div class = "lineup-artist">
                        <a href = "#/Album/{{ listlocation}}/{{name.name}}"> {{ name.name}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class = "col-md-4 col-sm-4 col-xs-12">
            <ul class = "lineup">
                <li ng-repeat = "name in list2 track by $index">
                    <div class = "lineup-artist">
                        <a href = "#/Album/{{ listlocation}}/{{name.name}}"> {{ name.name}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>