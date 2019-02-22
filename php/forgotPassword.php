
<!-- Imported PHP scripts -->
<?php

  require "includes/db.php";// Database PHP script
  require "includes/functions.php";// Functions PHP script

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">

    <!-- Imported scripts/files-->
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->

    <title>Forgot Password</title>

  </head>
  <body>

  <!--

  This page allows user to get access to his account, if he's forgot the password.
  The new password will be send on the e-mail address. After user will be loggined in,
  he should to change the temporary randomly generated password on his own, better password.

  -->


  <!-- Forgot password main content block -->
  <div class="animated fadeInDown content-block">

    <!-- Back button -->
    <p align="right"><a href="login.php" title="Back to the log in page!"><i class="fas fa-undo"></i>   Back</a></p>

    <!-- Main header -->
    <h1 align="center" id="login-caption">Password recovery</h1>

    <!-- Function, that checks all input fields and if they are correct sends an e-mail message with new
    temporary randomly generated password. -->
    <?php forgotPassword(); ?>

    <!-- Forgot password input form -->
    <form method="post">

      <!-- Username input field -->
      <p align="center"><input type="text" name="usernameInput" placeholder="Username" required/></p>

      <!-- E-mail input field -->
      <p align="center"><input type="email" name="emailInput" placeholder="E-mail" required/></p>

      <!-- Restore button, that activates forgotPassword function from functions.php script -->
      <p align="center"><input type="submit" name="restoreButton" value="Restore password" /></p>

    </form><!-- End of Forgot password input form -->

  </div><!-- End of Forgot password main content block -->

  </body>
</html>
