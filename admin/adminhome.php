<?php
require "../inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('../inc/db.php');
$name_film = "";
$name_film = $_GET['movie_search'];
$movies = Movie::searchByName($conn, $name_film);

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
            <div class="col-md-5 col-lg-3 order-3 order-md-2">
              <div class="xp-searchbar">
                <form>
                  <div class="input-group">
                    <input type="text" name="movie_search" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn" name="button-search" type="submit" id="button-addon2">GO</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- End XP Col -->

            <!-- Start XP Col -->
            <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
              <div class="xp-profilebar text-right">
                <nav class="navbar p-0">
                  <ul class="nav navbar-nav flex-row ml-auto">


                    <li class="nav-item dropdown">
                      <a class="nav-link" href="#" data-toggle="dropdown">
                        <img src="img/user.jpg" style="width:40px; border-radius:50%;" />
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
          <h4 class="page-title">Danh sách phim</h4>
        </div>
        <!--------main-content------------->

        <div class="main-content">
          <div class="row">

            <div class="col-md-12">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                      <h2 class="ml-lg-2">Manage Movie</h2>
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover">
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
                        <td id="admin_nameFilm"><? echo $m->moviename ?></td>
                        <td><? echo $m->director ?></td>
                        <td><? echo $m->actors ?></td>
                        <td><? echo $m->nation ?></td>
                        <td>
                          <img src=<?= "." . $m->imagefile ?> alt="Hình ảnh" alt="" width="100" height="100">
                        </td>
                        <td>
                          <div class="row">
                            <a href="editmovie.php?id=<?= htmlspecialchars($m->id_movie) ?>" class="btn">
                              <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <form action="" method="post">
                              <a href="./deletemovie.php?id=<?= htmlspecialchars($m->id_movie) ?>" name="btn_remove" type="submit" class="btn">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                              </a>
                            </form>

                          </div>
                        </td>
                      </tr>
                    <? endforeach; ?>
                  </tbody>
                </table>

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

