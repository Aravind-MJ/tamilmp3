<div class="m-t-f-p m-b-f-p-l">

    <ul class="top-filter-select">

        <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> A-Z MOVIE LIST </a> </li>

    </ul>

</div>

<div class="m-b-f-p">
    <ul class="station-select">
        <li> <a href="#/azlisting/A">A</a></li>
        <li> <a href="#/azlisting/B">B</a></li>
        <li> <a href="#/azlisting/num" class="" data-pid="126" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Tamil Private Albums"> 1-9 </a> </li>
    </ul>
</div>

<div class="m-b-f-p" id="a-zlist-affix"> 
    <div class="col-md-4 col-sm-4 col-xs-12">
        <ul class="lineup">
            <li ng-repeat="name in list track by $index"> 
                    <div class="lineup-artist">
                        <a href="#/movie/{{name.name}}"> {{ name.name }}
                        </a>
                    </div>
                </li> 
        </ul>
    </div>
</div>

