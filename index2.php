<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <?php
    
    
    $css_inc = array(
        'font-awsome' => 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
        'bootstrap-css' => 'css/bootstrap.css',
        'style-css' => 'style.css',
        'responsive-css' => 'css/responsive.css'
    );

    $js_inc = array(
        'jquery' => 'https://code.jquery.com/jquery.min.js',
        'bootstrap-js' => 'js/bootstrap.min.js',
        'theme-js' => 'js/main.js',
        'angular-js' => 'http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js',
        'script' => 'scripts/injection.js'
    );

    include_once 'autoload.php';
    $autoload = new Autoload();
    $autoload->title = 'Tamil MP3';
    $autoload->css_inc = $css_inc;
    $autoload->js_inc = $js_inc;
    ?>

    <?php include ('header.php'); ?>

    <body>
        <!-- NAVIGATION -->
<?php include ('nav.php'); ?>

        <!-- ~~~=| Banner START |=~~~ -->
        <section class="hp_banner_area section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="hp_banner_box">


                            <div class="hp_banner_right">
                                <div class="br_single_news"> <img src="images/friends-tamil-mp3-chat.jpg" alt="" />
                                </div>
                            </div>

                            <div class="hp_banner_left">


                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <div class="br_single_news">
                                                <img alt="" src="images/friends-tamil-mp3-banner.jpg">
                                                <div class="br_cam">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="br_single_news">
                                                <img alt="" src="images/friends-tamil-mp3-banner2.jpg">
                                                <div class="br_cam">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="br_single_news">
                                                <img alt="" src="images/friends-tamil-mp3-banner3.jpg">
                                                <div class="br_cam">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="hp_banner_right">

                                <div class="br_single_news"> <img src="images/friends-tamil-mp3-right-banner.jpg" alt="" />
                                    <div class="br_single_text"> <span class="blue_hp_span">CHAT NOW</span> <a href="#">
                                            <h4>FRIENDS TAMIL MP3 CHAT</h4></a> </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ~~~=| Banner END |=~~~ -->



        <section class="main_news_wrapper cc_single_post_wrapper">
            <div class="container">
                <div class="row">

<?php include_once ('left-menu.php'); ?>

                    <div class="injection">
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="ftm-alb-title"><h2>FEATURED ALBUM</h2></div>
                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <a href="movie-pages.html"><img src="images/alb-1.png" alt="Friends Tamil Mp3"></a> </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href="movie-pages.html"><h4>Un Samayal Arayil</h4></a>
                                        </div>
                                        <p>Starring : Prakash Raj, Sneha, Urvasi</p>
                                        <p>Music : Ilaiyaraaja</p>
                                        <p>Director : Prakash Raj</p>
                                        <p>Year: 2015</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/thirunaal-t.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>Thirunal</h4></a>
                                        </div>
                                        <p>Starring : Jiiva, Nayanthara</p>
                                        <p>Music : Sri </p>
                                        <p>Director :Mankai</p>
                                        <p>Year: 2016</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Kodu-t.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>Oru Melliya Kodu</h4></a>
                                        </div>
                                        <p>Starring : Sneha, Urvasi</p>
                                        <p>Music : Ilaiyaraaja</p>
                                        <p>Director : Prakash Raj</p>
                                        <p>Year: 2016</p>
                                    </div>
                                </div>
                            </div>


                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Theri-t.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4> Theri </h4></a>
                                        </div>
                                        <p>Starring : Vijay, Sammantha</p>
                                        <p>Music : G.V.Prakash Kumar </p>
                                        <p>Director : Prakash Raj</p>
                                        <p>Year: 2016</p>
                                    </div>
                                </div>
                            </div>


                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Durai-t.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4> Jackson Durai </h4></a>
                                        </div>
                                        <p>Starring : Sibiraj, Bindu Madhavi</p>
                                        <p>Music : Siddharth Vipin </p>
                                        <p>Director : Prakash Raj</p>
                                        <p>Year: 2016</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Single.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>24 Single</h4></a>
                                        </div>
                                        <p>Starring : Soorya</p>
                                        <p>Music : A R Rahman </p>
                                        <p>Director : Prakash Raj</p>
                                        <p>Year: 2016</p>
                                    </div>
                                </div>
                            </div>

                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Vayadhinile.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>36 Vayadhinile</h4></a>
                                        </div>
                                        <p>Starring : Jyothika, Rahman</p>
                                        <p>Music :Santhosh Narayanan </p>
                                        <p>Director : Roshan Andrews</p>
                                        <p>Year: 2015</p>
                                    </div>
                                </div>
                            </div>


                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/49.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>49 O</h4></a>
                                        </div>
                                        <p>Starring : Goundamani</p>
                                        <p>Music : K K </p>
                                        <p>Director : K </p>
                                        <p>Year: 2015</p>
                                    </div>
                                </div>
                            </div>


                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Maatram.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>Manadhil Oru Maatram</h4></a>
                                        </div>
                                        <p>Starring : Madhan, Spoorthi</p>
                                        <p>Music : Sri Sastha </p>
                                        <p>Director : K </p>
                                        <p>Year: 2015</p>
                                    </div>
                                </div>
                            </div>


                            <div class="sp-comments-box">
                                <div class="single_comment">
                                    <div class="single_comment_pic">
                                        <img src="images/Aakko.jpg" alt="Friends Tamil Mp3">
                                    </div>
                                    <div class="single_comment_text">
                                        <div class="sp_title">
                                            <a href=""><h4>Aakko Single</h4></a>
                                        </div>
                                        <p>Starring : Geethan Britto, Tulika Gupta</p>
                                        <p>Music : Anirudh  </p>
                                        <p>Director : K </p>
                                        <p>Year: 2015</p>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="home_sidebar">
                                <div class="follow_us_side">
                                    <div class="ftm-title">
                                        <h2>TOP COLLECTIONS</h2>
                                    </div>


                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/coll-img-1.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>LOVE SONGS 2016</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/coll-img-2.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>SPB HITS</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/coll-img3.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>AR RAHMAN HITS</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/coll-img4.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>ILAYARAJA HITS</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="home_sidebar">
                                <div class="follow_us_side">
                                    <div class="ftm-title">
                                        <h2>POPULAR DOWNLOADS</h2>
                                    </div>


                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/pop-img1.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>jithan-2</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/pop-img2.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>Megaman </p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/pop-img3.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>Senthatti Kaalai Sevatha Kaalai</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="purchase_sidebar_img m_t_l">
                                        <img src="images/pop-img4.jpg" alt="Friends Tamil Mp3">
                                        <div class="purchase_overlay"></div>
                                        <div class="purchase_sidebar_text">
                                            <p>Irudhi Sutru</p>
                                            <div class="purchase_s">
                                                <a href="#">VIEW MORE</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include ('footer.php'); ?>

    </body>
</html>


