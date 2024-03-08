<?php
if (isset($_POST['confirm_password']) && $_POST['reset_link_token'] && $_POST['email']) {
    
    require "../inc/init.php";

    $conn = require "../inc/db.php";

    $password = md5($_POST['confirm_password']);
    $token = $_POST['reset_link_token'];
    $email = $_POST['email'];

    // $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `email`='" . $email . "'");
    // $row = mysqli_num_rows($query);

    $sql = "select * from users where reset_link_token=:reset_link_token and email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':reset_link_token', $token, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
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
            echo "Update password successful.";
        } catch (PDOException $e) {
            die("Error executing update query: " . $e->getMessage());
        }

    } else {
        echo "<p>Something wrong. Please try again.</p>" . $password . $token . $email. $user['name'];
    }
}
