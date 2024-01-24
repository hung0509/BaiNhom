<?
    require "inc/init.php";

    $conn = require "inc/db.php";
    $result_film = Movie::getAll($conn);// Lấy ra toàn bộ dòng
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
        
        <?require "./header.php";?>

        <div id="slibar">

        </div>

        <div id="content">
            <!-- Phim bộ -->
            
            <div id="phimBo" class="container_type_cineme">
                <div class="spacecolor"></div>
                <div  class="name_type">PHIM BỘ MỚI
                    <a href="./login.php">Xem thêm</a>
                </div>
                <?php for ($x = 0;$x < 3; $x++):?>
                    <div class="row">
                        <?php for ($i = 0 + $x*4; $i < 4 + $x*4; $i++):?>
                            <div class="col_4">
                                <a href="./detail.php?id_movie=<? echo $result_film[$i]->id_movie?>">
                                    <img src=<?=$result_film[$i]->imagefile?> alt="Hình ảnh minh họa">
                                    <div class="name_film"><?=$result_film[$i]->moviename?></div>
                                </a>
                             </div>
                        <?php endfor;?>
                        <div class="clear"></div>
                    </div>
                <?php endfor;?>
            </div>

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
                <div  class="name_type">PHIM LẺ MỚI
                    <a href="./login.php">Xem thêm</a>
                </div>
                <?php for ($x = 0;$x < 3; $x++):?>
                    <div class="row">
                        <?php for ($i = 0 + $x*4; $i < 4 + $x*4; $i++):?>
                            <div class="col_4">
                                <a href="./detail.php?id_movie=<? echo $result_film[$i]->id_movie?>">
                                    <img src=<?=$result_film[$i]->imagefile?> alt="Hình ảnh minh họa">
                                    <div class="name_film"><?=$result_film[$i]->moviename?></div>
                                </a>
                             </div>
                        <?php endfor;?>
                        <div class="clear"></div>
                    </div>
                <?php endfor;?>
            </div>
        </div>
        
        <div id="footer"></div>
    </div>
</body>
</html>