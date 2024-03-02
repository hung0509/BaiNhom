<?
require "inc/init.php";
$conn = require "inc/db.php";

//Lấy ra số lượng phim
$countFilms = Movie::count($conn);
//Lấy ra số page example 1page:10 movie
$countPages = $countFilms / 10;

//Lấy ra page đang được chọn
if (isset($_GET['index-page']) && isset($_GET["movie-length"])) {
    $index_page = $_GET['index-page'];
    $var = $_GET['movie-length'];
    if ($var == 1) {
        $name = "Phim bộ";
    } else {
        $name = "Phim lẻ";
    }
    $list_movie = Movie::getPagingByLength($conn, 10, $index_page * 10, $name);
} else if (isset($_GET['index-page']) && $_GET['index-page'] >= 0 && isset($_GET["select-nation"])) {
    $index_page = $_GET['index-page'];
    $var = $_GET['select-nation'];
    switch ($var) {
        case "china":
            $name = "Trung Quốc";
            break;
        case "korea":
            $name = "Hàn Quốc";
            break;
        case "hongkong":
            $name = "Hồng Kông";
            break;
        case "japan":
            $name = "Nhật Bản";
            break;
        case "vietnam":
            $name = "Việt Nam";
            break;
        case "thailand":
            $name = "Thái Lan";
            break;
        case "india":
            $name = "Ấn Độ";
            break;
        case "us_uk":
            $name = "Âu - Mỹ";
            break;
        case "dif":
            $name = "Khác";
            break;
    }
    $list_movie = Movie::getPagingByNation($conn, 10, $index_page * 10, $name);
} else if (isset($_GET['index-page']) && $_GET['index-page'] >= 0 && isset($_GET["select-genre"])) {
    $var = $_GET['select-genre'];
    $index_page = $_GET['index-page'];
    $name = Genre::getNamebyID($conn, $var);
    $list_movie = Movie::getPagingByGenre($conn, 10, $index_page * 10, $var);
}
//Khi chọn trang

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <div id="main">

        <? require "./inc/header.php"; ?>

        <div class="container_seriesfilm">
            <div class="name_type"><?= $name ?></div>
            <?php for ($x = 0; $x < 1; $x++) : ?>
                <div class="row">
                    <?php for ($i = 0; $i < 10; $i++) : ?>
                        <?php if (isset($list_movie[$i])) : ?>
                            <div class="col_4 setupFilm">
                                <a href="./detail.php?id_movie=<? echo $list_movie[$i]->id_movie ?>">
                                    <img class="setupImage" src=<?= $list_movie[$i]->imagefile ?> alt="Hình ảnh minh họa">
                                    <div class="name_film"><?= $list_movie[$i]->moviename ?></div>
                                </a>
                            </div>
                        <?php else : ?>
                            <? continue; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <div class="clear"></div>
                </div>
            <?php endfor; ?>

            <!-- Tạo button số trang -->
            <div class="pages">
                <?php for ($i = 0; $i < $countPages; $i++) : ?>
                    <?php if (isset($_GET["movie-length"])) : ?>
                        <a href="./movielengthview.php?index-page=<?= $i ?>&movie-length=<?= $var ?>"><?= $i ?></a>
                    <?php endif; ?>
                    <?php if (isset($_GET["select-nation"])) : ?>
                        <a href="./movielengthview.php?index-page=<?= $i ?>&select-nation=<?= $var ?>"><?= $i ?></a>
                    <?php endif; ?>
                    <?php if (isset($_GET["select-genre"])) : ?>
                        <a href="./movielengthview.php?index-page=<?= $i ?>&select-genre=<?= $var ?>"><?= $i ?></a>
                    <?php endif; ?>

                <?php endfor; ?>
            </div>
        </div>
</body>

</html>