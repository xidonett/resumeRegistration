
<!-- Imported PHP scripts -->
<?php

 require "includes/db.php"; // Database PHP script
 require "includes/functions.php";// Database PHP script

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <!-- Import of the database PHP script -->

    <!-- Imported scripts/files -->
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->

    <!-- This script sets the window tab's text in dependency of username given to it by the $_SESSION variable. -->
    <?php echo '<title>'.$_SESSION['username'].'\'s password changing</title>';?>

  </head>

  <body>

    <!--

    This page allows user to change his password in case of many reasons.
    User should to change his password after he has been changed it on temporary one.

    -->

  <!--  Change password main content -->
  <div class="animated fadeInDown content-block" id="main-container" >

    <!-- Back button -->
    <p align="right"><a href="account.php" title="Back to the personal account page!"><i class="fas fa-undo"></i>   Back</a></p>

    <!-- Main header -->
    <h1 align="center">Password Changing</h1>

    <!-- Function that changes your password -->
    <?php changePassword();?>

    <!-- Change password's input form -->
    <form method="post">

      <!-- Username input field -->
      <p align="center"><input type="text" name="usernameInput" placeholder="Username" required></p>

      <!-- E-mail input field -->
      <p align="center"><input type="email" name="emailInput" placeholder="E-mail" required></p>

      <!-- Current password input field -->
      <p align="center"><input type="password" name="currentPasswordInput" placeholder="Current password" required></p>

      <!-- New password input field -->
      <p align="center"><input type="password" name="newPasswordInput" placeholder="New password" required></p>

      <!-- New password confirmation input field -->
      <p align="center"><input type="password" name="newPasswordConfirmationInput" placeholder="Password confirmation" required></p>

      <!-- Change password button, that triggers changePassword function from functions.php script -->
      <p align="center"><input type="submit" name="changePasswordButton" value="Change password"></p>

    </form><!-- End of Change password's input form -->

  </div><!-- End of Change password main content -->

  </body>

</html>
