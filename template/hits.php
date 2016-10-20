<div class="m-t-f-p m-b-f-p-l">

    <ul class="top-filter-select">

        <li> <a href="{{ listlocation }}" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> {{ listlocationname }} </a> </li>

    </ul>

</div>

<div class="col-md-3 col-sm-3 col-xs-12" ng-repeat="name in list track by $index">    
    <div class="single_fs_text m-t-f-p">
        <div class="cc_im_box"><img alt="images" ng-src="{{ name.path }}//{{ name.name }}/AlbumArtSmall.jpg" width="175px" height="215px"/></div>
        <h2 class="two_middle"><a href="Album/{{ listlocation }}/{{ name.name }}">{{ name.name }}</a></h2>
        <div class="two_middle"><p>{{ name.caption }}</p></div>
    </div>
</div>

