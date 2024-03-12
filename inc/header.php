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
    if (isset($_GET['button-search'])) {
        $name_film = $_GET['search'];
        header("Location: ./movielengthview.php?name_movie=" . $name_film . "&index-page=0");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <header id="header">
        <div class="header-logo">
            <div class="logo">
                <h1>MyProject</h1>
            </div>
        </div>
        <div class="header-menu">
        <ul class="menu">
            
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
                        </ul>
                    </div>
                </li>
                <li><a href="./index.php#space1">Phim bộ</a></li>
                <li><a href="./index.php#space12">Phim lẻ</a></li>
            </ul>
        </div>
        <div class="header-search">
            <div class="box-search">
            <form action="">
                <input type="text" list="topics" name="search" id="search" placeholder="Tìm kiếm....">
                <datalist id="topics">
                                <?php for ($i = 0; $i < count($all_film); $i++) : ?>
                                    <? $name_film = $all_film[$i]->moviename ?>
                                    <option value="<?= $name_film ?>">
                                    <?php endfor; ?>
                            </datalist>
                <button class="search_button" name="button-search" type="submit"><i class='bx bx-search'></i></button>
            </div>
            </form>
        </div>
        <div class="header-login">
            <?php if (Auth::isLoggedIn()) : ?>
                <div class="logout_user" style="height: 100%;">
                <!-- đường dẫn thông tin ?-->
                            
                    <a href="" ><i class='bx bx-user'></i><?= $u->getName() ?></a>
                        <div class="box-login logout">
                            <a id="logout" href="./logout.php">Đăng xuất</a>
                        </div>
                </div>

                <?php else : ?>
                    <div class="box-login">
                        <a href="./login.php">Đăng nhập</a>/<a href="./register.php">Đăng ký</a>
                    </div>
                    <?php endif; ?>
            
        </div>

     
    </header>
    
   



</body>
