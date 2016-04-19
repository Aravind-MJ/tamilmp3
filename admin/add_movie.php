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
            <li>Home</li>
            <li class="active">Add Movie</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">
                    Add Movie
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
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-info"></i> Failed!</h4>
                            Movie Already Exists
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
                <form role="form" action="add_movie_process.php" method="post" id="movie_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="director" class="control-label">DIRECTOR</label>
                        <select class="form-control select2" id="director" name="director[]" multiple >

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="starring" class="control-label">STARRING</label>
                        <select class="form-control select2" id="starring" name="starring[]" multiple >

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="control-label">Year</label>
                        <input type="text" id="year" name="year" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image" class="control-label">SELECT IMAGE FILE</label>
                        <input type="file" name="image" id="image" class="form-control filestyle" accept="image/*"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="ADD MOVIE"/>
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
                    message: 'The movie is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Movie Name is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The Movie Name must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\-_\.]+$/,
                            message: 'The Movie Name can only consist of alphabetical, number, dot, hyphen and underscore'
                        }
                    }
                },
                'director[]': {
                    trigger: 'change',
                    message: 'Select Director',
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Director'
                        }
                    }
                },
                'starring[]': {
                    trigger: 'change',
                    message: 'Select Actors',
                    validators: {
                        notEmpty: {
                            message: 'Please Select Actors'
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
                            message: 'Please choose an Image File of jpg format.'
                        }
                    }
                },
                year: {
                    trigger: 'change',
                    message: 'Enter a Year',
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Year'
                        },
                        regexp: {
                            regexp: /^[0-9]{4}$/,
                            message: 'Invalid Year'
                        }
                    }
                }
            }
        });
    });

    $.post("get_data.php",
            {
                id: 'new'
            },
            function (response) {
                data = JSON.parse(response);
                $('#director').select2({data: data[0], tags: true});
                $('#starring').select2({data: data[1], tags: true});

            }
    );
</script>
<?php include 'footer.php'; ?>