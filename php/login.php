<?php session_start(); ?><!-- The start of the session. -->
<!-- Imported PHP scripts -->
<?php
  require "includes/db.php"; // Database PHP script.
  require "includes/functions.php"; // Functions PHP script.

?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">

    <!-- Imported scripts/files-->
    <link rel="stylesheet" href="../css/login.css" type="text/css" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->

    <title>Log in</title>

  </head>
  <body>

  <!--

  Allowing user to log in, if he created an account before.

  -->


  <!-- Log in block -->
  <div class="animated fadeInDown content-block">

    <!-- Back button -->
    <p align="right"><a href="../index.php" title="Back to the home page!"><i class="fas fa-undo"></i>   Back</a></p>

    <!-- Main header -->
    <h1 align="center" id="login-caption">Log in</h1>

    <!-- PHP function from functions.php file,
     that checks correct of typed login and password -->
    <?php logIn(); ?>

    <!-- Log in form -->
    <form method="post">

      <!-- Username input field -->
      <p align="center"><input type="text" name="usernameInput" placeholder="Username" value="<?php echo @$data['usernameInput']; ?>"/></p>

      <!-- Password input field -->
      <p align="center"><input type="password" name="passwordInput" placeholder="Password" value="<?php echo @$data['passwordInput']; ?>"/></p>

      <!-- Log in form submit button, that activates logIn function from functions.php script -->
      <p align="center"><input type="submit" name="loginSubmitButton" value="Log in"></p>

      <!-- Username input field -->
      <p align="center"><a href="forgotPassword.php">Forgot password?</a> | <a href="register.php"> Register</a></p>

    </form><!-- End of log in form -->

  </div><!-- End of main content div block -->

  </body>
</html>
