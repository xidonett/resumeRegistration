<?php require 'includes/db.php';?> <!-- Database PHP script -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">


    <!-- Imported scripts/resources -->

    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->

    <title>Password has been successfully changed!</title>
  </head>

  <body>

  <!--

  This page indicates, if user registered successfully and account has been created.
  It's kind of 'success indicator' in matter of registration.
  Only appears if password has been changed successfully.

  -->


  <!-- Main content block -->
  <div class="animated fadeInDown content-block" >

    <!-- Tick's icon -->
    <p align="center"><img src="../resources/tick.png" alt="Successfull Registration!"></p>

    <!-- Main header -->
    <h1 align="center">Password has been updated!</h1>

    <!-- Link to the homepage, from which user can easily log in using his new updated password -->
    <a href="../index.php"><p align="center"><i class="fas fa-home">  Home</i></p></a>

  </div><!-- End of main content block -->

  </body>
</html>
