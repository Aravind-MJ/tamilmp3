<div class="row">
<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="{{ listlocation }}" class="active" data-pid="106" data-lang="tamil" data-toggle="tooltip" title="" data-original-title="Latest Releases"> {{ listlocationname }} {{ starname }} </a> </li>

        </ul>

    </div>
    <div class = "col-md-6 col-sm-6 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat = "name in list1 track by $index">
                <div class = "lineup-artist">
                    <a href = "Album/A-ZMovieSongs/{{name.name}}"> {{ name.name}}
                    </a>
                    <small ng-if="name.year!=null">[{{ name.year}}]</small>
                    <span class="new" ng-show="checknew(name.name)">New</span>
                </div>
            </li>
        </ul>
    </div>
    <div class = "col-md-6 col-sm-6 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat = "name in list2 track by $index">
                <div class = "lineup-artist">
                    <a href = "Album/A-ZMovieSongs/{{name.name}}"> {{ name.name}}
                    </a>
                    <small ng-if="name.year!=null">[{{ name.year}}]</small>
                    <span class="new" ng-show="checknew(name.name)">New</span>
                </div>
            </li>
        </ul>
    </div>
</div>

    <?php include '../right_section.php'; ?>
</div>