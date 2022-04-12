<?php
/*
 * Author: Louie Zhu
 * Date: 11/05/2021
 * Name: login.class.php
 * Description: This class defines a method "display" that confirms the password reset.
 */

class ResetConfirm extends View {

    public function display($result) {
        View::header();
        ?>

        <div class="top-row">Reset password</div>
        <div class="middle-row">
            <p><?= $result ?></p>
        </div>
        <div class="bottom-row">         
            <span style="float: left">
                <?php
                if (strpos($result, "successful") == true) { //display the logout button
                    echo "Want to log out? <a href='index.php?action=logout'>Logout</a>";
                } else { //display the reset button
                    echo "Reset password? <a href='index.php?action=reset'>Reset</a>";
                }
                ?>
            </span>
            <span style="float: right">Don't have an account? <a href="index.php">Register</a></span>
        </div>
        <?php
        View::footer();
    }

}
