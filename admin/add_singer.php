<?php include 'header.php'; ?>
<?php
$status = $_GET['status'];
?>
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
            <li>Singer</li>
            <li class="active">Add a Singer</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">
                    Add Singer
                </div>
            </div>
            <div class="box-body">
                <?php
                if (isset($status)) {
                    if ($status == 0) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Success!</h4>
                            All Data successfully Added
                        </div>
                        <?php
                    } else if ($status == 1) {
                        ?>
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Failed!</h4>
                            Star Already Exists
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
                <form role="form" action="add_singer_process.php" method="post" id="movie_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label">SELECT IMAGE FILE</label>
                        <input type="file" name="image" id="image" class="form-control filestyle" accept="image/*"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="ADD SINGER"/>
                    </div>
                </form>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {

        $('#movie_form').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    message: 'The Singer name  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The singer Name is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'The Singer Name can only consist of alphabetical,and spaces'
                        }
                    }
                },
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