<?
require "inc/init.php";

$conn = require "inc/db.php";
//$result_film = Movie::getAll($conn);// Lấy ra toàn bộ dòng
$result_film_series = Movie::getPagingByLength($conn, 12, 0, "Phim bộ");
$result_film_short = Movie::getPagingByLength($conn, 12, 0, "Phim lẻ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>MyProject</title>
</head>

<body>
    <div id="main">

        <? require "./inc/header.php"; ?>

        <div id="slibar">

        </div>

        <div id="content">
            <!-- Phim bộ -->

            <div id="phimBo" class="container_type_cineme">
                <div class="spacecolor"></div>
                <div class="name_type">PHIM BỘ MỚI
                    <a href="./movielengthview.php?movie-length=1&index-page=0">Xem thêm</a>
                </div>
                <div class="row">
                    <?php for ($i = 0; $i < 12; $i++) : ?>
                        <?php if (isset($result_film_short[$i])) : ?>
                            <div class="col_4">
                                <a href="./detail.php?id_movie=<? echo $result_film_series[$i]->id_movie ?>">
                                    <img src=<?= $result_film_series[$i]->imagefile ?> alt="Hình ảnh minh họa">
                                    <div class="name_film"><?= $result_film_series[$i]->moviename ?></div>
                                </a>
                            </div>
                        <?php endif ?>
                    <?php endfor; ?>
                    <div class="clear"></div>
                </div>
            </div>

            <!-- Phần nổi bật cần fix lại theo lượt xem????-->
            <div class="oustanding_films">
                <div class="title">Nổi bật</div>
                <div class="outstanding-film">
                    <img src="./uploads/anh1.jpg" alt="Hinh 1">
                    <div class="name-film">Chàng quỷ của tôi</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh2.jpg" alt="Hinh 1">
                    <div class="name-film">Cuộc chiến sinh tồn</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh3.jpg" alt="Hinh 1">
                    <div class="name-film">Sinh Vật Gyeongseongi</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh10.jpg" alt="Hinh 1">
                    <div class="name-film">Loki</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh5.jpg" alt="Hinh 1">
                    <div class="name-film">Phản Bội / Thế Giới Hôn Nhân</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh7.jpg" alt="Hinh 1">
                    <div class="name-film">Quá Nhanh Quá Nguy Hiểm 8</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh7.jpg" alt="Hinh 1">
                    <div class="name-film">Quá Nhanh Quá Nguy Hiểm 8</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh7.jpg" alt="Hinh 1">
                    <div class="name-film">Quá Nhanh Quá Nguy Hiểm 8</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh7.jpg" alt="Hinh 1">
                    <div class="name-film">Quá Nhanh Quá Nguy Hiểm 8</div>
                </div>
                <div class="outstanding-film">
                    <img src="./uploads/anh7.jpg" alt="Hinh 1">
                    <div class="name-film">Quá Nhanh Quá Nguy Hiểm 8</div>
                </div>
            </div>

            <div id="phimLe" class="container_type_cineme">
                <div class="spacecolor"></div>
                <div class="name_type">PHIM LẺ MỚI
                    <a href="./movielengthview.php?movie-length=0&index-page=0">Xem thêm</a>
                </div>

                <div class="row">
                    <?php for ($i = 0; $i < 12; $i++) : ?>
                        <?php if (isset($result_film_short[$i])) : ?>
                            <div class="col_4">
                                <a href="./detail.php?id_movie=<? echo $result_film_short[$i]->id_movie ?>">
                                    <img src=<?= $result_film_short[$i]->imagefile ?> alt="Hình ảnh minh họa">
                                    <div class="name_film"><?= $result_film_short[$i]->moviename ?></div>
                                </a>
                            </div>
                        <?php endif ?>
                    <?php endfor; ?>
                    <div class="clear"></div>
                </div>

            </div>
        </div>

        <div id="footer">

        </div>
    </div>
</body>

</html>