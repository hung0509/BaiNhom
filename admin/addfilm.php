<?php
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');
$name_film = "";

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['button-search'])) {
        header("Location: ./adminhome.php?movie_search=" . $name_film);
    }
}

// xu ly khi submit form add movie

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // lấy gia tri tu form THÔNG QUA "name" => NAME phải trùng với biến $_POST['name của trường ở form']
    $moviename = $_POST['moviename'];
    $director = $_POST['director'];
    $description = $_POST['description'];
    $actors = $_POST['actors'];
    $movielength = $_POST['movielength'];
    $nation = $_POST['nation'];

    //kiểm tra thông tin phim
    // Loai bo khoang trang o dau va cuoi
    $moviename = trim($moviename);
    $director = trim($director);
    $description = trim($description);
    $actors = trim($actors);
    $movielength = trim($movielength);
    $nation = trim($nation);

    $errors = [];
    if (strlen($moviename) > 100) {
        $errors[] = "movie name is too long";
    }

    if (strlen($description) > 500) {
        $errors[] = "description is too long";
    }

    if (strlen($actors) > 500) {
        $errors[] = "actors are too long";
    }

    if (strlen($nation) > 100) {
        $errors[] = "nation is too long";
    }

    if (strlen($director) > 100) {
        $errors[] = "director is too long";
    }

    if (strlen($moviename) == 0) {
        $errors[] = "movie name is empty";
    }

    if (strlen($director) == 0) {
        $errors[] = "director is empty";
    }

    if ($moviename === '') {
        $errors[] = "movie name is empty";
    }
    if ($director === '') {
        $errors[] = "director is empty";
    }
    if ($actors === '') {
        $errors[] = "actors are empty";
    }
    if ($movielength === '') {
        $errors[] = "movie length is empty";
    }
    if ($nation === '') {
        $errors[] = "nation is empty";
    }
    if ($description === '') {
        $errors[] = "description is empty";
    }

    if (!$errors) {
        try {
//            $imageName = Uploadfile::process();

//            if($imageName == null){
//                $imageName = "image.png";
//            }

            $imageName = Uploadfile::process() ?? "image.png";  // ?? is null coalescing operator

            $imagefile = "./uploads/" . $imageName;
            // khoi tao 1 doi tuong movie - Đúng thứ tự

            $movie = Movie::getInstance($moviename, $nation, $description, $actors,
                $director, $imagefile, $movielength);
            if ($movie->addMovie($conn)) {
                header("Location: ./adminhome.php?movie_search=");
            } else {
                unlink("../uploads/$imageName");
                Dialog::show(implode(",", $errors));
            }

        } catch (PDOException $e) {
            Dialog::show($e->getMessage());
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>crud dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/styleaddfilm.css">
    <style>
        #sidebar ul li.active2 > a {
            color: #4c7cf3;
            background-color: #DBE5FD;
        }

        #sidebar ul li.active2 > a i {
            color: #4c7cf3;
        }
    </style>
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
                <h4 class="page-title">Thêm phim</h4>
            </div>
            <!--------main-content------------->

            <div class="main-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrapper">
                            <div class="col-md-12">
                                <style>
                                    .ul-errors{
                                        list-style: disc;
                                        background-color: rgba(250, 220, 220, 0.3);
                                        color: white;
                                        margin-top: 5px;
                                        padding: 10px;
                                        border-radius: 5px;
                                        border:1px solid rgba(241, 74, 74, 0.4);
                                        box-shadow: 1px 2px 2px rgba(204, 204, 204, 0.7);
                                    }
                                    .error-item{
                                        color: red;
                                        font-size: 12px;
                                        margin: 0 10px;
                                        /*margin-left: 92px;*/
                                    }
                                </style>
                                <?php
                                if(!empty($errors)){
                                    echo '<div class="errors-message">';
                                    echo '<ul class="ul-errors">';
                                    foreach($errors as $error){
                                        echo '<li class="error-item">'.$error.'</li>';
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                }
                                ?>
                                <!--
                    - Tạo 1 form với phương thức POST, nếu mà upload hình ành => enctype="multipart/form-data"
                -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="row">
                                            <label for="moviename">Tên phim:</label>
                                            <span class="error">*</span>
                                            <input name="moviename" type="text" placeholder="Nhập tên phim">
                                        </div>
                                        <div class="row">
                                            <label for="description">Mô tả:</label>
                                            <span class="error">*</span>
                                            <input name="description" type="text" placeholder="Nhập mô tả">
                                        </div>
                                        <div class="row">
                                            <label for="actors">Diễn viên:</label>
                                            <span class="error">*</span>
                                            <input name="actors" type="text" placeholder="Nhập tên các diễn viên">
                                        </div>
                                        <div class="row">
                                            <label for="imagefile">Poster:</label>
                                            <input name="imagefile" type="file">
                                        </div>
                                        <div class="row">
                                            <label for="director">Đạo diễn:</label>
                                            <span class="error">*</span>
                                            <input name="director" type="text" placeholder="Nhập tên đạo diễn">
                                        </div>
                                        <div class="row">
                                            <label for="nation">Quốc gia:</label>
                                            <span class="error">*</span>
                                            <input name="nation" type="text" placeholder="Nhập quốc gia">
                                        </div>
                                        <div class="row">
                                            <label for="movielength">Thời lượng phim:</label>
                                            <select name="movielength">
                                                <option value="Phim bộ">Phim bộ</option>
                                                <option value="Phim lẻ">Phim lẻ</option>
                                            </select>
                                        </div>
                                        <div class="btn">
                                            <input type="submit" value="Thêm phim">
                                            <a href="./adminhome.php">
                                                <input type="reset" value="Hủy">
                                            </a>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!---footer---->


            </div>
        </div>
    </div>


    <!----------html code compleate----------->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $(".xp-menubar").on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $(".xp-menubar,.body-overlay").on('click', function () {
                $('#sidebar,.body-overlay').toggleClass('show-nav');
            });

        });
    </script>


</body>

</html>