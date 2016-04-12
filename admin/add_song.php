<?php
include 'header.php';
include 'db.php';
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
            <li class="active">Add song</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <div class="box-title">Add Song</div>
            </div>
            <div class="box-body"> 
                <form role="form" action="add_song_process.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="song_name">SELECT SONG FILE</label>
                        <input type="file" name="file" id="file" class="form-control filestyle" required/>
                    </div>
                    <div class="form-group">
                        <label for="song_name">SONG NAME</label>
                        <input type="text" name="song_name" id="song_name" class="form-control" placeholder="SONG NAME"  required/>
                    </div>
                    <div class="form-group">
                        <label for="movie_name">MOVIE NAME</label>
                        <?php
                        $query = sprintf("SELECT id,name FROM movies");
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        ?>
                        <select class="form-control" id="movie_name" name="movie_name" required>
                            <option value="-1" ></option>
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
                        <label for="director">DIRECTOR</label>
                        <select class="form-control select2" id="director" name="director" multiple disabled>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="starring">STARRING</label>
                        <select class="form-control select2" id="starring" name="starring" multiple disabled>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">YEAR</label>
                        <input type="number" name="year" id="year" class="form-control" placeholder="YEAR" min="1000" max="9999" disabled/>
                    </div>
                    <div class="form-group">
                        <label for="movie_name">SINGERS</label>
                        <select class="form-control select2" id="singers" name="singers" required multiple>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submit" name="submit" class="btn btn-primary" value="ADD SONG"/>
                    </div>
                </form>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $('#movie_name').select2({tags: true});
        $('#singers').select2({tags: true});
        $('#director').select2();
        $('#starring').select2();
        $('#movie_name').change(function () {
            var id = $(this).val();
            $.post("get_data.php",
                    {
                        id: id
                    },
                    function (response) {
                        
                    }
            );
        });
    });
</script>
<?php include 'footer.php'; ?>


