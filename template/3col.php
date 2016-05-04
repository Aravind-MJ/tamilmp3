<div class="row">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="#/List/{{ listlocation}}" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> {{ listlocationname | uppercase }} </a> </li>

        </ul>

    </div>
    <div class = "m-b-f-p" id = "a-zlist-affix">
        <div ng-class="{'col-md-4 col-sm-4':list3 != undefined,'col-md-6 col-sm-6':list3 == undefined}">
            <ul class = "lineup">
                <li ng-repeat = "name in list1 track by $index">
                    <div class = "lineup-artist">
                        <a href = "#/Album/{{ listlocation }}/{{name.name}}" ng-if="listlocation!='DevotionalCollections'"> {{ name.name}}
                        </a>
                        <a href = "#/List/{{name.name | removeSpaces }}" ng-if="listlocation=='DevotionalCollections'"> {{ name.name}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div ng-class="{'col-md-4 col-sm-4':list3 != undefined,'col-md-6 col-sm-6':list3 == undefined}">
            <ul class = "lineup">
                <li ng-repeat = "name in list2 track by $index">
                    <div class = "lineup-artist">
                        <a href = "#/Album/{{ listlocation }}/{{name.name}}" ng-if="listlocation!='DevotionalCollections'"> {{ name.name}}
                        </a>
                        <a href = "#/List/{{ name.name | removeSpaces }}" ng-if="listlocation=='DevotionalCollections'"> {{ name.name}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class = "col-md-4 col-sm-4 col-xs-12" ng-hide="list3 == undefined">
            <ul class = "lineup">
                <li ng-repeat = "name in list3 track by $index">
                    <div class = "lineup-artist">
                        <a href = "#/Album/{{ listlocation }}/{{name.name}}" ng-if="listlocation!='DevotionalCollections'"> {{ name.name}}
                        </a>
                        <a href = "#/List/{{name.name | removeSpaces }}" ng-if="listlocation=='DevotionalCollections'"> {{ name.name}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>