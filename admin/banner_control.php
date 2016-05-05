<?php
include 'header.php';
include 'db.php';
?>
<style>
    img {
        width: 597px;
        height:314px;
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
            <li class="active">Banner Control</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] == 0) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Image Name Already exists. Please rename the Image and try Again.<a href="#" class="alert-link"></a>.
                </div>
            <?php } else if ($_SESSION['status'] == 1) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Invalid Image type. Please use JPG or JPEG format Images<a href="#" class="alert-link"></a>.
                </div>
            <?php } else if ($_SESSION['status'] == 2) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    File size Exeeds 5MB. Please use Images below 5MB size. <a href="#" class="alert-link"></a>.
                </div>
            <?php }else if ($_SESSION['status'] == 3) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    File Uploaded Successfully. <a href="#" class="alert-link"></a>.
                </div>
            <?php }else if ($_SESSION['status'] == 4) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    File Upload Failed <a href="#" class="alert-link"></a>.
                </div>
            <?php } else if ($_SESSION['status'] == 5) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    File not Detected <a href="#" class="alert-link"></a>.
                </div>
            <?php } else if ($_SESSION['status'] == 6) {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Deleted Successfully <a href="#" class="alert-link"></a>.
                </div>
            <?php } else if ($_SESSION['status'] == 7) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Deletion Failed <a href="#" class="alert-link"></a>.
                </div>
            <?php }?>
            <?php
            unset($_SESSION['status']);
        }
        ?>

        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">
                    Banner Control
                </div>
            </div>
            <div class="box-body">
                <form action="banner_control_process.php" method="post" id="banner" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>IMAGE</label>
                        <input type="file" name="image" id="image" class="form-control filestyle" accept="image/*"/>
                    </div>
                    <input type="submit" class="btn btn-primary" value="ADD">
                </form>
            </div>
        </div>
        <br>
        <div class="box box-success">
            <div class="box-header">
                <div class="box-title">
                    Banner Details
                </div>
            </div>
            <div class="box-body">
                <table id="bannerTable" class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th width="100px">#</th>
                            <th>Image</th>
                            <th width="200px">Active</th>
                            <th width="200px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = sprintf("SELECT * FROM banner WHERE del_status=0");
                        $result = mysqli_query($link, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="banner/<?php echo $row['file']; ?>" alt="Banner Image"></td>
                                <td><input <?php echo ($row['active'] == '1') ? 'checked' : ''; ?> rowid="<?php echo $row['id']; ?>" data-on="Active" data-off="Inactive" class="toggle-event" data-toggle="toggle" type="checkbox"></td>
                                <td><a href="javascript:void(0)" onclick="deleteConfirm('delete_banner.php?id=<?= $row['id'] ?>')" class="btn btn-danger "><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>

    function deleteConfirm(href) {
        var ask = window.confirm("Are you sure you want to delete this item?");
        if (ask) {
            document.location.href = href;
        }
    }

    $(document).ready(function () {
        
        $('.toggle-event').change(function() {
//            alert("asda");
            var status = $(this).prop('checked')==true?'1':'0';
            var rowId  = $(this).attr('rowid');
//            alert(status);
            url = "banner_active.php";
            $.ajax({
                url:url,
                type:'POST',
                data:{id:rowId, status:status}
            }).done(function( data ) {
               if(data=="SUCCESS"){
                   //alert("State Changed");
               }else{
                   alert("State Change Failed");
               }
            });

        });

        $('#bannerTable').DataTable({
            responsive: true
        });

        $('#banner').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                image: {
                    message: 'Select a File',
                    validators: {
                        notEmpty: {
                            message: 'Please select an Image file'
                        },
                        file: {
                            extension: 'jpg,jpeg',
                            type: 'image/jpeg,image/jpg',
                            message: 'Please choose an Image File of jpg or jpeg format.'
                        }
                    }
                }
            }
        });
    });
</script>
<?php include 'footer.php'; ?>