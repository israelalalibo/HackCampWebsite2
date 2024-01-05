<?php

use Models\LoginChecks;
require_once('Models/LoginChecks.php');
session_start();

$view = new stdClass();
$view->pageTitle = 'Log In';

//values will be changed to the appropriate error messages if there is an error logging in
$view->username_error = null;
$view->password_error = null;

//Declare session isLoggedIn as false
$_SESSION['isLoggedIn'] = false;



if (isset($_POST["login"])) { //checks to see if the login button has been pressed
    //stores the typed in username and password in variables to be used later on
    $username = htmlentities($_POST["username"]);
    $password = htmlentities($_POST["password"]);

    $loginCheck = new LoginChecks($username, $password);
    //Hardcoded username and password
    if ($loginCheck->checkUserName()) {
        if ($loginCheck->checkPassword()) { //checks if username matches with password
            $_SESSION['username'] = $username;
            $_SESSION['pwd'] = $password;
            $_SESSION['isLoggedIn'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $view->password_error = "Password is incorrect";
            //echo "password does not match ";   //was used as a debugging tool
        }
    } else {
        $view->username_error = "Username not found";
        //echo "username not found";      //was used as a debugging tool
    }

    /**if ($username == "HackCamp" && $password == "123") {
        //update the session isLoggedIn
        $_SESSION['isLoggedIn'] = true;
        header("Location: dashboard.php");
        exit();
    }
    else {
        echo "Incorrect login details";
    }**/
}

require_once ("Views/login.phtml");