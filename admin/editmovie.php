<?php
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');

//Dùng để lấy người dùng ra
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $u = $_SESSION['user'];
} else {
    $u = null;
}

//Lấy ra id của phim
if (isset($_GET['id'])) {
    $id = $_GET['id']; // read id from index.php
    $result_film = Movie::getId($conn, $id);
}else{
    Dialog::show("Lỗi!!");
}

//Khi bấm vào nút lưu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // lấy thông tin chỉnh sửa
    $result_film->id_movie = $_GET['id'];
    $result_film->moviename = $_POST['moviename'];
    $result_film->director = $_POST['director'];
    $result_film->description = $_POST['description'];
    $result_film->actors = $_POST['actors'];
    $result_film->nation = $_POST['nation'];
    try {
        $fullname = Uploadfile::process();
        if(!empty($fullname)){
            // lay ten file cu ra
            $oldimage = $result_film->imagefile;
            // gan ten file moi
            $result_film->imagefile = "./uploads/".$fullname;
            if($result_film->update($conn)){
                if($oldimage === "./uploads/image.png"){
                    header("Location: adminhome.php");
                } else{
                    unlink(".$oldimage");
                }
                
            }
        } else{
            if($result_film->update($conn)){
                header("Location: adminhome.php?movie_search=");
            }
        }
        
    } catch ( PDOException $e) {
        Dialog::show($e->getMessage());
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="../css/custom.css">


    <!--google fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

</head>

<body>


    <div class="wrapper">
        <div class="body-overlay"></div>

        <!-------------------------sidebar------------>
        <!-- Sidebar  -->
        <?require "./adminheader.php";?>

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
                                        <th>ID</th>
                                        <th>Tên phim</th>
                                        <th>Đạo diễn</th>
                                        <th>Diễn viên</th>
                                        <th>Quốc gia</th>
                                        <th>Mô tả</th>
                                        <th>Ảnh</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" enctype="multipart/form-data" method="post">
                                        <td><?= $result_film->id_movie ?></td>
                                        <td><input name="moviename" class="edit_film" type="text" value="<?= $result_film->moviename ?>"></td>
                                        <td><input name="director" class="edit_film" type="text" value="<?= $result_film->director ?>"></td>
                                        <td><input name="actors" class="edit_film" type="text" value="<?= $result_film->actors ?>"></td>
                                        <td><input name="nation" class="edit_film" type="text" value="<?= $result_film->nation ?>"></td>
                                        <td><textarea style="height: 208px; width: 142px;"  type="text" name="description" class="edit_film"><?= $result_film->description?></textarea></td>
                                        <td><img src= <?php $result_film->checkImageAdmin()?>       
                                               <?= "." . $result_film->imagefile ?> alt="Hình ảnh" alt="" width="100" height="150">
                                            <input name="imagefile" class="bt-chosefile" type="file" style="border-radius: 4px;"></input>
                                        </td>
                                        <td>
                                            <div class="row">

                                                <button onclick="return save()" type="submit" name="btn_save" id="btn_save" class="btn" >
                                                <i class="material-icons" data-toggle="tooltip" title="S">&#xE254;</i> 
                                                 </button>
                                                <!--  -->
                                                <input type="hidden" name="bienjs2" id="bienjs2" value="helo" />
                                        </form>
                                    <button onclick="cancel()" type="button" name="btn_cancel" id="btn_cancel" class="btn">
                                        <i class="material-icons" data-toggle="tooltip" title="Cancel">&#11199;</i>
                                    </button>

                        </div>
                        </td>
                        </tbody>
                        </table>

                    </div>
                </div>
                <!---footer---->
            </div>
        </div>
    </div>


    <!----------html code compleate----------->




</body>



</html>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

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

<script>
    function save() {
        let isValid = confirm("Bạn có muốn lưu không(Y/N)??");
        document.getElementById('bienjs2').value = isValid;
        return isValid;
    }

    function cancel() {
        window.location = "./adminhome.php?movie_search=";
    }
</script>