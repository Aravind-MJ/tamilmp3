<div class="col-md-8 col-sm-8 col-xs-12">

    <div class="ftm-alb-title"><h2>FEATURED ALBUM </h2></div>
    <div class="sp-comments-box" ng-repeat = "name in listmovie">

        <div class="single_comment">
            <div class="single_comment_pic">
                <a href="Album/A-ZMovieSongs/{{name.name}}"><img alt="Friends Tamil Mp3" ng-src="FileSystem/A-Z Movie Songs/{{ name.name}}/poster.jpg" ></a> </div>
            <div class="single_comment_text">
                <div class="sp_title">
                    <a href="Album/A-ZMovieSongs/{{name.name}}"><h4 >{{ name.name}}</h4></a>
                </div>
                <p>Starring : {{ name.star}}</p>
                <p>Music : {{ name.music}}</p>
                <p>Director : {{ name.director}}</p>
                <p>Year: {{ name.year }}</p>
            </div>
        </div>
    </div>
    </div>

    <?php include '../right_section.php'; ?>