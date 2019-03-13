<?php

/*

  This is the database file, that connects an MySQL database to the RedBeanPHP library.

*/

require "libs/rb.php"; //RedBeanPHP implement.

//Connecting to the MySQL database...
R::setup( 'mysql:host=localhost;dbname=database_name',
      'database_user', 'database_password' );

session_start(); //The start of session.
