<!-- Imported PHP script -->
<?php require 'includes/db.php';?><!-- Database PHP script -->

<!DOCTYPE html>

<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">

    <!-- Imported scripts/files -->

    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    <link rel="icon" href="../resources/windowIcon.png" />

    <title>Successfully Registered!</title>
  </head>
  <body>

  <!--

  This page indicates, if user registered successfully and account has been created.
  It's kind of 'success indicator' in matter of registration.
  Only appears if user registrated successfully.

  -->


  <!-- Main content block -->
  <div class="animated fadeInDown content-block" >

    <!-- Tick's icon -->
    <p align="center"><img src="../resources/tick.png" alt="Successfull Registration!"></p>

    <!-- Main header -->
    <h1 align="center">Successfully Registered!</h1>

    <!-- Link to the personal account that were created after registration -->
    <a href="account.php"><p align="center"><i class="fas fa-user-circle">  My Account</i></p></a>

  </div><!-- End of main content -->
  </body>
</html>
