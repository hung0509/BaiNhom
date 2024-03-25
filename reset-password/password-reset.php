<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/password_reset.css">
    <title>Password Reset</title>
</head>

<body>
<div class="container relative">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 reset-form" style="background-color: #D2D1D1; border-radius:15px;">
            <!-- <br><br> -->
            <div class="logo-reset">
                <img src="../uploads/logo2.png" alt="Logo">
            </div>
            <div class="col-md-12 mb-10">
                <p class="font-bold text-center" style="color:#000">Please enter your email to recover your password</p>
            </div>
            <form id="form-reset-password" method="POST" action="./send-token-email.php">
                <div class="form-group mb-10">
                    <label for="email-reset" class="form-label">Enter your mail:</label>
                    <input class="form-control" type="email" id="email-reset" name="email" minlength="10" maxlength="50"
                           value="<?php echo $_POST['email'] ?? ''; ?>" placeholder="text@gmail.com">
                    <span class="error-text"></span>
                </div>

                <button type="submit" class="btn btn-primary pull-right" name="submit"
                        style="display: block; width: 100%;">Send Email
                </button>
                <br><br>
                <a href="../login.php" style="display: flex; justify-content: center">Back to login page</a>
                <br>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('#email').focus();

         // lay du lieu tu id=email
        // var bla = $('#txt_name').val()
        $("#form-reset-password").submit(function (event) {

            // event.preventDefault();

            const email = $("#email-reset").val()

            if (email === "") {
                // alert("Please enter your email");
                $("#email").addClass("border-red");
                $(".error-text").text("Please enter your email");
                return false;
            }

            if (email !== "") {
                $("#email").removeClass("border-red");
                $(".error-text").text("");
            }
            // location.href = "./send-token-email.php?email=" + email
            // return true
        });
    });
</script>
</body>

</html>