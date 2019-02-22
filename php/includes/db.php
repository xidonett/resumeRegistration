<?php

/*

  This is the database file, that connects an MySQL database to the RedBeanPHP library.

*/

require "libs/rb.php"; //RedBeanPHP implement.

//Connecting to the MySQL database...
R::setup( 'mysql:host=localhost;dbname=id6976920_accounts',
      'id6976920_xidonett', 'superman2012' );

session_start(); //The start of session.
