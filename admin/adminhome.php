<?
require "../inc/init.php";

$conn = require "../inc/db.php";
//$result_film = Movie::getAll($conn);// Lấy ra toàn bộ dòng
$result_film_series = Movie::getPagingByLength($conn, 12, 0, "Phim bộ");
$result_film_short = Movie::getPagingByLength($conn, 12, 0, "Phim lẻ");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Admin</title>
</head>
<body>
    

    
</body>
</html>