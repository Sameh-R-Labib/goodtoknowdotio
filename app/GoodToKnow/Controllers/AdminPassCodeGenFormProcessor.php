<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/3/18
 * Time: 5:06 PM
 */

namespace GoodToKnow\Controllers;


class AdminPassCodeGenFormProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_id;
        global $role;
        global $community_name;
        global $community_id;
        global $community_name_array;
        global $topic_id;
        global $page_id;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Debug Code
         */
        echo "\n\n<p>Begin debug code output.</p>\n\n";
        echo "\n\n<p>Var_dump of \$_POST array: </p>\n\n";
        var_dump($_POST);
        die("\n\n<p>End of debug code output.</p>\n\n");
    }
}