<?php
if (isset($_POST['confirm_password']) && $_POST['reset_link_token'] && $_POST['email'] && $_POST['confirm_password']) {
    
    require "../inc/init.php";

    $conn = require "../inc/db.php";

    $password = $_POST['confirm_password'];
    $confirm_password = $_POST['confirm_password'];

    $token = $_POST['reset_link_token'];
    $email = $_POST['email'];


    // validate input


    // $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `email`='" . $email . "'");
    // $row = mysqli_num_rows($query);

    $sql = "select * from users where reset_link_token=:reset_link_token and email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':reset_link_token', $token, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {

        // validate password
//        $password = password_hash($password, PASSWORD_DEFAULT);

        // cat khoang trang  o dau va cuoi
        $password = trim($password);
        $confirm_password = trim($confirm_password);

        $errors = [];

        if ($password !== $confirm_password) {
//            $errors[] = "Passwords do not match. Please try again.";
            echo "<p>Passwords do not match. Please try again.</p>";
            return;
        }

        if(strlen($password) < 6) {
            echo "<p>Password must be at least 6 characters. Please try again.</p>";
            return;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            echo "<p>Password must include at least one number. Please try again.</p>";
            return;
        }

        if (!preg_match("#[a-z]+#", $password)) {
            echo "<p>Password must include at least one letter. Please try again.</p>";
            return;
        }

        if (!preg_match("#[A-Z]+#", $password)) {
            echo "<p>Password must include at least one uppercase letter. Please try again.</p>";
            return;
        }

        if (!preg_match("#\W+#", $password)) {
            echo "<p>Password must include at least one special character. Please try again.</p>";
            return;
        }

        $password = md5($password);

        // mysqli_query($conn, "UPDATE users set  password='" . $password . "', reset_link_token='" . '' . "', expiry_date='" . NULL . "' WHERE email='" . $email . "'");
        // echo '<p>Your password has been updated successfully.</p>';
        $sql1= "update users
                    set password=:password, reset_link_token=:reset_link_token,
                    expiry_date=:expiry_date
                    where email=:email";
        $stmt1 = $conn->prepare($sql1);

        $stmt1->bindValue(':password', $password, PDO::PARAM_STR); // field - value
        $stmt1->bindValue(':reset_link_token', '', PDO::PARAM_STR);
        $stmt1->bindValue(':expiry_date', NULL, PDO::PARAM_NULL);
        $stmt1->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            $stmt1->execute();
            return "Update password successful. Please <a href='../login.php'>Log in</a> to continue.";
        } catch (PDOException $e) {
            die("Error executing update query: " . $e->getMessage());
        }

    } else {
        return  "Something wrong. Please try again" ;
    }
}
