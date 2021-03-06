<?php
include 'header.php';
include 'db.php';
if ($_GET) {
    $id = $_GET['id'];
}
?>
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .content {
        width:70% !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admin
            <small>Add Song</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Admin </a></li>
            <li class="active">Edit song</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!--div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h2><i class="icon fa fa-info"></i> Note!</h2>
            <h4>This single page powers the addition of all data to the database without going to other pages. <br><br>
                If you don't see a suggestion don't worry, just add it manually and it will be added to the database automatically. <br><br>
                Quite useful isn't it?!</h4>
        </div-->
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">Edit Song</div>
            </div>
            <div class="box-body"> 
                <form id="song_form" role="form" action="edit_song_process.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="song_id" id="song_id" value="<?php echo $id; ?>" hidden/>
                    <div class="form-group">
                        <label for="song_name" class="control-label">SONG NAME</label>
                        <input type="text" name="song_name" id="song_name" class="form-control" placeholder="SONG NAME"/>
                    </div>
                    <div class="form-group">
                        <label for="movie_name" class="control-label">MOVIE NAME</label>
                        <?php
                        $query = sprintf("SELECT id,name FROM movies");
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        ?>
                        <select class="form-control" id="movie_name" name="movie_name">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="movie_message text-danger">
                        </div>
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
                        <label for="year" class="control-label">YEAR</label>
                        <input type="text" name="year" id="year" class="form-control" placeholder="YEAR" />
                    </div>
                    <div class="form-group">
                        <label for="movie_name" class="control-label">SINGERS</label>
                        <?php
                        $query = sprintf("SELECT id,name FROM singers");
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        ?>
                        <select class="form-control select2" id="singers" name="singers[]" multiple>
                            <option value="" ></option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="music_directors" class="control-label">MUSIC DIRECTOR</label>
                        <?php
                        $query = sprintf("SELECT id,name FROM music_directors");
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        ?>
                        <select class="form-control" id="music_directors" name="music_directors[]" multiple>
                            <option value="" ></option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="UPDATE SONG"/>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {

        $('#song_form').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                song_name: {
                    message: 'The song is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Song Name is required and can\'t be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The Song Name must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9\-_\.]+$/,
                            message: 'The Song Name can only consist of alphabetical, number, dot, hyphen and underscore'
                        }
                    }
                },
                movie_name: {
                    message: 'Select a Movie',
                    validators: {
                        notEmpty: {
                            message: 'Please select a Movie'
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
                },
                'singers[]': {
                    message: 'Select Singers',
                    validators: {
                        notEmpty: {
                            message: 'Please Select Singers'
                        }
                    }
                },
                'music_directors[]': {
                    message: 'Select Music Directors',
                    validators: {
                        notEmpty: {
                            message: 'Please Select Music Directors'
                        }
                    }
                }
            }
        });




        $.post("edit_song_data.php",
                {
                    id: <?php echo $id; ?>
                },
                function (response) {
                    data = JSON.parse(response);
                    $('#song_name').val(data[0]).trigger("change");
                    $('#movie_name').select2({data: data[1], tags: true}).val(data[2]).trigger("change");
                    $('#year').val(data[3]).trigger("change");
                    $('#director').select2({data: data[4], tags: true}).val(data[5]).trigger("change");
                    $('#starring').select2({data: data[6], tags: true}).val(data[7]).trigger("change");
                    $('#singers').select2({data: data[8], tags: true}).val(data[9]).trigger("change");
                    $('#music_directors').select2({data: data[10], tags: true}).val(data[11]).trigger("change");

                }
        );

        $('#movie_name').change(function () {
            $('.movie_message').hide();
            $('#director').prop('disabled', false);
            $('#starring').prop('disabled', false);
            $('#year').prop('disabled', false);
            var id = $(this).val();
            if (!isNaN(id)) {
                $.post("get_data.php",
                        {
                            id: id
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
            } else {
                $('.movie_message').show();
                $('.movie_message').text("The Movie You Entered Doesnot Exists. Please add the Details of the movie Below");
                $.post("get_data.php",
                        {
                            id: "new"
                        },
                        function (response) {
                            data = JSON.parse(response);
                            $('#director').select2({data: data[0], tags: true}).val(null).trigger("change");
                            $('#starring').select2({data: data[1], tags: true}).val(null).trigger("change");
                            $('#year').val(null).trigger("change");

                        }
                );

            }
        });
    });
</script>
<?php include 'footer.php'; ?>


