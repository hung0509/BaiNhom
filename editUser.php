<?
    require "./inc/init.php";
    //Bắt buộc phải là tài khoản admin thì mới vào được page admin panel giùm tui nha :)))
    Auth::requireLogin();
    $conn = require('./inc/db.php');
   
    
    if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
      $u = $_SESSION['user'];
      $password_old = $u->password;
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $firtname_new = $_POST['firstname'];
        $lastname_new = $_POST['lastname'];
        $password_new = $_POST['password'];
        $repassword_new = $_POST['repassword'];
       
        if($password_new != ""){
            if(($password_new == $repassword_new)){
                $u->firstname = $firtname_new;
                $u->lastname = $lastname_new;
                $u->password = $password_new;

                $hash = password_hash($password_new, PASSWORD_DEFAULT);
                if($u->editUser($conn, $hash)){
                    header('location: editUser.php');
                }else{
                    Dialog::show("Cập nhật thông tin không thành công");
                }
            }else{
                Dialog::show("Mật khẩu mới không trùng nhau");
            }
        }else{
            $u->firstname = $firtname_new;
            $u->lastname = $lastname_new;
            
            if($u->editUser($conn, $u->password)){
                header('location: editUser.php');
            }else{
                Dialog::show("Cập nhật thông tin không thành công");
            }
        }
      }
    } else{
        header('location: index.php');
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Document</title>
</head>
<body>
<div class="login-page">
        <div class="container">
            <center>
                <h1 class="form-tittle"> CREATE ACCOUNT </h1>
            </center>
            <form name="create-account-form" id="create-account-form" action="" method="post">
                <div class="name">
                    <div class="firstname">
                        <label>First Name</label> <br>
                        <div class="input-row">
                            <input name="firstname" type="text" id="firstname" class="input" value="<?=$u->firstname?>">  
                        </div>
                    </div>
                    <div class="lastname">
                        <label> Last Name</label> <br>
                        <div class="input-row">
                            <input name="lastname" type="text" id="lastname" class="input" value="<?=$u->lastname?>">
                            
                        </div>
                    </div>
                </div>

                <br>
                <div>

                <div class="form-control">
                        <label>Email</label>
                        <div class="input-row">
                            <input name="email" id="email" type="text" class="input" value="<?=$u->email?>" readonly>
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Username</label>
                        <div class="input-row">
                            <input name="username" id="username" type="text" class="input" value="<?=$u->username?>" readonly>
                            <small>Error Message</small>
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Password</label>
                        <div class="input-row">
                            <input name="password" id="password" type="password" class="input">   
                        </div>
                    </div>

                   

                    <div class="form-control">
                        <label>Re-type Password</label>
                        <div class="input-row">
                            <input id="repassword" name="repassword" type="password" class="input" >  
                        </div>

                    </div>
                </div>

                <div class="form-footer">
                    <input name="submit" type="submit" id="button-sign-up" value='Submit'>

                        <a href="index.php" style="font-weight: bold; color: aqua">Back to home page</a>
                
</div>
            </form>
        </div>
    </div>
</body>
</html>