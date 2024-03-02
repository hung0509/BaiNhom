<?
        require "inc/init.php";
        $check = 'Hello';
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Lấy giá trị bienjs ra
            if(isset($_GET['submit'])){
                $username = $_GET['username'];
                $password = $_GET['password'];
                $firstname = $_GET['firstname'];
                $lastname = $_GET['lastname'];
                $email = $_GET['email'];
                $valueJS = $_GET['bienjs'];

                $conn = require "./inc/db.php";
                $newUser = new User($username, $password, $firstname, $lastname, $email, 2);
                $check = $newUser->addUser($conn) ;
                if($check && $valueJS){
                    header('location: ./index.php');
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleregister.css">
    <title>Sign up</title>
</head>

<body>
    <div class="login-page">
        <div class="container">
            <center>
                <h1 class="form-tittle"> CREATE ACCOUNT </h1>
            </center>
            <!-- onsubmit ="return false" -->
            <form name="create-account-form" id="create-account-form" action="" method="get">
                <div class="name">
                    <div class="firstname">
                        <label>First Name</label> <br>
                        <div class="input-row">
                            <input name="firstname" type="text" id="firstname" class="input" placeholder="Your first name:">
                            <small>Error Message</small>
                        </div>
                        <? //echo "<span class='error'> $firstNameError </span>"
                        ?>
                    </div>
                    <div class="lastname">
                        <label> Last Name</label> <br>
                        <div class="input-row">
                            <input name="lastname" type="text" id="lastname" class="input" placeholder="Your last name:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $lastNameError </span>"
                        ?>
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

                        <? //echo "<span class='error'> $emailError </span> "
                        ?>
                    </div>

                    <div class="form-control">
                        <label>Username</label>
                        <div class="input-row">
                            <input name="username" id="username" type="text" class="input" placeholder="Username:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $userNameError </span> "
                        ?>
                    </div>

                    <div class="form-control">
                        <label>Password</label>
                        <div class="input-row">
                            <input name="password" id="password" type="password" class="input" placeholder="Password:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $passwordError </span> "
                        ?>
                    </div>

                    <div class="form-control">
                        <label>Re-type Password</label>
                        <div class="input-row">
                            <input id="repassword" name="repassword" type="password" class="input" placeholder="Confirm password:">
                            <small>Error Message</small>
                        </div>

                        <? //echo "<span class='error'> $repasswordError </span> "
                        ?>
                    </div>
                </div>

                <div class="form-footer">
                    <input onclick="return check()" name="submit" type="submit" id="button-sign-up" value='Sign Up'>
                    <!-- <button name="button-sign-up" type="submit" id="button-sign-up">Sign Up</button> -->
                    <p class="login-support">Have already an account ?
                        <a href="login.php" style="font-weight: bold; color: aqua">Login here</a>
                    </p>
                </div>
                <!-- Lưu giá trị hàm kiểm tra !! -->
                <input type="hidden" name="bienjs" id="bienjs" value="helo" />
            </form>
        </div>
    </div>
</body>

</html>


<script>
    const btnRegister = document.getElementById("button-sign-up");
    const firstnameEle = document.getElementById('firstname');
    const lastnameEle = document.getElementById('lastname');
    const emailEle = document.getElementById('email');
    const usernameEle = document.getElementById('username');
    const passwordEle = document.getElementById('password');
    const repasswordEle = document.getElementById('repassword');
    const inputEles = document.querySelectorAll('.input-row');
    const valueJS = document.getElementById('bienjs');

    //Kho bấm vào sign up

    function setError(ele, mes) {
        let parentEle = ele.parentNode;
        console.log(parentEle);
        parentEle.classList.add('error');
        parentEle.querySelector('small').innerText = mes;
    }

    function setSucces(ele) {
        ele.parentNode.classList.add('success');
    }

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }


    function checkValid() {
        let firstnameValue = firstnameEle.value;
        let lastnameValue = lastnameEle.value;
        let emailValue = emailEle.value;
        let usernameValue = usernameEle.value;
        let passwordValue = passwordEle.value;
        let repasswordValue = repasswordEle.value;

        let isCheck = true;

        if (firstnameValue == '') {
            setError(firstnameEle, 'Firstname is empty');
            isCheck = false;
        } else {
            setSucces(firstnameEle);
        }

        if (lastnameValue == '') {
            setError(lastnameEle, 'Lastname is empty');
            isCheck = false;
        } else {
            setSucces(lastnameEle);
        }

        if (emailValue == '') {
            setError(emailEle, 'Email is empty');
            isCheck = false;
        } else if (!isEmail(emailValue)) {
            setError(emailEle, 'Email is invalid');
            isCheck = false;
        } else {
            setSucces(emailEle)
        }

        if (usernameValue == '') {
            setError(usernameEle, 'Username is empty');
            isCheck = false;
        } else {
            setSucces(usernameEle);
        }

        if (passwordValue == '') {
            setError(passwordEle, 'Password is emmpty');
            isCheck = false;
        } else if (passwordValue.length < 8) {
            setError(passwordEle, 'Has minimum 8 characters in length');
            isCheck = false;
        } else {
            setSucces(passwordEle);
        }

        if (repasswordValue == '') {
            setError(repasswordEle, 'Please confirm password!');
            isCheck = false;
        } else if (repasswordValue != passwordValue) {
            setError(repasswordEle, 'Passwords do not match');
            isCheck = false;
        } else {
            setSucces(repasswordEle);
        }

        return isCheck;
    }

    function check() {
        let isValid = checkValid();
        document.getElementById('bienjs').value = isValid;
        return isValid;
    }
</script>