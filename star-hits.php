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
 
<section class="main_news_wrapper cc_single_post_wrapper">
    <div class="container">
        <div class="row">
    
        <?php include_once('left-menu.php'); ?>
    
            <div class="col-md-9 col-sm-9 col-xs-12 m-b-f-p">
            <?php
                $sqlStars    = sprintf("SELECT s.id, s.name, s.image FROM stars s");
                $resultStars = mysqli_query($link, $sqlStars);
                if(mysqli_num_rows($resultStars) > 0):
                ?>
                <div class="col-md-12 col-sm-12 col-xs-12">    
                    <?php
                    while ($starRow   = mysqli_fetch_assoc($resultStars)) {
                    ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">    
                        <div class="single_fs_text m-t-f-p">
                            <div class="cc_im_box"><img alt="images" src="admin/stars/<?php echo $starRow['image'];?>"/></div>
                        <h2 class="two_middle"><a href="a-z-star-list.php?id=<?php echo $starRow['id'];?>"><?php echo $starRow['name'];?> Hits</a></h2>
                        <div class="two_middle"><p>New Hits</p></div>
                        </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
          <?php endif;?>   
    
            </div>
    

        </div>    
    </div>    
</section>
    
<?php include ('footer.php'); ?>   
    
<!-- ~~~=| Latest jQuery |=~~~ --> 
<script src="https://code.jquery.com/jquery.min.js"></script> 

<!-- ~~~=| Bootstrap jQuery |=~~~ --> 
<script src="js/bootstrap.min.js"></script> 

<!-- ~~~=| Opacity & Other IE fix for older browser |=~~~ --> 
<!--[if lte IE 8]>
		<script type="text/javascript" src="js/ie-opacity-polyfill.js"></script>
	<![endif]--> 

<!-- ~~~=| Theme jQuery |=~~~ --> 
<script src="js/main.js"></script>
</body>
</html>
