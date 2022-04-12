<?php

/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: user_controller.class.php
 * Description: the controller of the application.
 */

class UserController {

    private $user_model;  //an object of the UserModel class

    //create an instance of the UserModel class in the default constructor

    public function __construct() {
        $this->user_model = new UserModel();
    }

    //display the registration form.
    public function index() {
        $view = new Index();
        $view->display();
    }

    //create a user account by calling the addUser method of a userModel object
    public function register() {
        //call the addUser method of the UserModel object
        $retult = $this->user_model->add_user();

        //display result
        $view = new Register();
        $view->display($retult);
    }

    //display the login form
    public function login() {
        $view = new Login();
        $view->display();
    }

    //verify username and password by calling the verifyUser method defined in the model.
    //It then calls the display method defined in a view class and pass true or false.
    public function verify() {
        //call the verifyUser method of the UserModel object
        $result = $this->user_model->verify_user();

        //display result
        $view = new Verify();
        $view->display($result);
    }

    //log out a user by calling the logout method defined in the model and then 
    //display a confirmation message
    public function logout() {
        $this->user_model->logout();
        $view = new Logout();
        $view->display();
    }

    //display the password reset form or an error message.
    public function reset() {
        if (!isset($_COOKIE['user'])) {  //if the user has not logged in
            $this->error("To reset your password, please log in first.");
        } else { //if the user has logged in.
            $user = $_COOKIE['user'];
            $view = new Reset();
            $view->display($user);
        }
    }

    //reset password by calling the resetPassword method in user model
    public function do_reset() {

        $result = $this->user_model->reset_password();
        //exit($result);

        $view = new ResetConfirm();
        $view->display($result);
    }

    //display an error message
    public function error($message) {
        $view = new UserError();
        $view->display($message);
    }

}
