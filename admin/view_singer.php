<?php include 'header.php'; ?>
<script src="view_singer.js" type="text/javascript"></script>
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
            <li>Singers</li>
            <li class="active">List Singers</li>
        </ol>
    </section>

    <!-- Main content -->

    <section class="content">
        <?php
        if ($_GET) {

            $status = $_GET['status'];

            if (is_numeric($status)) {
                if ($status == 0) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Success!</h4>
                        Singer Edited successfully
                    </div>
                    <?php
                } else if ($status == 1) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Success!</h4>
                        Singer Deleted successfully
                    </div>
                    <?php
                }
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

        <div class="box box-success" ng-app="directorApp" ng-controller="directorCtrl">
            <div class="box-header">
                <div class="box-title">
                    View Movie Directors
                </div>
            </div>
            <div class="box-body">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <select ng-model="limit" class="form-control">
                            <option value="10" ng-selected="true">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="search">Search by Singer Name</label>
                        <input type="text" ng-model="search" ng-change="searchFn()" class="form-control">
                    </div>
                </div>
                <table id="song_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Director Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tr ng-repeat="singer in singers">
                        <td>{{ offset * limit + $index + 1}}</td>
                        <td>{{ singer.name}}</td>
                        <td>
                            <a class="btn btn-warning" href="edit_movie_director.php?id={{ singer.id}}">EDIT</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="delete_movie_director.php?id={{ singer.id}}">DELETE</a>
                        </td>
                    </tr>
                </table>
                <center>
                <ul class="pagination pagination-lg">
                    <li class="previous" ng-click="prev()"><a href="#">Previous</a></li>
                    <li ng-repeat="a in range(pagelimit) track by $index" ng-click="goto($index)" ng-class="{active: $index==offset}"><a href="#">{{ $index + 1}}</a></li>
                    <li class="next" ng-click="next()"><a href="#">Next</a></li>
                </ul>
                </center>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include 'footer.php'; ?>