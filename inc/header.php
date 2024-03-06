<?
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}
$lengthOfGenre = Genre::count($conn);
$result_Genre = Genre::getAll($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="header">
        <div class="navigation">
            <!-- <div class="logo">MyProject</div> -->
            <div class="logo">
                <a href="index.php" class="logo-link">
                    <img src="./uploads/logo2.png" alt="GARENA">
                    <!-- LOGO -->
                </a>
            </div>
            <ul class="header_menu">
                <li><a href="./index.php">Trang chủ</a></li>
                <li class='type_menubar'>
                    <a href="#">Thể loại</a>
                    <div class="menubar">
                        <?php for ($x = 0; $x < $lengthOfGenre / 3; $x++) : ?>
                            <ul class="row_3">
                                <?php for ($i = 0 + $x * 3; $i < 3 + $x * 3; $i++) : ?>
                                    <?php if ($i < $lengthOfGenre) : ?>
                                        <li class="col_3"><a href="./movielengthview.php?select-genre=<?= $result_Genre[$i]->id_genre ?>&index-page=0"><?= $result_Genre[$i]->namegenre ?></a></li>
                                    <?php else : ?>
                                        <? break; ?>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <div class="clear"></div>
                            </ul>
                        <?php endfor; ?>
                    </div>
                </li>
                <li class='type_menubar'>
                    <a href="#">Quốc gia</a>
                    <div class="menunation">
                        <ul class="row_3">
                            <li class="col_3"><a href="./movielengthview.php?select-nation=china&index-page=0">Trung Quốc</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=korea&index-page=0">Hàn Quốc</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=hongkong&index-page=0">Hồng Kong</a></li>
                            <div class="clear"></div>
                        </ul>

                        <ul class="row_3">
                            <li class="col_3"><a href="./movielengthview.php?select-nation=japan&index-page=0">Nhật Bản</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=vietnam&index-page=0">Việt Nam</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=thailand&index-page=0">Thái Lan</a></li>
                            <div class="clear"></div>
                        </ul>

                        <ul class="row_3">
                            <li class="col_3"><a href="./movielengthview.php?select-nation=india&index-page=0">Ấn Độ</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=us_uk&index-page=0">Âu - Mỹ</a></li>
                            <li class="col_3"><a href="./movielengthview.php?select-nation=dif&index-page=0">Khác</a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </li>
                <li><a href="./index.php#phimBo">Phim bộ</a></li>
                <li><a href="./index.php#phimLe">Phim lẻ</a></li>
            </ul>
            <div class="header_dangNhap">
                <div class="containersearch">
                    <?php if (isset($_GET["select-genre"])) : ?>
                        <input class="fix1" type="search" name="search" id="search" placeholder="Tìm kiếm....">
                        <button class="fix2 class="search_button" type="button"><i class='bx bx-search'></i></button>
                    <?php else : ?>
                        <input type="search" name="search" id="search" placeholder="Tìm kiếm....">
                        <button class="search_button" type="button"><i class='bx bx-search'></i></button>
                    <?php endif; ?>
                </div>
                <?php if (Auth::isLoggedIn()) : ?>
                    <div class="logout_user">
                        <!-- đường dẫn thông tin ?-->
                        <a href=""><i class='bx bx-user'></i><?= $u->getName() ?></a>
                        <div class="container_logout_user">
                            <a href="logout.php">Đăng xuất</a>
                        </div>
                    </div>

                <?php else : ?>
                    <a href="./login.php"><i class='bx bx-user'></i>Đăng nhập/Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>