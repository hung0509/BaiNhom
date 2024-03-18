<?
require "inc/init.php";

$conn = require "inc/db.php";
$result_film_series = Movie::getPagingByLength($conn, 12, 0, "Phim bộ");
$result_film_short = Movie::getPagingByLength($conn, 12, 0, "Phim lẻ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/slick.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
    <title>My Project</title>
</head>

<body>
    <header id="header">
        <? require "./inc/header.php"; ?>
    </header>
    <main>
        <div id="slideshow">
            <div>
                <a href="./detail.php?id_movie=<?= 7 ?>">
                    <img class="img" src="./uploads/slide-pictures/Fast-Furious-poster.png"></a>
            </div>
            <div>
                <a href="./detail.php?id_movie=<?= 10 ?>">
                    <img class="img" src="./uploads/slide-pictures/loki-season-2-poster.jpg"></a>
            </div>
            <div>
                <a href="./detail.php?id_movie=<?= 1 ?>">
                    <img class="img" src="./uploads/slide-pictures/mydemon-poster.png"></a>
            </div>
            <div>
                <a href="./detail.php?id_movie=<?= 4 ?>">
                    <img class="img" src="./uploads/slide-pictures/Poster-Van-Chi-Vu.jpg"></a>
            </div>
            <div>
                <a href="./detail.php?id_movie=<?= 7 ?>">
                    <img class="img" src="./uploads/slide-pictures/welcome-to-samdali-poster.jpg"></a>
            </div>
        </div>
        <div id="content-container">
            <div class="movie-container">
                <div id="space1"></div>
                <div class="type-movie-container">
                    <div id="phimBo" class="header-type-movie">
                        <h2>PHIM BỘ MỚI</h2>
                        <a href="./movielengthview.php?movie-length=1&index-page=0">XEM THÊM</a>
                    </div>

                    <div class="row">
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <?php if (isset($result_film_series[$i])) : ?>
                                <div class="col_4">
                                    <a href="./detail.php?id_movie=<? echo $result_film_series[$i]->id_movie ?>">
                                        <?= $result_film_series[$i]->checkImage() ?>
                                        <img src=<?= $result_film_series[$i]->imagefile ?> alt="Hình ảnh minh họa">
                                        <div class="name_film"><?= $result_film_series[$i]->moviename ?></div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="type-movie-container">
                    <div id="space12"></div>
                    <div id="phimLe" class="header-type-movie">
                        <h2>PHIM LẺ MỚI</h2>
                        <a href="./movielengthview.php?movie-length=0&index-page=0">XEM THÊM</a>
                    </div>

                    <div class="row">
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <?php if (isset($result_film_short[$i])) : ?>
                                <div class="col_4">
                                    <a href="./detail.php?id_movie=<? echo $result_film_short[$i]->id_movie ?>">
                                        <?= $result_film_short[$i]->checkImage() ?>
                                        <img src=<?= $result_film_short[$i]->imagefile ?> alt="Hình ảnh minh họa">
                                        <div class="name_film"><?= $result_film_short[$i]->moviename ?></div>
                                    </a>
                                </div>
                            <?php endif ?>
                        <?php endfor; ?>
                    </div>
                </div>



            </div>

            <aside>
                <div class="oustanding_films">
                    <h2>Nổi bật</h2>
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
            </aside>
        </div>
        <hr style="line-style:solid;margin-top: 30px;width: 100%; align: center; color: #59554b" />
    </main>
    <!--    <footer id='footer'> -->
    <? require "./inc/footer.php" ?>
    <!--    </footer>-->



    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/slick.min.js"></script>

    <script>
        $('#slideshow').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            autoplay: true
        });
    </script>

</body>

</html>