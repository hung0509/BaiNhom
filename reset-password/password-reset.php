<?php
$message = "";
$valid = 'true';
// include("config.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="./../css/stylepasswordreset.css">
  <title>Forgot Password</title>
</head>

<body>
  <div class="container relative">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 reset-form" style="background-color: #D2D1D1; border-radius:15px;">
        <!-- <br><br> -->
        <div class="logo-reset">
          <img src="../uploads/logo2.png" alt="GARENA">
        </div>
        <form role="form" method="POST" action="./send-token-email.php">
          <div class="form-group">
            <label>Please enter your email to recover your password</label><br><br>
            <input class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="text@gmail.com">
          </div>

          <?php if (isset($error)) {
            echo "<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>" . $error . "</div>";
          } ?>
          <?php if ($message <> "") {
            echo "<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>" . $message . "</div>";
          } ?>
          <?php if (isset($message_success)) {
            echo "<div class='alert alert-success' role='alert'>
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>" . $message_success . "</div>";
          } ?>
          <button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Send Email</button>
          <br><br>
          <a href="../login.php" style="display: flex; justify-content: center">Back to Login</a>
          <br>
        </form>
      </div>
    </div>
  </div>
</body>

</html>