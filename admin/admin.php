<?php
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');
$movies = Movie::getAll($conn);

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>

<body>
    <div id="header">
        <div class="logo">
            <a href="index.php" class="logo-link">
                <img src="../uploads/logo2.png" alt="GARENA">
                <!-- LOGO -->
            </a>
        </div>
        <div class="fix-admin navigation">

            <ul class="header_menu">
                <li><a href="./admin.php">Danh sách phim</a></li>
                <li><a href="">Thêm phim</a></li>
                <li><?php if (Auth::isLoggedIn()) : ?>
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
                </li>
            </ul>
        </div>
    </div>

    <div id="main">
        <div id="slibar"></div>
        <div id="content_admin_panel">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên phim</th>
                        <th>Đạo diễn</th>
                        <th>Diễn viên</th>
                        <th>Quốc gia</th>
                        <th>Ảnh</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <? static $i = 1; ?>
                    <? foreach ($movies as $m) : ?>
                        <tr>
                            <td align="center"><? echo $i++ ?></td>
                            <td><? echo $m->moviename ?></td>
                            <td><? echo $m->director ?></td>
                            <td><? echo $m->actors ?></td>
                            <td><? echo $m->nation ?></td>
                            <td>
                                <img src=<?= "." . $m->imagefile ?> alt="Hình ảnh" alt="" width="100" height="100">
                            </td>
                            <td>
                                <? if (Auth::isLoggedIn()) : ?>
                                    <div class="row">
                                        <a href="editmovie.php?id=<?= htmlspecialchars($m->id_movie) ?>" class="btn">Sửa</a>
                                        <a href="delmovie.php?id=<?= htmlspecialchars($m->id_movie) ?>" class="btn">Xóa</a>
                                        <a href="editimage.php?id=<?= htmlspecialchars($m->id_movie) ?>" class="btn">Sửa hình</a>
                                    </div>
                                <? endif; ?>
                            </td>
                        </tr>
                    <? endforeach; ?>a  
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Totals</th>
                        <th colspan="3"><?php echo count($movies) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
</body>

</html>