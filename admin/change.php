<?php include 'header.php'; ?>
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
        <center>
            <?php
            if (isset($_SESSION['status'])) {
                if ($_SESSION['status'] == 0) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Success!</h4>
                        Password Changed successfully
                    </div>
                <?php } else {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Success!</h4>
                        Incorrect Password
                    </div>
                    <?php
                }
                unset($_SESSION['status']);
            }
            ?>
            <div class="box box-primary" style="width:35%;">
                <div class="box-header">
                    <div class="box-tittle">
                        Change Password
                    </div>
                </div>
                <div class="box-body">
                    <form role="form" action="change_process.php" method="post" id="change">
                        <div class="form-group">
                            <label for="old-password" class="control-label">Enter Old Password</label>
                            <input type="password" class="form-control" placeholder="OLD PASSWORD" id="old-password" name="old-password">
                        </div>
                        <div class="form-group">
                            <label for="new-password" class="control-label">Enter New Password</label>
                            <input type="password" class="form-control" placeholder="NEW PASSWORD" id="newp-password" name="newp-password">
                        </div>
                        <div class="form-group">
                            <label for="con-password" class="control-label">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="CONFIRM PASSWORD" id="con-password" name="con-password">
                        </div>
                        <input type="submit" class="btn btn-info" value="CHANGE PASSWORD">
                    </form>
                </div>
            </div>
        </center>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>

    $(document).ready(function () {
        $('#change').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'old-password': {
                    message: 'The Password is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Password is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The Password must be more than 6 and less than 30 characters long'
                        }
                    }
                },
                'newp-password': {
                    message: 'The Password is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Password is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The Password must be more than 6 and less than 30 characters long'
                        }
                    }
                },
                'con-password': {
                    message: 'The Password is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Password is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The Password must be more than 6 and less than 30 characters long'
                        },
                        identical: {
                            field: 'newp-password',
                            message: 'The Confirm Password is Different. Should be same as New Password'
                        }
                    }
                }
            }
        });
    });

</script>
<?php include 'footer.php'; ?>

