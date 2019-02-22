
<?php session_start(); ?><!-- The start of the session.-->
<!-- Imported PHP script -->
<?php
require "includes/db.php"; // Database PHP script.
require "includes/functions.php"; // Functions PHP script.
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>

    <meta charset="utf-8">


    <!-- Imported scripts/files -->
    <link rel="stylesheet" href="../css/account.css" type="text/css" />
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="icon" href="../resources/windowIcon.png" /><!-- Tab's icon -->


    <!-- This script sets the window tab's text in dependency of username given to it by the $_SESSION variable. -->
    <?php echo "<title>".$_SESSION['username']."'s account</title>";?>
  </head>

  <body>

  <!--

  This is user's profile.

  -->


  <!--  Users account main container -->
  <div class="animated fadeInDown" id="main-container" >

  <!-- Decorative block -->
  <div id="decorative-block">

  <!-- Username -->
  <h1 id="decorative-username"><?php echo $_SESSION['username'];?></h1>

  <!-- Decorative links navbar-->
  <p id="decorative-links" align="right">

    <!-- Change password link, that takes user to the changePassword.php page where he can change his password. -->
    <a href="changePassword.php" title="Click to change your password!"><i class="fas fa-key"></i> Change password</a> |

    <!-- Homepage link, that takes user to the homepage. -->
    <a href="../index.php" title="Go to the main page!"><i class="fas fa-home"></i> Home</a>

  </p><!-- End of Decorative links navbar -->

</div><!-- End of Decorative block -->

  <!-- Information block -->
  <div id="information-block">

  <!-- Rounded avatar container (avatar's border) -->
  <div id="rounded-avatar-container">

  <!-- Avatar photo file -->
  <img src="../resources/unknownAvatar.jpg" alt="avatar" id="rounded-avatar"/>

</div><!-- End of Rounded avatar's container (avatar's border) -->

  <!-- User's full name -->
  <h1 id="fullname-infoblock"><?php echo $_SESSION['fullname']; ?></h1>

  </div><!-- End of information block -->

</div><!-- End User account main container -->

  </body>

</html>
