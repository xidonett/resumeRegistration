
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
    <link rel="stylesheet" href="../css/login.css" type="text/css" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />

    <!-- Animate.css -->
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->

    <title>Register</title>

  </head>
  <body>

  <!--

   This site provides registration for new users that haven't an account already.
   If user has been registered successfully, he will see an
   'successfull registration indicator' (successfullyRegistered.php script).

 -->



  <!-- Registration block -->
  <div class="animated fadeInDown content-block" >

    <!-- Back button -->
    <p align="right"><a href="../index.php" title="Back to the home page!"><i class="fas fa-undo"></i>   Back</a></p>

    <!-- Main header -->
    <h1 align="center" id="register-caption">Registration</h1>



  <!-- Function, that creates an account -->
  <?php createAccount(); ?>



    <!-- Main input form with POST method -->
    <form method="post">

      <!-- Full name input field -->
      <p align="center"><input type="text" name="fullnameInput" placeholder="Full name" required></p>

      <!-- Username input field -->
      <p align="center"><input type="text" name="usernameInput" placeholder="Username" required></p>

      <!-- E-mail input field -->
      <p align="center"><input type="email" name="emailInput" placeholder="E-mail" required></p>

      <!-- Password input field -->
      <p align="center"><input type="password" name="passwordInput" placeholder="Password" required/></p>

      <!-- Password confirmation input field -->
      <p align="center"><input type="password" name="passwordConfirmationInput" placeholder="Confirm your password" required/></p>

      <!-- Register button, that activates createAccount function from functions.php file -->
      <p align="center"><input type="submit" name="registerSubmitButton" value="Register"></p>

    </form><!-- End of main form -->

  </div><!-- End of registration block -->

  </body>
</html>
