<?php
/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: login.class.php
 * Description: This class defines a method "display" that displays a login form.
 */

class Login extends View {

    public function display() {
        parent::header();
        ?>
        <div class="top-row">Login</div>
        <div class="middle-row">
            <p>Please enter your username and password.</p>
            <form method="post" action="index.php?action=verify">
                <div><input type="text" name="username" style="width: 99%" placeholder="Username"></div>
                <div><input type="password" name="password" style="width: 99%" placeholder="Password"></div>
                <div><input type="submit" class="button" value="Login"></div>
            </form>
        </div>
        <div class="bottom-row">
            <span style="float: left">Don't have an account? <a href="index.php?action=index">Register</a></span>
            <span style="float: right"></span>
        </div>
        <?php
        parent::footer();
    }

}
