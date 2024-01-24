<?
if(isset($_SESSION['user']) && $_SESSION['user'] != null){
    $u = $_SESSION['user'];
}else{
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
            <div class="logo">MyProject</div>
            <ul class="header_menu">
                <li><a href="#">Trang chủ</a></li>
                <li class='type_menubar'>
                    <a href="./login.php">Thể loại</a>
                    <div class="menubar">
                        <?php for ($x = 0; $x < $lengthOfGenre / 3; $x++) : ?>
                            <ul class="row_3">
                                <?php for ($i = 0 + $x * 3; $i < 3 + $x * 3; $i++) : ?>
                                    <?php if ($i < $lengthOfGenre) : ?>
                                        <li class="col_3"><a href=""><?= $result_Genre[$i]->namegenre ?></a></li>
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
                    <a href="./login.php">Quốc gia</a>
                    <div class="menunation">
                        <ul class="row_3">
                            <li class="col_3"><a href="">Trung Quốc</a></li>
                            <li class="col_3"><a href="">Hàn Quốc</a></li>
                            <li class="col_3"><a href="">Hồng Kong</a></li>
                            <div class="clear"></div>
                        </ul>

                        <ul class="row_3">
                            <li class="col_3"><a href="">Nhật Bản</a></li>
                            <li class="col_3"><a href="">Việt Nam</a></li>
                            <li class="col_3"><a href="">Thái Lan</a></li>
                            <div class="clear"></div>
                        </ul>

                        <ul class="row_3">
                            <li class="col_3"><a href="">Ấn Độ</a></li>
                            <li class="col_3"><a href="">Âu - Mỹ</a></li>
                            <li class="col_3"><a href="">Khác</a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                </li>
                <li><a href="#phimBo">Phim bộ</a></li>
                <li><a href="#phimLe">Phim lẻ</a></li>
            </ul>
            <div class="header_dangNhap">
                <div class="containersearch">
                    <input type="search" name="search" id="search" placeholder="Tìm kiếm....">
                    <button class="search_button" type="button"><i class='bx bx-search'></i></button>
                </div>
                <?php if ($u) : ?>
                    <a href=""><i class='bx bx-user'></i><?=$u->getName()?></a>
                <?php else : ?>
                    <a href="./login.php"><i class='bx bx-user'></i> Đăng nhập/Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>