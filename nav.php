<!-- ~~~=| Header START |=~~~ -->
<header class="header_area">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="header_top_left">
                        <div class="news_twiks">
                            <h4>News:</h4>
                        </div>
                        <div class="news_twiks_items">
                            <div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active" ng-if="!newslist">
                                        <p>NO NEWS</p>
                                    </div>
                                    <div class="item" ng-repeat="news in newslist" ng-class="{'active':$first}">

                                        <p>
                                            {{ news}}
                                        </p>

                                    </div>
                                    <!-- <div class="item">
                                        <p>FRIENDS TAMIL MP3 NEW DESIGNED BY IMROKRAFT SOLUTIONS</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="header_top_right">
                        <div class="social_header">
<!--                            <ul>
                                <li><a class="fa fa-facebook" href=""></a></li>
                                <li><a class="fa fa-twitter" href=""></a></li>
                                <li><a class="fa fa-google-plus" href=""></a></li>
                                <li><a class="fa fa-linkedin" href=""></a></li>
                                <li><a class="fa fa-behance" href=""></a></li>
                            </ul>-->
                            <ul id="share42">
                                <li><a rel="nofollow" class="fa fa-facebook" href="" data-count="fb" ng-click="socialShare('facebook')" title="Share on Facebook" target="_blank"></a></li>
                                <li><a rel="nofollow" class="fa fa-twitter" href="" data-count="gplus" ng-click="socialShare('twitter')" title="Share on Twitter" target="_blank"></a></li>
                                <li><a rel="nofollow" class="fa fa-google-plus" href="" data-count="twi" ng-click="socialShare('googleplus')" title="Share on Google+" target="_blank"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~=| Logo Area START |=~~~ -->
    <div class="header_logo_area">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-4 col-xs-12">
                    <div class="logo"> <a href="/tamilmp3"><img src="images/logo.png" title="Tamil Mp3"/></a> </div>
                </div>
                <div class="col-md-7 col-sm-8 col-xs-12">
                    <div class="header_add"> <form class="form-wrapper">
                            <input type="text" id="search" placeholder="Search Album/Movie" ng-model="searchTerm.text" ng-keypress="checkEnter($event)" ng-pattern="/[a-zA-Z0-9]/">
                            <input type="button" class="searchText" value="Search Music" id="submit" ng-click="albumSearch()">
                        </form></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~=| Logo Area END |=~~~ -->

    <!-- ~~~=| Main Navigation START |=~~~ -->
    <div class="mainnav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <nav class="main_nav_box">
                        <ul id="nav">
                            <li class="nav_news active"><a href="/tamilmp3">HOME</a>

                            </li>
                            <li class="nav_lifeguide"><a href="http://www.friendstamilchat.com/chat/"target="_blank">CHAT </a>

                            </li>
                            <li class="nav_fashion"><a href="">FORUM</a></li>
                            <li class="nav_gadgets"><a href="http://www.friendstamilchat.com/fm/"target="_blank">FM</a></li>
                            <li class="nav_lifestyle"><a href="aboutUs">ABOUT US</a></li>
                            <li class="nav_video"><a href="comments">COMMENTS</a></li>

                        </ul>
                    </nav>

                    <!-- ~~~=| Mobile Navigation END |=~~~ -->
                    <div class="only-for-mobile">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="ofm">
                                <li class="m_nav"><i class="fa fa-bars"></i> MENU </li>
                            </ul>

                            <!-- MOBILE MENU -->
                            <div class="mobi-menu">
                                <div id='cssmenu'>
                                    <ul>
                                        <li> <a href='/tamilmp3'><span>HOME</span></a>

                                        </li>
                                        <li> <a href='#'><span>CHAT</span></a>

                                        </li>
                                        <li> <a href='#'><span>FORUM</span></a> </li>

                                        <li> <a href='#'><span>FM</span></a> </li>

                                        <li> <a href='aboutUs'><span>ABOUT US</span></a> </li>
                                        <li> <a href='comments'><span>COMMENTS</span></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ~~~=| Mobile Navigation START |=~~~ -->

                </div>
            </div>
        </div>
    </div>
</header>
<!-- ~~~=| Main Navigation END |=~~~ -->