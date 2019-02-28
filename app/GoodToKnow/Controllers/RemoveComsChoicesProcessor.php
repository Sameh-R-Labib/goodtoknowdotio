<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-02-28
 * Time: 13:29
 */

namespace GoodToKnow\Controllers;


class RemoveComsChoicesProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username
        global $saved_int01; // Has user's id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Now we know the ids of the communities which the administrator
         * doesn't want the user to belong to. The goal is to remove these
         * communities to the user.
         */

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