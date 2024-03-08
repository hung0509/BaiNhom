<?php

include "./SendMail.php";

require "../inc/init.php";

$conn = require "../inc/db.php";

date_default_timezone_set('Asia/Ho_Chi_Minh');


// include "logger.php";

if (isset($_POST['submit']) && $_POST['email']) {

    $email = $_POST['email'];

    // $result = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");
    $sql = "select * from users where email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch();

    // var_dump($user);

    if (!empty($user)) {

        $token = md5($email);

        $expiry_time = mktime(date("H", time() + 3600), date("i"), date("s"), date("m"), date("d"), date("Y")); // 10p

        // $current_timestamp = strtotime(date("Y-m-d H:i:s"));
        // $currentTime = new DateTime(); // Get current date and time

        // $interval = new DateInterval('PT15M'); // 15 minutes

        // $currentTime->add($interval);

        // $newTimestamp = $currentTime->getTimestamp();

        // echo $expiry_time;
        // die($expiry_time);

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
        $content = "<a href=$link>Click here to reset password</a>";

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
        if ($sendMail !== '') {
            echo "send mail success";
        }
    } else {
        echo "Invalid Email Address. Go back";
    }
}
