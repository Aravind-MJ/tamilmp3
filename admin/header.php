<!DOCTYPE html>
<?php
require 'check_session.php';
$url = $_SERVER['SCRIPT_FILENAME'];
$filename = basename($url);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- SELECT 2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
        <!-- REQUIRED JS SCRIPTS -->


        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>

        <script src="plugins/filestyle/bootstrap-filestyle.js" type="text/javascript"></script>
        <script src="plugins/filestyle/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <!-- FORM VALIDATOR -->
        <link href="plugins/formValidator/formValidation.min.css" rel="stylesheet" type="text/css"/>
        <script src="plugins/formValidator/formValidation.min.js" type="text/javascript"></script>
        <script src="plugins/formValidator/framework/bootstrap.js" type="text/javascript"></script>
        
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

        <!-- AngularJS -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>D</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b> DashBoard</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu text-center">
                        <ul class="nav navbar-nav" >
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu" style="width:150px;">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">Admin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <p>
                                            Admin
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="change.php" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Admin</p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- search form (Optional) -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <li class="header">Navigation</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li <?php
                        if ($filename == "home.php") {
                            echo 'class="active"';
                        }
                        ?>><a href="home.php"><i class='fa fa-paperclip'></i> <span>Dashboard</span></a></li>
                        <li class="treeview <?php
                        if ($filename == "add_song.php" || $filename == "view_song.php") {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><i class='fa fa-music'></i> <span>Songs</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li class="<?php
                                if ($filename == "add_song.php") {
                                    echo 'active';
                                }
                                ?>"><a href="add_song.php"><i class='fa fa-plus'></i>Add Song</a></li>
                                <li class="<?php
                                if ($filename == "view_song.php") {
                                    echo 'active';
                                }
                                ?>"><a href="view_song.php"><i class='fa fa-list'></i>List Songs</a></li>
                            </ul>
                        </li>
                         <li class="treeview <?php
                        if ($filename == "add_movie.php" || $filename == "view_movie.php") {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><i class='fa fa-film'></i> <span>Movies</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li class="<?php
                                if ($filename == "add_movie.php") {
                                    echo 'active';
                                }
                                ?>"><a href="add_movie.php"><i class='fa fa-plus'></i>Add Movie</a></li>
                                <li class="<?php
                                if ($filename == "view_movie.php") {
                                    echo 'active';
                                }
                                ?>"><a href="view_movie.php"><i class='fa fa-list'></i>List Movies</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php
                        if ($filename == "add_star.php" || $filename == "view_stars.php") {
                            echo 'active';
                        }
                        ?>">
                            <a href="#"><i class='fa fa-star'></i> <span>Actor/Actress</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li class="<?php
                                if ($filename == "add_star.php") {
                                    echo 'active';
                                }
                                ?>"><a href="add_star.php"><i class='fa fa-plus'></i>Add Actor/Actresses</a></li>
                                <li class="<?php
                                if ($filename == "view_stars.php") {
                                    echo 'active';
                                }
                                ?>"><a href="view_stars.php"><i class='fa fa-list'></i>List Actors/Actresses</a></li>
                            </ul>
                        </li>
                        <!--li><a href="#"><i class='fa fa-link'></i> <span>Another Link</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#">Link in level 2</a></li>
                                <li><a href="#">Link in level 2</a></li>
                            </ul>
                        </li-->
                    </ul><!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>