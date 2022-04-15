<?php

/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: user_model.class.php
 * Description: The UserModel class manages user data in the database.
 */

class UserModel {

    //private data members
    private $db;
    private $dbConnection;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
    }

    //add a user into the "users" table in the database
    public function add_user() {
        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //execute the query and return true if successful or false if failed
        try {

            if ($username == "" OR $password == "" OR $lastname == "" OR $firstname == "" OR $email == "") {
                throw new DataMissingException("Data is missing. Fill in all fields.");
            }

            if (Utilities::checkemail($email) == FALSE) {
                throw new EmailFormatException("The email format is invalid. Use correct format.");
            }

            if (strlen($password) < 5) {
                throw new DataLengthException("The password length is invalid. Use at least 5 characters.");
            }

            //construct an INSERT query
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '$username', '$hashed_password', '$email', '$firstname', '$lastname')";

            if (!$this->dbConnection->query($sql)) {
                throw new DatabaseException("The SQL query or the database connection is invalid.");
            }

        } catch (DataMissingException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (DataLengthException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (DatabaseException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (EmailFormatException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        }   return true;
    }

    //verify username and password against a database record
    public function verify_user() {
        //retrieve username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        try {

            if ($username == "" OR $password == "") {
                throw new DataMissingException("Data is missing. Fill in all fields.");
            }

        //sql statement to filter the users table data with a username
        $sql = "SELECT password FROM " . $this->db->getUserTable() . " WHERE username='$username'";

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            throw new DatabaseException("The SQL query or the database connection is invalid.");
        }

            //verify password; if password is valid, set a temporary cookie
            if($query AND $query->num_rows > 0) {
                $result_row = $query->fetch_assoc();
                $hash = $result_row['password'];
                if (password_verify($password, $hash)) {
                    setcookie("user", $username);
                    return true;
                }
            }
            } catch (DataMissingException $e) {
                $view = new UserError();
                $view->display($e->getMessage());
                return false;

            } catch (DatabaseException $e) {
                $view = new UserError();
                $view->display($e->getMessage());
                return false;

            } catch (Exception $e) {
                $view = new UserError();
                $view->display($e->getMessage());
                return false;
            }
        return false;
    }

    //logout user: destroy session data
    public function logout() {
        //destroy session data
        setcookie("user", '', -10);
        return true;
    }

    //reset password
    public function reset_password() {
        //retrieve username and password from a form
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {

            if ($username == "" OR $password == "") {
                throw new DataMissingException("Data is missing. Fill in all fields.");
            }

            if (strlen($password) < 5) {
                throw new DataLengthException("The password length is invalid. Use at least 5 characters.");
            }

            //the sql statement for update
            $sql = "UPDATE  " . $this->db->getUserTable() . " SET password='$hashed_password' WHERE username='$username'";

            if (!$this->dbConnection->query($sql)) {
                throw new DatabaseException("The SQL query or the database connection is invalid.");
            }
        } //return false if no rows were affected

        catch (DataMissingException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (DataLengthException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (DatabaseException $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;

        } catch (Exception $e) {
            $view = new UserError();
            $view->display($e->getMessage());
            return false;
        }
        return true;
    }
}