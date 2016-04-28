<div class="m-t-f-p m-b-f-p-l">

    <ul class="top-filter-select">

        <li> <a href="#/byyear" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> MOVIE LIST BY YEAR </a> </li>

    </ul>

</div>


<div class = "m-b-f-p" id = "a-zlist-affix">
    <div class = "col-md-3 col-sm-3 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat="year in years[0] track by $index">
                <div class = "lineup-artist" >
                    <a href = "#/byyear/{{year}}"> {{ year}}
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class = "col-md-3 col-sm-3 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat="year in years[1] track by $index">
                <div class = "lineup-artist">
                    <a href = "#/byyear/{{year}}"> {{ year}}
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class = "col-md-3 col-sm-3 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat="year in years[2] track by $index">
                <div class = "lineup-artist">
                    <a href = "#/byyear/{{year}}"> {{ year}}
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class = "col-md-3 col-sm-3 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat="year in years[3] track by $index">
                <div class = "lineup-artist">
                    <a href = "#/byyear/{{year}}"> {{ year}}
                    </a>
                </div>
            </li>
            <li>
                <div class = "lineup-artist">
                    <a href = "#/byyear/before"> Before 1950
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>

