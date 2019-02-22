<?php
session_start(); //The start of the session.
/*

  This file contains functions for all .php files on the site, that helps
  to compound the biggest part of the PHP code in one place.

*/

//This function prints an error, if something went wrong.
function showErrorMessage($error){
  echo '<hr><p align="center" style="color: red;"><i class="fas fa-exclamation-triangle"></i>  '.$error.'</p><hr />';
}


//This function generates random password for the forgotPassword.php page.
function generateRandomPassword(){
    $password = "";

    //Charset, that is used to generate a password.
    $charset = array(

    "0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O",
    "P","Q","R","S","T","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o",
    "p","q","r","s","t","v","w","x","y","z"

  );

    /*$arrayLength contains the length of array(amount of elements),
    and $arrayLengthModified contains the length of array, but in the result
    decrements returned value on 1 point. */
    $arrayLength = count($charset);
    $arrayLengthModified = $arrayLength - 1;

    //Generates 20 random chars and put them together.
    for($i = 0; $i<20; $i++){
      $randomArrayIndex = rand(0, $arrayLengthModified);
      $password = $charset[$randomArrayIndex].$password;
    }

    //Returns a password.
    return $password;
  }


//This function creates an account and verifies all of the input fields.
function createAccount(){

  //$data stores $_POST array.
  $data = $_POST;

  //$errors array stores all errors.
  $errors = array();

    /*

    This code checks if the form is filled correctly
    and then allows to create an user's account.

    If $data is not empty this code will be runned.*/
    if (!empty( $data )){

    //Checks if the password is the same as given e-mail.
    if ($data['passwordInput'] == $data['emailInput']) {
      $errors[] = "Your password cannot be the same as your e-mail address!";
      $data['passwordConfirmationInput'] = '';
      $data['passwordInput'] = '';
    }

    //Checks if the given password is the same as given fullname.
    if ($data['passwordInput'] == $data['fullnameInput']) {
      $errors[] = "Your password cannot be the same as your full name!";
      $data['passwordConfirmationInput'] = '';
      $data['passwordInput'] = '';
    }

    //Checks if the given password is the same as given username.
    if ($data['passwordInput'] == $data['usernameInput']) {
      $errors[] = "Your password cannot be the same as your username!";
      $data['passwordConfirmationInput'] = '';
      $data['passwordInput'] = '';
    }

    //Checks if the password is less or equal 6 symbols
    if (strlen($data['passwordInput'])<=6) {
      $errors[] = "Your password should be minimum 6 symbols length! ";
      $data['passwordConfirmationInput'] = '';
      $data['passwordInput'] = '';
    }

    //Checks if the password confirmation input is not equals to the given password
    if ($data['passwordConfirmationInput'] != $data['passwordInput']){
      $errors[] = "Passwords are not simillar!";
      $data['passwordConfirmationInput'] = '';
      $data['passwordInput'] = '';
    }

    //Checks if the given username exists
    if (R::count('users', 'username = ?', array($data['usernameInput'])) > 0) {
      $errors[] = "Given username has been already registered!";
      $data['usernameInput'] = '';
    }

    //Checks if the given e-mail exists
    if (R::count('users', 'email = ?', array($data['emailInput'])) > 0) {
      $errors[] = "Given e-mail has been already registered!";
      $data['emailInput'] = '';
    }


    /*If there is no error elements in the $errors array,
    user's account will be created. */

    if(empty($errors)){

      //Returns the database(if a database exists if no - creates it).
      $user = R::dispense('users');

      //Array with forbidden symbols for full name input field.
      $forbiddenSymbolsForFullName = array(
        '<','>','?','/',',','[',']',';',':','(',')','&','@','!','$','_','""'
      );

      //Array with forbidden symbols for username input field.
      $forbiddenSymbolsForUsername = array(
        ' ','<','>','?','/',',','[',']',';',':','(',')','&','@','!','$','_','""'
      );

      //Replaces forbidden symbols on empty place.
      $changedFullname = str_replace($forbiddenSymbolsForFullName, '', $data['fullnameInput']);
      $changedUsername = str_replace($forbiddenSymbolsForUsername, '',$data['usernameInput']);

      //Deletes spaces before and after the user's full name.
      $changedFullname = trim($changedFullname);

      /* If all of the fields were verified successfully and there is no any errors
         all the data from fields will be written in the database. */
      $user->fullname = $changedFullname;
      $user->username = $changedUsername;
      $user->email = $data['emailInput'];
      $user->avatar = "standard-avatar";

      //In the result database will receive an hashed encrypted password.
      $user->password = password_hash($data['passwordInput'], PASSWORD_DEFAULT);

      //$_SESSION contains all of the fields values, except the password value.
      $_SESSION['fullname'] = $user->fullname;
      $_SESSION['username'] = $user->username;
      $_SESSION['email'] = $username->email;
      $_SESSION['avatar'] = $username->avatar;

      //After that, user receives an e-mail letter with password and login for his recently created account.
      mail($data['emailInput'], "Registration has been completed!", "You have been registered successfully!
       \n USERNAME: ".$changedUsername.
       "\n PASSWORD: ".$data['passwordInput']."\n
        With best wishes,\nVladimir");

      //Then, all values is stored in the database.
      R::store($user);

      //Finally, user will be relocated on the successfullyRegistered.php page, that indicates successful registration.
      echo "<script>location.href = 'successfullyRegistered.php'</script>";

    //If there is some errors, this code will be activated and will print an error message.
    }else{

      showErrorMessage(array_shift($errors));

    }//End of last else of the createAccount() function.

  }//End of (!empty( $data )) condition test.

}//End of createAccount() function.


//logIn() function allows you to log in your account, if you created it before.
function logIn(){
  $data = $_POST;

  /* If the user clicked on the loginSubmitButton,
   this part of code will be activated */
  if (isset($data['loginSubmitButton'])) {

    //$errors array stores all errors caused by input fields.
    $errors = array();

    //Trying to find a user in the database with determined username.
    $user = R::findOne('users', 'username = ?', array($data['usernameInput']));

    //If the user exists this code will be runned.
    if ($user) {

      /*Checks if the password for determined user is correct
      If password is correct, user will be redirected on his
      personal account page. */
      if (password_verify($data['passwordInput'], $user->password)) {
         $_SESSION['username']= $user->username;
         $_SESSION['fullname']= $user->fullname;
        echo "<script>location.href = 'account.php'</script>";
      }

      //Runs if password is not correct for determined user.
      else{
        $errors[] = "Incorrect password!";
      }

    }//End of $user existance condition.

    //Return an error, if the user's account is not exists
    else{
      $errors[] = "This account isn't exists!";
    }

    /* If there everything is correct,
       user will be redirected to his
       personal account. */
    if(empty( $errors )){

        require 'account.php';

      }else{
        /*
        This function display an error if something in
        input fields is not correct.

        */
        showErrorMessage(array_shift($errors));

      }//End of else.

  }//End of loginSubmitButton event handler.

}//End of logIn() function.


    //Runs when user clicked on the changePasswordButton.
    if (isset($data['changePasswordButton'])) {
      //$data stores $_POST array.
      $data = $_POST;

      //$errors array stores all errors.
      $errors = array();

      //Received values from input forms.
      $username = $data['usernameInput'];
      $email = $data['emailInput'];
      $currentPassword = $data['currentPasswordInput'];
      $newPassword = $data['newPasswordInput'];
      $newPasswordConfirmation = $data['newPasswordConfirmationInput'];

      //Trying to find the user with determined username.
      $user = R::findOne('users', 'username = ?', array($username));

      //If user found, next code runs.
      if($user){

        //Checks if the new password confirmation input is not equals to the given new password.
        if ($newPassword != $newPasswordConfirmation) {
          $errors[] = "Your new passwords are different! ";
          $newPassword = '';
          $newPasswordConfirmation = '';
        }

        //Checks if the current password less than or equals 6 symbols.
        if (strlen($currentPassword) <=6) {
          $errors[] = "Your current password should be minimum 6 symbols length! ";
          $newPassword = '';
          $currentPassword = '';
        }

        //Checks if the new password less than or equals 6 symbols.
        if (strlen($newPassword) <=6) {
          $errors[] = "Your new password should be minimum 6 symbols length! ";
          $newPassword = '';
          $currentPassword = '';
        }


      }
      /* Else code will be executed, if user is not exist.  */
      else{
              $errors[] = "You typed in incorrect data!";

              //All values in input fields will be erased.
              $username = '';
              $email = '';
              $currentPassword = '';
              $newPassword = '';
              $newPasswordConfirmation = '';

      }//End of else.

      //This code will be runned, if there won't be any errors.
      if(empty( $errors )){

          //Retrived data from the input fields.
          $email = $data['emailInput'];
          $username = $data['usernameInput'];
          $newPassword = $data['newPasswordInput'];

          //Sets a new hashed encrypted password for the user's account.
          $user->password = password_hash($newPassword, PASSWORD_DEFAULT);

          //Stores everything in the database.
          R::store($user);

          //Sends an e-mail letter to the user with his account data.
          mail($email,
          $username." PASSWORD CHANGED",
          "Hello, ".$username."\n\nYour CURRENT password is: ".$newPassword."\n
           With best wishes,\nVladimir");
          echo "<script>location.href = 'passwordSuccessfullyChanged.php'</script>";

          }else{
          /*
          This function display an error if something in
          input fields is not correct.
          */

          showErrorMessage(array_shift($errors));

        }//End of else.

    }//End of changePasswordButton action handler.



//This function change user's password.
function changePassword(){

      //$data stores $_POST array.
      $data = $_POST;

      //$errors array stores all errors.
      $errors = array();

      //This code will be runned, if user will click on the changePasswordButton
      if (isset($data['changePasswordButton'])) {

        //Retrived values from the page's input forms.
        $username = $data['usernameInput'];
        $email = $data['emailInput'];
        $currentPassword = $data['currentPasswordInput'];
        $newPassword = $data['newPasswordInput'];
        $newPasswordConfirmation = $data['newPasswordConfirmationInput'];

        //Trying to find user with determined username value.
        $user = R::findOne('users', 'username = ?', array($username));

        //If user exists, this code will be executed.
        if($user){

          //Checks if the new password confirmation input is not equals to the given new password.
          if ($newPassword != $newPasswordConfirmation) {
            $errors[] = "Your new passwords are different!  ";
            $newPassword = '';
            $newPasswordConfirmation = '';
          }

          //Checks if the current password less than or equals 6 symbols.
          if (strlen($currentPassword) <=6) {
            $errors[] = "Your current password should be minimum 6 symbols length! ";
            $newPassword = '';
            $currentPassword = '';
          }

          //Checks if the new password less than or equals 6 symbols.
          if (strlen($newPassword) <=6) {
            $errors[] = "Your new password should be minimum 6 symbols length! ";
            $newPassword = '';
            $currentPassword = '';
          }


        }
        /* If user is not exist or this values is not matching
         with anything in database this code will be executed. */
        else{
                $errors[] = "You typed in incorrect data!";
                $username = '';
                $email = '';
                $currentPassword = '';
                $newPassword = '';
                $newPasswordConfirmation = '';
        }

        /*This code will be executed, if everything
        is correct and there is no errors on the page. */
        if(empty( $errors )){

            //Retrives user's input values and stores them in the variables.

            $email = $data['emailInput'];
            $username = $data['usernameInput'];
            $newPassword = $data['newPasswordInput'];

            //Password hashing(encrypting).
            $user->password = password_hash($newPassword, PASSWORD_DEFAULT);

            //Storing password value in the database.
            R::store($user);

            //Sending an e-mail.
            mail($email,
            $username." PASSWORD CHANGED",
            "Hello, ".$username."\n\nYour CURRENT password is: ".$newPassword."\n\n
             With best wishes,\nVladimir");

            /* In the end, user will be relocated to the passwordSuccessfullyChanged.php page
               That means that user completed everything without any error. */

            echo "<script>location.href = 'passwordSuccessfullyChanged.php'</script>";

            }else{
            /*
            This function display an error if something in
            input fields is not correct.
            */

            showErrorMessage(array_shift($errors));

          }//End of else.

      }//End of changePasswordButton event handler.

}//End of changePassword() function.

/*

This function allows user to restore his password,
for example, when he forgot his own password from
the personal account. This function will send a
random password to the user, and after user will
login in the personal account, he will be able to
easilly change the password.

*/
function forgotPassword(){

  //$data stores $_POST array.
  $data = $_POST;

  //$errors array stores all errors.
  $errors = array();

    //This code will be executed, if user will click on the restoreButton.
    if (isset($data['restoreButton'])) {

      /*Retrieves the username value from usernameInput
      and stores it in the $username variable.*/
      $username = $data['usernameInput'];

      //Trying to find determined user by using retrieved username.
      $user = R::findOne('users', 'username = ?', array($username));


      //This code will be executed, if given username exists in the database.
      if($user){

      //Retrieved values from input forms.
      $username = $data['usernameInput'];
      $email = $data['emailInput'];


      if ($user->username != $username) {
        $errors[] = "This username is not exists!";
        $username = "";
      }
      if ($user->email != $email) {
        $errors[] = "This E-mail address is not exists!";
        $email = "";
      }

      /* This part of code will be runned,
      if there everything is OK and won't
      be any errors. */
      if(empty( $errors )){

          /* Retrieves email and username from input fields
            and stores them in the variables. */
          $email = $data['emailInput'];
          $username = $data['usernameInput'];

          //Generates random password and stores it in the variable.
          $generatedPassword = generateRandomPassword();

          //Password hashing(encrypting).
          $user->password = password_hash($generatedPassword, PASSWORD_DEFAULT);

          //Stores user's hashed password in the database.
          R::store($user);

          //Sends an e-mail to the user's e-mail address.
          mail($email,
          $username." PASSWORD RESTORED",
          "Hello, ".$username."!\n\nYour new password is: ".$generatedPassword."\nDON'T FORGET TO CHANGE YOUR PASSWORD AFTER YOU LOGGED IN\n\n
           With best wishes,\nVladimir");

          /*If everything is OK, and there is no any errors, user
          will be relocated on the passwordSuccessfullyChanged.php page.*/
          echo "<script>location.href = 'passwordSuccessfullyChanged.php'</script>";

          }else{
          /*
          This function display an error if something in
          input fields is not correct.
          */

          showErrorMessage(array_shift($errors));

        }//End of else.

      }

      /*This code will be executed, if user
       typed unexisting username or wrong username.*/

      else{
        $errors[] = "Given account is not exist!";
        $username = "";
        $email = "";
      }//End of else.

    }//End of restoreButton event handler.

}//End of forgotPassword() function.
