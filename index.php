<?php

/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: index.php
 * Description: The homepage and the bootstrap file.
 * Options of the "action":
 *      index: display the registration form; default action
 *      register: register the user by creating a user account
 *      login: display the login form
 *      verify: verfiy username and password
 *      logout: log a user out
 *      reset: display the password reset form
 *      do_reset: update the password
 *      error: display an error message
 */

require_once ("vendor/autoload.php");

//create an object of UserController
$user_controller = new UserController();

//retrieve the action from a querystring variable named "action"
if (!($action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING))) {
    $action = "index";  //default action
}

//take different action depending on the action value
switch ($action) {
    case "index":
        $user_controller->index();
        break;
    case "register":
        $user_controller->register();
        break;
    case "login":
        $user_controller->login();
        break;
    case "verify":
        $user_controller->verify();
        break;
    case "logout":
        $user_controller->logout();
        break;
    case "reset":
        $user_controller->reset();
        break;
    case "do_reset":
        $user_controller->do_reset();
        break;
    default:
        $user_controller->error("Invalid action was requested.");
}