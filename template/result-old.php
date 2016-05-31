<div class="row">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> SEARCH RESULT </a> </li>

        </ul>

    </div>
    <div class = "m-b-f-p1" id = "a-zlist-affix">
        <div class="col-lg-6 col-md-6">
            <div>Songs Matching the Search</div>
            <div  ng-repeat = "category in songs track by $index" style="border: 1px solid #f00; padding: 10px;">
                <div>Category:{{category.name}}</div>
                <div ng-repeat = "album in category.albums track by $index" style="border: 1px solid #0f0; padding: 10px;">
                    <div>Album:{{album.name}}</div>
                    <div ng-repeat = "song in album.songs track by $index" style="border: 1px solid #00f; padding: 10px;">
                        <div>{{song}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div>Albums Matching the Search</div>
            <div ng-repeat = "dir in result track by $index" style="border: 1px solid #f00; padding: 10px;">
                <div>{{ dir.in}}</div>
                <div ng-repeat="album in dir.albums track by $index" style="border: 1px solid #0f0; padding: 10px;">
                    <div>
                        <a href = "Album/{{ dir.in | removeSpaces }}/{{ album }}" ng-if="dir.in != 'Devotional Collections'"> {{ album }}</a>
                        <a href = "List/{{ album | removeSpaces }}" ng-if="dir.in == 'Devotional Collections'"> {{ album }}</a>
                    </div>
                </div>                
            </div>
<!--            <table class="searchTable">
                <tr>
                    <th colspan="2">Location of Album</th>
                    <th>Albums matching the Search</th>
                </tr>
                <tr ng-repeat = "dir in result track by $index" class = "searchList">
                    <td rowspan="{{ dir.length}}"><img class="a" src="images/list-ico.png">{{ dir.in}}</td>
                    <td class="a"></td>
                    <td>
                        <table class="resultTable">
                            <tr ng-repeat="album in dir.albums track by $index" >
                                <td>
                                    <a href = "Album/{{ dir.in | removeSpaces }}/{{ album}}" ng-if="dir.in != 'Devotional Collections'"> {{ album}}</a>
                                    <a href = "List/{{ album | removeSpaces }}" ng-if="dir.in == 'Devotional Collections'"> {{ album}}</a>
                                </td>
                            </tr> 
                        </table>
                    </td>
                </tr>
            </table>-->
        </div>

    </div>
</div>