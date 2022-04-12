<?php
/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: register.class.php
 * Description: This class defines a method "display" that confirms the user registration.
 */

class Register extends View {

    public function display($result) {
        parent::header();

        ?>
        <div class="top-row">CREATE AN ACCOUNT</div>
        <div class="middle-row">
            <p><?= $result ?></p>
        </div>
        <div class="bottom-row">         
            <span style="float: left">Already have an account? <a href="index.php?action=login">Login</a></span>
            <span style="float: right">Don't have an account? <a href="index.php?action=index">Register</a></span>
        </div>

        <?php
        parent::footer();
    }

}
