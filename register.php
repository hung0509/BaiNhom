<?
// $firstNameError = '';
// $lastNameError = '';
// $emailError = '';
// $userNameError ='';
// $passwordError = '';
// $repasswordError = '';

// if(isset($_POST['submit'])){
//     //firstname
//     if(empty($_POST['firstname'])){
//         $firstNameError = "First name is required";
//     }else{
//         $name = $_POST['firstname'];
//         if(!preg_match("/^[A-Za-z]*$/", $name)){
//             $firstNameError = 'Only characters and spaces are allowed';
//         }
//     }

//     //lastname
//     if(empty($_POST['lastname'])){
//         $lastNameError = "Last name is required";
//     }else{
//         $name = $_POST['lastname'];
//         if(!preg_match("/^[A-Za-z]*$/", $name)){
//             $lastNameError = 'Only characters and spaces are allowed';
//         }
//     }

//     //email
//     if(empty($_POST['email'])){
//         $emailError = "Email is required";
//     }else{
//         $email = $_POST['email'];
//         if(!preg_match("/^\\S+@\\S+\\.\\S+$/", $email)){
//             $emailError = 'Email is invalid';
//         }
//     }
//     //username
//     if(empty($_POST['username'])){
//         $userNameError = "Username is required";
//     }
//     //password
//     if(empty($_POST['password'])){
//         $passwordError = "Pasword is required";
//     }else{
//         $pass = $_POST['password'];
//         if(!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $pass)){
//             $passwordError = 'Password is invalid';
//         }
//     }

//     //repass
//     if(empty($_POST['repassword'])){
//         $repasswordError = "Confirm pasword is required";
//     }else{
//         $pass = $_POST['repassword'];
//         if(!preg_match("/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/", $pass)){
//             $repasswordError = 'Password is invalid';
//         }
//     }
// }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Sign up</title>
</head>

<body>
    <div class="login-page">
        <div class="container">
            <center><h1 class="form-tittle"> CREATE ACCOUNT </h1></center>
            <form name="create-account-form" id="create-account-form" method="post">
                <div class="name">
                    <div class="firstname">
                        <label>First Name</label> <br>
                        <div class="input-row">
                            <input name="firstname" type="text" id="firstname" class="input" placeholder="Your first name:">
                            <small>Error Message</small>
                        </div>
                        <? //echo "<span class='error'> $firstNameError </span>"?>
                    </div>
                    <div class="lastname">
                        <label> Last Name</label> <br>
                        <div class="input-row">
                            <input name="lastname" type="text" id="lastname" class="input" placeholder="Your last name:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $lastNameError </span>"?>
                    </div>
                </div>

                <br>
                <div>
                    <div class="form-control">
                        <label>Email</label>
                        <div class="input-row">
                            <input name="email" id="email" type="text" class="input" placeholder="text@gmail.com">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $emailError </span> "?>
                    </div>

                    <div class="form-control">
                        <label>Username</label>
                        <div class="input-row">
                            <input name="username" id="username" type="text" class="input" placeholder="Username:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $userNameError </span> "?>
                    </div>

                    <div class="form-control">
                        <label>Password</label>
                        <div class="input-row">
                            <input name="password" id="password" type="password" class="input" placeholder="Password:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $passwordError </span> "?>
                    </div>

                    <div class="form-control">
                        <label>Re-type Password</label>
                        <div class="input-row">
                            <input id="repassword" name="repassword" type="password" class="input" placeholder="Confirm password:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $repasswordError </span> "?>
                    </div>
                </div>

                <div class="form-footer">
                    <!-- <input name="submit" type="submit" class="button-sign-up" value='Sign Up'> -->
                    <button name="button-sign-up" type="button" id="button-sign-up">Sign Up</button>
                    <p class="login-support">Have already an account ?
                        <a href="login.php" style="font-weight: bold; color: aqua">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="./js/Validation_register.js"></script>

</html>