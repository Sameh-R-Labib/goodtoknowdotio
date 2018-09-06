<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/5/18
 * Time: 4:21 PM
 */

namespace GoodToKnow\Controllers;


class AdminCreateUser
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
        global $community_array;
        global $topic_id;
        global $page_id;
        global $saved_str01; // choice
        global $saved_str02;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Debug Code
         */
        echo "\n\n<p>Begin debug code output.</p>\n\n";
        echo "\n\n<p>Var_dump of \$saved_str01: </p>\n\n";
        echo "\n\n<pre>";
        var_dump($saved_str01);
        echo "</pre>\n\n";
        echo "\n\n<p>Var_dump of \$_POST: </p>\n\n";
        echo "\n\n<pre>";
        var_dump($_POST);
        echo "</pre>\n\n";
        echo "\n\n<p>Print_r of \$_POST: </p>\n\n";
        echo "\n\n<pre>";
        print_r($_POST);
        echo "</pre>\n\n";
        die("\n\n<p>End of debug code output.</p>\n\n");
    }
}