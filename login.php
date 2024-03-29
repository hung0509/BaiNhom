<?
require "inc/init.php";
$usernameError = '';
$passwordError = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = true;
    if (isset($_POST['submit'])) {
        if (empty($_POST['username'])) {
            $usernameError = "Username is empty";
            $check = false;
        }

        if (empty($_POST['password'])) {
            $passwordError = "Password is empty";
            $check = false;
        }
        $conn = require "./inc/db.php";
        if ($conn && $check) {
//            die($password);
            $u = User::authenticate($conn, $username, $password);
            if($u){
                // Tạo session logged_in
                Auth::login();
                //Tạo session user
                $_SESSION['user'] = $u;
                Dialog::show("Đăng nhập thành công!!!");//
                if($u->id_role == 1){
                    header("Location: ./admin/adminhome.php?movie_search=");
                }
                else{
                    header("Location: ./index.php");
                }
            }else{
                Dialog::show("Invalid username or password");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/stylelogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>

<body>
    <div id="main">
        <div class="logo">My Project</div>
        <form name="frmLOGIN" action="" method="post">
            <div class="container">
                <div class="title_login"><i class='bx bxs-user'></i> LOGIN</div>
                <div class="box">
                    <label for="username">Username:</label>
                    <input name="username" id="username" type="text" placeholder="Enter your usename" />
                    <? echo "<span class='error'> $usernameError </span> " ?>
                </div>
                <div class="box">
                    <label for="password" class="distance">Password:</label>
                    <input name="password" id="pasword" type="password" placeholder="Enter your passowrd" />
                    <? echo "<span class='error'> $passwordError </span> " ?>
                </div>
                <div class="remember-me password-forgot ">
                    <div class="forgot-password"><a href="./reset-password/password-reset.php">Forgot password?</a></div>
                </div>
                <div class="signin">
                    <input name="submit" id="login" type="submit" value="Sign In">
                </div>
                <div class="register">
                    <p>Not a user?<a href="./register.php">Sign up</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>