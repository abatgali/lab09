<?php
/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: register.class.php
 * Description: This class defines a method "display" that displays a user registration form.
 */

class Index extends View {

    public function display() {
        parent::header();
        ?>
        <div class="top-row">CREATE AN ACCOUNT</div>
        <div class="middle-row">
            <p>Please complete the entire form. All fields are required.</p>
            <form method="post" action="index.php?action=register">
                <div><input type="text" name="username" style="width: 99%"  placeholder="Username"></div>
                <div><input type="password" name="password" style="width: 99%"  placeholder="Password, 5 characters minimum"></div>
                <div><input type="text" name="email" style="width: 99%" placeholder="Email"></div>
                <div><input type = 'text' name="fname" style="width: 99%"  placeholder="First name"></div>
                <div><input type="text" name="lname" style="width: 99%" placeholder="Last name"></div>
                <div><input type="submit" class="button" value="register"></div>
            </form>
        </div>
        <div class="bottom-row">
            <span style="float: left">Already have an account? <a href="index.php?action=login">Login</a></span>
            <span style="float: right"></span>
        </div>
        <?php
        parent::footer();
    }

}
