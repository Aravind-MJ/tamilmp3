<?php include 'header.php'; ?>
<?php
include 'db.php';
$id = $_GET['id'];
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
            <li>Actor/Actress</li>
            <li class="active">Add a Star</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">
                    Add a Star
                </div>
            </div>
            <div class="box-body">
                <?php
                $query = sprintf("SELECT * FROM stars WHERE id=%d", $id);
                $result = mysqli_query($link, $query) or die(mysqli_error($link));
                $row = mysqli_fetch_assoc($result);
                ?>
                <form role="form" action="edit_star_process.php" method="post" id="movie_form" enctype="multipart/form-data">
                    <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" hidden>
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label">SELECT IMAGE FILE (Optional)</label>
                        <input type="file" name="image" id="image" class="form-control filestyle" accept="image/*"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="ADD STAR"/>
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
                    message: 'The Star name  is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Star Name is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'The Star Name can only consist of alphabetical,and spaces'
                        }
                    }
                }
            }
        });
    });
</script>
<?php include 'footer.php'; ?>