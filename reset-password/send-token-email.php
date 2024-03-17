<?php
include "./SendMail.php";
require "../inc/init.php";
$conn = require "../inc/db.php";

date_default_timezone_set('Asia/Ho_Chi_Minh');

$message = '';

if (isset($_POST['submit']) && $_POST['email']) {


    $email = $_POST['email'];
    // validate email input

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email format';
    }

    if (empty($message)) {
        $message = 'Email is required';
    }
//     $email = mysqli_real_escape_string($conn, $_POST['email']);

    // $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");
    $sql = "select * from users where email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch();

    if (!empty($user)) {

        $token = md5($email);

        $expiry_time = mktime(date("H", time() + 3600), date("i"), date("s"), date("m"), date("d"), date("Y")); // 10p

        $expiry_date = date("Y-m-d H:i:s", $expiry_time);

        // $query = mysqli_query($conn, "UPDATE users set  reset_link_token='" . $token . "', expiry_date='" . $expiry_date . "' WHERE email='" . $email . "'");
        $sql1 = "update users
                    set reset_link_token=:reset_link_token, expiry_date=:expiry_date
                    where email=:email";
        $stmt1 = $conn->prepare($sql1);

        $stmt1->bindValue(':reset_link_token', $token, PDO::PARAM_STR); // field - value
        $stmt1->bindValue(':expiry_date', $expiry_date, PDO::PARAM_STR);
        $stmt1->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            $stmt1->execute();
            // echo "Update successful.";
        } catch (PDOException $e) {
            die("Error executing update query: " . $e->getMessage());
        }

        $link = "http://localhost/BaiNhom/reset-password/reset-password.php?email=" . $email . "&token=" . $token;
//        $content = "<a href=$link>Click here to reset password</a>";
        $content = "<p>Need to reset your password?</br>
                    Use your secret link!</br></br>
                    <h2><a href=$link>Click here to reset password</a></h2></br></br>
                    If you did not forget your password, you can ignore this email.</p>";
        //Email send code
        $to_email = $email; // Mail nguoi nhan
        $mail_subject = "Reset Password";
        $mail_content = $content;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= "From: no-reply@test.com" . "\r\n";

        // Send email
        $sendMail = sendMailResetPassword($to_email, $mail_subject, $mail_content, $headers);
        // if ($sendMail) {
        //     echo "Check your email and click on the link to reset the password.";
        // } else {
        //     echo "Something wrong to send an email. Please try again.";
        // }
        // ghi log trước khi return

        if($sendMail === false){
            $message = 'Something wrong to send an email. Please try again. <a href="./password-reset.php">Go back</a>';
        }

        $message = 'Check your email and follow the instructions to reset your password.
</br>Go back to <a href="../login.php">Login page</a>';
    } else {
        $message = 'Email not found. <a href="./password-reset.php">Go back</a>';
    }

}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/password_reset.css">
    <title>Forgot Password</title>
</head>

<body>
<div class="container relative">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 reset-form" style="background-color: #D2D1D1; border-radius:15px;margin-top: 50px">
            <!-- <br><br> -->
            <div class="logo-reset">
                <img src="../uploads/logo2.png" alt="Logo">
            </div>
            <div class="col-md-12 mb-10">
                <p class="font-bold text-center" style="color:#000">
                    <?php echo $message; ?>
                </p>
            </div>
        </div>
    </div>
</div>
</body>

</html>


