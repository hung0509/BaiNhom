<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/password_reset.css">
    <title>Reset Password Form</title>
</head>

<body>
<?php
?>
<div class="container relative">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 reset-form" style="background-color: #D2D1D1; border-radius:15px;">
            <!-- <br><br> -->
            <div class="logo-reset">
                <img src="../uploads/logo2.png" alt="Logo">
            </div>
            <div class="col-md-12 mb-10">
                <p class="font-bold text-center" style="color:#000">Reset New Password Here</p>
            </div>
        <?php
        if ($_GET['email'] && $_GET['token']) {
            require "../inc/init.php";

            $conn = require "../inc/db.php";


            $email = $_GET['email'];
            $token = $_GET['token'];

            // $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `email`='" . $email . "';");
            $sql = "select * from users where reset_link_token=:reset_link_token and email=:email";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':reset_link_token', $token, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch();


            // var_dump($user['expiry_date']);

            $current_date = date("Y-m-d H:i:s");

            if (!empty($user) && $user['expiry_date'] >= $current_date) {
                ?>
<!--                    <div>-->
<!--                        <ul>-->
<!--                            <li>Password must be at least 6 characters.</li>-->
<!--                            <li>Password must include at least one number.</li>-->
<!--                            <li>Password must include at least one letter.</li>-->
<!--                            <li>Password must include at least one uppercase letter.</li>-->
<!--                        </ul>-->
<!--                    </div>-->
                <form id="form-reset-password" action="./update-password.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="reset_link_token" value="<?php echo $token; ?>">
                    <div class="form-group mb-10">
                        <label for="new-password" class="form-label">New Password:</label>
                        <input class="form-control" type="password" name="new-password" id="new-password">
                        <span class="error-text-new-password"></span>
                    </div>
                    <div class="form-group mb-10">
                        <label class="formLabel" for="confirm-password">Confirm Password:</label>
                        <input class="form-control" type="password" name="confirm_password" id="confirm-password">
                        <span class="error-text-confirm-password"></span>
                    </div>
                    <div class="buttonWrapper">
                        <button type="submit" id="submitButton"
                                class="btn btn-primary pull-right submitButton pure-button pure-button-primary ">
                            <span>Submit</span>
                        </button>
                    </div>

                </form>
                <?php
            } else {
                echo "<p>This forget password link has been expired</p>";
            }
        }
        ?>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    jQuery(document).ready(function ($) {
        $("#new-password").blur(function () {
            const password = $("#new-password").val();
            const confirmPassword = $("#confirm-password").val();
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

            if (password !== confirmPassword) {
                $("#confirm-password").addClass("border-red");
                $(".error-text-confirm-password").text("Passwords do not match");
            } else {
                $("#confirm-password").removeClass("border-red");
                $(".error-text-confirm-password").text("");
            }

            if (!password.match(number) || !password.match(alphabets) || !password.match(special_characters)) {
                $("#new-password").addClass("border-red");
                // $("#confirm-password").addClass("border-red");
                $(".error-text-new-password").text("Password must include at least one number, one letter and one special character");
                // $(".error-text-confirm-password").text("Password must include at least one number, one letter and one special character");
            } else {
                $("#new-password").removeClass("border-red");
                $(".error-text-new-password").text("");
            }

            if (password.length < 6) {
                $("#new-password").addClass("border-red");
                // $("#confirm-password").addClass("border-red");
                $(".error-text-new-password").text("Password must be at least 6 characters");
                // $(".error-text-confirm-password").text("Password must be at least 6 characters");
            } else {
                $("#password").removeClass("border-red");
                $(".error-text-new-password").text("");
            }
            // if(password.length >= 6 && confirmPassword >= 6){
            //     $("#new-password").removeClass("border-red");
            //     $("#confirm-password").removeClass("border-red");
            //     $(".error-text-new-password").text("");
            //     $(".error-text-confirm-password").text("");
            // }

            // $("#reset-password-form").submit(function (event) {
            //     // event.preventDefault();
            //     const data = $(this).serialize();
            //     // console.log(data);
            //     $.ajax({
            //         type: "POST",
            //         url: "./update-password.php",
            //         data: data,
            //         success: function (response) {
            //             alert(response);
            //         }
            //     });
            // })
        });
    });
</script>
</body>

</html>