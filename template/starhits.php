<div class="col-md-3 col-sm-3 col-xs-12" ng-repeat="name in list track by $index">    
    <div class="single_fs_text m-t-f-p">
        <div class="cc_im_box"><img alt="images" src="{{ location }}/{{ name.name }}.jpg"/></div>
        <h2 class="two_middle"><a href="#/StartHits/{{ name.name }}">{{ name.name }} Hits</a></h2>
        <div class="two_middle"><p>New Hits</p></div>
    </div>
</div>

