<?
require "./inc/init.php";
//Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
Auth::requireLogin();
$conn = require('./inc/db.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ds = $_POST['listG'];
       
            // Movie::belongGenre($conn, 74, $item);
            $film = Movie::searchByName($conn, "Cô Đi Mà Lấy Chồng Tôi");
            echo $film[0];
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
    <div class="row">
        <form action="" method="post">
            <div>
            <label>Thể loại phim:</label>
            <div><input type="checkbox" name="listG[]" value="1" />1</div>
            <div><input type="checkbox" name="listG[]" value="2" />2</div>
            <div><input type="checkbox" name="listG[]" value="3" />3</div>
            <div><input type="checkbox" name="listG[]" value="4" />4</div>
            <div><input type="checkbox" name="listG[]" value="5" />5</div>
            <input type="submit" value="Gửi">
            </div> 
        </form>

    </div>
</body>

</html>