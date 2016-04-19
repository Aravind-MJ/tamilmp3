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
    'font-awsome'   => 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
    'bootstrap-css' => 'css/bootstrap.css',
    'style-css'     => 'style.css',
    'responsive-css' => 'css/responsive.css'

);

$js_inc  = array(
    'jquery'       =>  'https://code.jquery.com/jquery.min.js',
    'bootstrap-js' =>  'js/bootstrap.min.js',
    'theme-js'     =>  'js/main.js'
);

include_once 'autoload.php';
$autoload = new Autoload();
$autoload->title   = 'Tamil MP3';
$autoload->css_inc = $css_inc;
$autoload->js_inc  = $js_inc;

?>

<?php include ('header.php');?>

<body>

<!-- NAVIGATION -->
<?php include ('nav.php');?>

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
            <?php include_once('left-menu.php'); ?>
                <div class="col-md-9 col-sm-9 col-xs-12 m-t-f-p m-b-f-p-l">

                    <ul class="top-filter-select">

                        <li> <a href="#" class="active" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> A-Z MOVIE LIST </a> </li>
                        <li> <a href="#" class="" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> / </a> </li>

                        <li> <a href="#" class="" data-pid="107" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Evergreen Songs"> ILAYARAJA HITS </a> </li>
                        <li> <a href="#" class="" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> / </a> </li>
                        <li> <a href="#" class="" data-pid="951" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="AR Rahman Hits"> AR RAHMAN HITS </a> </li>
                        <li> <a href="#" class="" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> / </a> </li>
                        <li> <a href="#" class="" data-pid="109" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Ilayaraja and Gangai Amaran Songs">MS VISHWANATHAN HITS</a> </li>
                        <li> <a href="#" class="" data-pid="106" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> / </a> </li>
                        <li> <a href="#" class="" data-pid="110" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Yuvan and Karthik Raja Hits"> TAMIL KAROKE </a> </li>

                    </ul>

                </div>

                <div class="col-md-9 col-sm-9 col-xs-12 m-b-f-p">
                    <ul class="station-select">
                        <?php foreach (range('A', 'Z') as $char): ?>
                            <li> <a href="javascript:void(0)" class="alphabets" data-pid="<?php echo $char;?>" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Latest Releases"> <?php echo $char;?> </a> </li>
                        <?php endforeach; ?>

                        <li> <a href="javascript:void(0)" class="" data-pid="126" data-lang="tamil" data-toggle="tootltip" title="" data-original-title="Tamil Private Albums"> 1-9 </a> </li>
                    </ul>
                </div>

                <?php
                $sqlMovies    = sprintf("SELECT m.id, m.name FROM movies m WHERE m.name LIKE '%s'", 'A'.'%');
                $resultMovies = mysqli_query($link, $sqlMovies);
                $movieArray   = array();
                while ($movieRow   = mysqli_fetch_assoc($resultMovies)) {
                    $movieArray[] = $movieRow;
                }


                $movieBy3cols  = array_chunk($movieArray, ceil(count($movieArray)/3));
                $firstColList  = !empty($movieBy3cols[0]) ? $movieBy3cols[0] : array();
                $secondColList = !empty($movieBy3cols[1]) ? $movieBy3cols[1] : array();
                $thirdColList  = !empty($movieBy3cols[2]) ? $movieBy3cols[2] : array();

                ?>


                <div class="col-md-9 col-sm-9 col-xs-12 m-b-f-p" id="a-zlist-affix">
                <?php if (!empty($firstColList)):?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <ul class="lineup">
                            <?php foreach ($firstColList as $firstList): ?>
                                <li>
                                    <div class="lineup-artist"><a href="javascript:;"><?php echo $firstList['name']?></a></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif;?>

                <?php if (!empty($secondColList)):?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <ul class="lineup">
                        <?php foreach ($secondColList as $secondList): ?>
                            <li>
                                <div class="lineup-artist"><a href="javascript:;"><?php echo $secondList['name']?></a></div>
                            </li>
                        <?php endforeach; ?>
                        </ul>

                    </div>
                <?php endif;?>

                <?php if (!empty($thirdColList)):?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <ul class="lineup">
                        <?php foreach ($thirdColList as $thirdList): ?>
                            <li>
                                <div class="lineup-artist"><a href="javascript:;"><?php echo $thirdList['name']?></a></div>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif;?>

            </div>
    </div>
</section>

<?php include ('footer.php'); ?>

</body>

<script>
    $(function() {
        $('.alphabets').on('click', function() {
            var alphabet = ($(this).attr('data-pid'));

            $.get( "ajax-pages/ajax-a-z-list.php?alphabet="+alphabet)
                .done(function( data ) {
                    $('#a-zlist-affix').html(data);
            });
        })
    });
</script>
</html>


