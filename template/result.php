
<div class="row">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> Search Result </a> </li>

        </ul>

    </div>
    <div class = "m-b-f-p" id = "a-zlist-affix">
        <table class="searchTable">
            <tr ng-repeat = "dir in result track by $index" class = "searchList">
                <td rowspan="{{ dir.length }}">{{ dir.in}}</td>  <!-- Incorrect Error message. It works. Leave it as it is. -->
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
        </table>
    </div>
</div>