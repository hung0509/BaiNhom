<?php
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');
// $name_film = "";
// $name_film = $_GET['movie_search'];
// $movies = Movie::searchByName($conn, $name_film);

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
    // $book = Movie::getInstance($title, $description, $author, $fullname);

    // lấy gia tri tu form THÔNG QUA "name" => NAME phải trùng với biến $_POST['name của trường ở form']
    $moviename = $_POST['moviename'];
    $director = $_POST['director'];
    $description = $_POST['description'];
    $actors = $_POST['actors'];
    $movielength = $_POST['movielength'];
    $imagefile = $_POST['imagefile'];
    $nation = $_POST['nation'];

    // validate

    // echo $moviename . PHP_EOL;
    // echo $director. PHP_EOL;
    // echo $description. PHP_EOL;
    // echo $actors. PHP_EOL;
    // echo $movielength. PHP_EOL;
    // echo $nation. PHP_EOL;

    // Loai bo khoang trang o dau va cuoi
     $moviename = trim($moviename);
     $director = trim($director);
     $description = trim($description);
     $actors = trim($actors);
     $movielength = trim($movielength);
     $nation = trim($nation);

     // validate

    if(strlen($moviename) > 100){
        $errors[] = "movie name is too long";
    }

    if(strlen($description) > 500){
        $errors[] = "description is too long";
    }

    if(strlen($actors) > 500){
        $errors[] = "actors are too long";
    }

    if(strlen($movielength) > 10){
        $errors[] = "movie length is too long";
    }

    if(strlen($nation) > 100){
        $errors[] = "nation is too long";
    }

    if(strlen($director) > 100){
        $errors[] = "director is too long";
    }

    if(strlen($imagefile) > 100){
        $errors[] = "imagefile is too long";
    }

    if(strlen($moviename) == 0){
        $errors[] = "movie name is empty";
    }

    if(strlen($director) == 0){
        $errors[] = "director is empty";
    }

    // var_dump($errors);

    $errors = [];

    if($moviename === ''){
       $errors[] = "movie name is empty";
    }

    if($director === ''){
        $errors[] = "director is empty";
    }

    // var_dump($errors);

    // if(!empty($errors)){
    //     foreach($errors as $error){
    //         echo "<p>".$error."</p>";
    //     }
    //     // exit();
    // }

    // echo $moviename . PHP_EOL;     
    // echo $director. PHP_EOL;
    // echo $description. PHP_EOL;
    // echo $actors. PHP_EOL;
    // echo $movielength. PHP_EOL;
    // echo $nation. PHP_EOL;


    // khoi tao 1 doi tuong movie - Đúng thứ tự
    $movie = Movie::getInstance($moviename, $nation, $description, $actors, $director, $imagefile, $movielength);

    // var_dump($movie);
    $result = $movie->addMovie($conn); // true or false

    // goij caapj nhaapj
    if ($result) {
        header("Location: ./adminhome.php?movie_search=");
    } else {
        // var_dump($errors);
       Dialog::show(implode(",", $errors));     
        //  alert(JSON.stringify($result));

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

                        <!-- End XP Col -->
                    </div>
                    <!-- End XP Row -->
                </div>
                <div class="xp-breadcrumbbar text-center">
                    <h4 class="page-title">Them phim</h4>
                </div>
                <!--------main-content------------->

                <div class="main-content">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                                            <h2 class="ml-lg-2">Add Movie</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!--
                        - Tạo 1 form với phương thức POST, nếu mà upload hình ành => enctype="multipart/form-data"
                    -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="moviename" placeholder="moviename">
                                        <input type="text" name="description" placeholder="description">
                                        <input type="text" name="actors" placeholder="actors">
                                        <input type="file" name="imagefile" placeholder="imagefile">
                                        <input type="text" name="director" placeholder="director">
                                        <input type="text" name="nation" placeholder="nation">
                                        <input type="text" name="movielength" placeholder="movielength">

                                        <input type="submit" value="Add">
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


</body>

</html>