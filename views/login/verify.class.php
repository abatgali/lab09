<?php
/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: login.class.php
 * Description: This class defines a method "display" that displays a login confirmation message.
 */

class Verify extends View {

    public function display($result) {
        parent::header();

        ?>
        <div class="top-row">Login</div>
        <div class="middle-row">
            <p><?= $result ?></p>
        </div>
        <div class="bottom-row">
            <span style="float: left">
                <?php
                if (strpos($result, "successful") == true) { //if the user has logged in, display the logout button
                    echo "Want to log out? <a href='index.php?action=logout'>Logout</a>";
                } else { //if the user has not logged in, display the login button
                    echo "Already have an account? <a href='index.php?action=login'>Login</a>";
                }
                ?>
            </span>
            <span style="float: right">Reset password? <a href="index.php?action=reset">Reset</a></span>
        </div>
        <?php
        parent::footer();
    }

}
