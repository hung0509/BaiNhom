<?

    require "./inc/init.php";

    $conn = require "./inc/db.php";
    if(!isset($_GET['id_movie']) && $_GET['id_movie'] == false){
        echo "Lỗi!";
    }else{
        $id = $_GET['id_movie'];
        $f = new Movie();
        $result_film = $f->getId($conn, $id);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/styledetail.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <div id="main_detail">
        <? require  "./inc/header.php"?>

        <!-- Content -->
        <div id="content_detail">
            <img src= <?= $result_film->imagefile?> alt="Hình ảnh">
            <div class="info">
                <h2 class="name_film_detail"><?= $result_film->moviename?></h2>
                <div class="director">Đạo diễn: <?= $result_film->director?></div>
                <div class="professor">Diễn viên: <?= $result_film->actors?></div>
                <div class="category">Thể loại:  <?=$result_film->getMovieGenres($conn)?></div>
                <div class="nation">Quốc gia: <?= $result_film->nation?></div>
                <a class="trailer" href="">Trailer</a>    
           </div>
           <div class="description_container">
            <h3 class="description_namefilm">Tóm tắt nội dung</h3>
                <p class="description"><?= $result_film->description?></p>
           </div>            
        </div>
    </div>
</body>
</html>