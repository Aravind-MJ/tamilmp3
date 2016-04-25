<?php
if ($_GET) {
    $id = $_GET['id'];
    include 'header.php';
    ?>
<style>
    .box{
        text-align: center;
    }
    .btn{
        width: 100px;
        padding: 10px;
        margin: 20px;
    }
</style>
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
                <li class="active">Confirm</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-danger">
                <div class="box-header">
                    <div class="box-title text-danger">
                        <span class="fa fa-info"></span> CONFIRM?
                    </div>
                    <div class="box-body">
                        Once deleted the Data cannot be Retrieved...<br>
                        Are you sure you want to Continue?<br>
                        <a class="btn btn-danger" href="delete_song_process.php?id=<?php echo $id; ?>">YES</a>
                        <a class="btn btn-success" href="view_song.php">NO</a>
                    </div>
                </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php
    include 'footer.php';
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}
?>