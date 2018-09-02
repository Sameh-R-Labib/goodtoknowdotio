<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


class Home
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

        if (!$is_logged_in) {
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'GoodToKnow.io';

        /**
         * Debug Code
         */
        echo "\n\n<p>We are in the Home page method.</p>\n\n";
        echo "\n\n<p>Here I will show the value of \$sessionMessage: </p>\n\n";
        var_dump($sessionMessage);
        echo "\n\n<p>Here I will show the value of constant SESSIONMESSAGE: </p>\n\n";
        var_dump(SESSIONMESSAGE);
        echo "\n\n";
        die("And here in Home page is where I stop\n\n");

        require TOP;

        require VIEWS . DIRSEP . 'homepage.php';

        require BOTTOM;
    }
}