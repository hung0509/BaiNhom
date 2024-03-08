<?
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}
$lengthOfGenre = Genre::count($conn);
$result_Genre = Genre::getAll($conn);
$all_film = Movie::getALl($conn); // Lấy ra tất cả các phim

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $name_film = $_GET['movie_search'];
    if (isset($_GET['button-search'])) {
        header("Location: ./movielengthview.php?name_movie=" . $name_film . "&index-page=0");
    }
}
?>

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
                        <input class="fix1" list="topics" type="text" name="movie_search" id="movie_search" placeholder="Tìm kiếm....">
                        <datalist id="topics">
                                <?php for ($i = 0; $i < count($all_film); $i++) : ?>
                                    <? $name_film = $all_film[$i]->moviename ?>
                                    <option value="<?= $name_film ?>">
                                    <?php endfor; ?>
                            </datalist>
                        <button class="fix2 search_button" name="button-search" type="submit"><i class='bx bx-search'></i></button>
                    <?php else : ?>
                        <form action="">
                            <input type="text" list="topics" name="movie_search" id="movie_search" placeholder="Tìm kiếm....">
                            <datalist id="topics">
                                <?php for ($i = 0; $i < count($all_film); $i++) : ?>
                                    <? $name_film = $all_film[$i]->moviename ?>
                                    <option value="<?= $name_film ?>">
                                    <?php endfor; ?>
                            </datalist>
                            <button class="search_button" name="button-search" type="submit"><i class='bx bx-search'></i></button>
                        </form>
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