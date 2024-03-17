<?
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');


if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}


if ($u->id_role != 1) {
    header("Location: index.php");
} else {

    //Lấy ra id của phim
    if (isset($_GET['id'])) {
        $id = $_GET['id']; // read id from index.php
        $result_film = Movie::getId($conn, $id);
    } else {
        Dialog::show("Lỗi!!");
    }
}
//Khi bấm vào nút Có xóa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_film = $_GET['id'];
    $oldimage = $result_film->imagefile;
    // $name = $result_film->name_movie;
    if ($result_film->deleteById($conn)) {
        if($oldimage && $oldimage != "./uploads/image.png"){
//            unlink("./uploads/" . $oldimage);
            unlink($oldimage);
        }
        header("Location: ./adminhome.php?movie_search=");
        Dialog::show("Xoá thành công!");
        return;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>

        <!-------------------------sidebar------------>
        <!-- Sidebar  -->
        <? require "./adminheader.php"; ?>

        <!--------page-content---------------->

        <div id="content">

            <!--top--navbar----design--------->

            <div class="top-navbar">
                <div class="xp-topbar">

                    <!-- Start XP Row -->
                    <div class="row">
                        <!-- Start XP Col -->
                        <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <span class="material-icons text-white">signal_cellular_alt
                                </span>
                            </div>
                        </div>
                        <!-- End XP Col -->

                        <!-- Start XP Col -->

                        <!-- End XP Col -->

                        <!-- Start XP Col -->
                        <div class="fixsignin col-10 col-md-6 col-lg-8 order-1 order-md-3">
                            <div class="xp-profilebar text-right">
                                <nav class="navbar p-0">
                                    <ul class="nav navbar-nav flex-row ml-auto">


                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" data-toggle="dropdown">
                                                <img src="../uploads/img/user.png" style="width:40px; border-radius:50%;" />
                                                <span class="xp-user-live"></span>
                                            </a>
                                            <ul class="dropdown-menu small-menu">

                                                <li>
                                                    <a href="../logout.php"><span class="material-icons">
                                                            logout</span>Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>

                            </div>
                        </div>
                        <!-- End XP Col -->
                    </div>
                    <!-- End XP Row -->
                </div>
                <div class="xp-breadcrumbbar text-center">
                    <h4 class="page-title"><?= $result_film->moviename ?></h4>
                </div>
                <!--------main-content------------->

                <div class="main-content">
                    <div class="row">
                        <div class="table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên phim</th>
                                        <th>Đạo diễn</th>
                                        <th>Diễn viên</th>
                                        <th>Quốc gia</th>
                                        <th>Mô tả</th>
                                        <th>Ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="post">
                                        <td>1</td>
                                        <td><input name="moviename" class="edit_film" type="text" value="<?= $result_film->moviename ?>"></td>
                                        <td><input name="director" class="edit_film" type="text" value="<?= $result_film->director ?>"></td>
                                        <td><input name="actors" class="edit_film" type="text" value="<?= $result_film->actors ?>"></td>
                                        <td><input name="nation" class="edit_film" type="text" value="<?= $result_film->nation ?>"></td>
                                        <td><textarea type="text" name="description" class="edit_film"><?= $result_film->description ?></textarea></td>
                                        <td>
                                            <div>
                                                <?php $result_film->checkImageAdmin()?>       
                                                <img src=<?= "." . $result_film->imagefile ?> alt="Hình ảnh" alt="" width="100" height="100">
                                            </div>
                                        </td>
                                </tbody>

                            </table>
                            <div class="xp-breadcrumbbar text-center">
                                <h4 class="page-title">Bạn có xác nhận muốn xóa hay không?</h4>
                                <form action="" method="post">
                                    <button class="btn_delete" type="submit">Có</button>
                                </form>
                                <button class="btn_delete" type="button"><a href="./adminhome.php?movie_search=">Không</a></button>
                            </div>
                        </div>
                    </div>
                    <!---footer---->
                </div>
            </div>
        </div>
</body>

</html>

<script src="../js/jquery-3.3.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $(".xp-menubar").on('click', function() {
            $('#sidebar').toggleClass('active');
            $('#content').toggleClass('active');
        });

        $(".xp-menubar,.body-overlay").on('click', function() {
            $('#sidebar,.body-overlay').toggleClass('show-nav');
        });
    });
</script>