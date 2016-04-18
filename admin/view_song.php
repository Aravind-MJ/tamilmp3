<?php include 'header.php'; ?>
<script src="view_song.js" type="text/javascript"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li class="active">Home</li>
        </ol>
    </section>

    <!-- Main content -->

    <section class="content">
        <?php
        if ($_GET) {

            $status = $_GET['status'];

            if ($status == 0) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Success!</h4>
                    Song Edited successfully Added
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Failed!</h4>
                    <?php echo $_GET['status']; ?>
                </div>
                <?php
            }
        }
        ?>

        <div class="box box-success" ng-app="songApp" ng-controller="songCtrl">
            <div class="box-header">
                <div class="box-title">
                    View Songs
                </div>
            </div>
            <div class="box-body">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <select ng-model="limit" ng-change="searchFn()" class="form-control">
                            <option value="10" ng-selected="true">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" ng-model="search" ng-change="searchFn()" class="form-control">
                    </div>
                </div>
                <table id="song_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Song Name</th>
                            <th>Movie Name</th>
                        </tr>
                    </thead>
                    <tr ng-repeat="song in songs">
                        <td>{{ $index + 1}}</td>
                        <td>{{ song.song }}</td>
                        <td>{{ song.movie }}</td>
                </table>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include 'footer.php'; ?>