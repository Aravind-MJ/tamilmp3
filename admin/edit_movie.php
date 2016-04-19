<?php
$id = $_GET['id'];

if (isset($id)) {

    include 'header.php';
    include 'db.php';
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
                    <form role="form" action="edit_movie_process.php" method="post" id="movie_form" enctype="multipart/form-data">
                        <?php
                        $query = sprintf("SELECT * FROM movies WHERE id=%d", $id);
                        $row = mysqli_fetch_assoc(mysqli_query($link, $query));
                        ?>
                        <input type="text" name="id" id="id" value="<?php echo $id; ?>" hidden/>
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>">
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
                            <input type="text" id="year" name="year" class="form-control" value="<?php echo $row['year']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label">CHANGE IMAGE (Optional)</label>
                            <input type="file" name="image" id="image" class="form-control filestyle" accept="image/*"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="EDIT MOVIE"/>
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
                            file: {
                                extension: 'jpg',
                                type: 'image/jpeg',
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
                    id: <?php echo $id; ?>
                },
                function (response) {
                    data = JSON.parse(response);
                    $('#year').val(data[0]).trigger("change");
                    $('#director').select2({data: data[1], tags: true});
                    $('#director').val(data[2]).trigger("change");
                    $('#starring').select2({data: data[3], tags: true});
                    $('#starring').val(data[4]).trigger("change");

                }
        );
    </script>
    <?php
    include 'footer.php';
} else {
    echo '<h1>ACCESS DENIED!!!</h1>';
}
?>