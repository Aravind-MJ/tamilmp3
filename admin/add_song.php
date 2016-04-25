<?php
include 'header.php';
include 'db.php';
$status = $_GET['status'];
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
            <li>Songs</li>
            <li class="active">Add song</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h2><i class="icon fa fa-info"></i> Note!</h2>
            <ul><li>
            <h5>This single page powers the addition of all data to the database without going to other pages. <br><br>
                If you don't see a suggestion don't worry, just add it manually and it will be added to the database automatically. <br><br>
                Quite useful isn't it?!</h5></li>
                <li>P.S : Don't Forget to press Enter After Entering a New Name</li>
            </ul>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">Add Song</div>
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
                <form id="song_form" role="form" action="add_song_process.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="song_file" class="control-label">SELECT SONG FILE</label>
                        <input type="file" name="song_file" id="song_file" class="form-control filestyle" accept="audio/*"/>
                    </div>
                    <!--div class="progress">
                        <div class="progress-bar progress-bar-green" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                        </div>
                    </div-->
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
                            <option value="">Type Movie Name</option>
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
                        <label for="singers" class="control-label">SINGERS</label>
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
                        <input type="submit" id="submitButton" name="submitButton" class="btn btn-primary" value="ADD SONG"/>
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
                song_file: {
                    message: 'Select a File',
                    validators: {
                        notEmpty: {
                            message: 'Please select a song file'
                        },
                        file: {
                            extension: 'mp3,mpeg,ogg',
                            type: 'audio/mp3,audio/mpeg,audio/ogg',
                            message: 'Please choose an Audio File of mp3,wav or ogg.'
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








        $('#movie_name').select2({placeholder: "Select a Movie", tags: true, tokenSeparators: [',', ' ']});
        $('#singers').select2({placeholder: "Select Singer", tags: true, tokenSeparators: [',', ' ']});
        $('#music_directors').select2({placeholder: "Select Music Director", tags: true, tokenSeparators: [',']});
        $('#director').select2();
        $('#starring').select2();

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
                            $('#year').val(data[0]).trigger("change").prop('disabled', true);
                            $('#director').select2({data: data[1], tags: true});
                            $('#director').val(data[2]).trigger("change").prop('disabled', true);
                            $('#starring').select2({data: data[3], tags: true});
                            $('#starring').val(data[4]).trigger("change").prop('disabled', true);

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


