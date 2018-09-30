<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/30/18
 * Time: 3:22 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPostIPProcessor
{
    public function page()
    {
        /**
         * So far we know which topic the new post belongs in
         * and the user just submitted a form letting us know
         * $_POST[relate] and $_POST[choice].
         *
         * These two post variables signify the location where
         * the user wants the new post to go. To understand what
         * I mean you need to know that the posts for a specified
         * topic each have a sequence number. The sequence number
         * helps display the posts in a sequential order.
         *
         * Now determine what the sequence number of the new post
         * will be. Store it in $_SESSION['$saved_int02'].
         * Once that's done redirect to the next script. The next
         * script will move the needle forwards to our goal
         * of creating a new record in the posts table.
         */
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$_POST: </p>\n<pre>";
        var_dump($_POST);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");


    }
}