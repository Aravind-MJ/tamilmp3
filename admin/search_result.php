<?php
if ($_POST) {
    $search = $_POST['search'];
    include 'header.php';
    include 'db.php';
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin
                <small>Search Result</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li>Search</li>
                <li class="active">Result</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-success" id="songs">
                <div class="box-header">
                    <div class="box-title">
                        Songs Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM songs WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_song.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_song.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box box-success" id="movies">
                <div class="box-header">
                    <div class="box-title">
                        Movies Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM movies WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_movie.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_movie.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box box-success" id="mcdirectors">
                <div class="box-header">
                    <div class="box-title">
                        Music Directors Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM music_directors WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_music_director.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_music_director.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box box-success" id="singers">
                <div class="box-header">
                    <div class="box-title">
                        Singers Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM singers WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_singer.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_singer.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box box-success" id="actors">
                <div class="box-header">
                    <div class="box-title">
                        Actors/Actresses Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM stars WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_star.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_star.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="box box-success" id="mvdirectors">
                <div class="box-header">
                    <div class="box-title">
                        Movie Directors Matching Search
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $query = sprintf("SELECT * FROM directors WHERE name LIKE '%%%s%%'", $search);
                    $result = mysqli_query($link, $query);
                    ?>
                    <table id="movie_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td width="100px">
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-warning" href="edit_movie_director.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                    </td>
                                    <td width="100px">
                                        <a class="btn btn-danger" href="delete_movie_director.php?id=<?php echo $row['id']; ?>">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php
    include 'footer.php';
} else {
    echo '<h1>ACCESS DENIED!!!!</h1>';
}
?>