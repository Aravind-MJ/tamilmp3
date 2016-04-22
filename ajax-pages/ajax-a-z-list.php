<?php require_once ('../db.php');?>

<?php

$alphabet     = isset($_GET['alphabet']) ? $_GET['alphabet'] : '0';
$sqlMovies    = sprintf("SELECT m.id, m.name FROM movies m WHERE m.name LIKE '%s'", $alphabet.'%');
$resultMovies = mysqli_query($link, $sqlMovies);
$movieArray   = array();
if (mysqli_num_rows($resultMovies) > 0) {
    while ($movieRow   = mysqli_fetch_assoc($resultMovies)) {
        $movieArray[] = $movieRow;
    }
} else {
    die('NO SONGS FOUND!');
}



$movieBy3cols  = array_chunk($movieArray, ceil(count($movieArray)/3));
$firstColList  = !empty($movieBy3cols[0]) ? $movieBy3cols[0] : array();
$secondColList = !empty($movieBy3cols[1]) ? $movieBy3cols[1] : array();
$thirdColList  = !empty($movieBy3cols[2]) ? $movieBy3cols[2] : array();

?>

<?php if (!empty($firstColList)):?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <ul class="lineup">
            <?php foreach ($firstColList as $firstList): ?>
                <li>
                    <div class="lineup-artist"><a href="album.php?id=<?php echo $firstList['id'];?>"><?php echo $firstList['name']?></a></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>

<?php if (!empty($secondColList)):?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <ul class="lineup">
            <?php foreach ($secondColList as $secondList): ?>
                <li>
                    <div class="lineup-artist"><a href="album.php?id=<?php echo $secondList['id'];?>"><?php echo $secondList['name']?></a></div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
<?php endif;?>

<?php if (!empty($thirdColList)):?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <ul class="lineup">
            <?php foreach ($thirdColList as $thirdList): ?>
                <li>
                    <div class="lineup-artist"><a href="album.php?id=<?php echo $thirdList['id'];?>"><?php echo $thirdList['name']?></a></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>