<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/3/18
 * Time: 5:06 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


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
        global $community_array;
        global $topic_id;
        global $page_id;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        /**
         * Do something with the submitted post data $_POST['choice']
         */

        /**
         * Make sure we got a value for $_POST['choice']
         * (Is it set? Is it empty?)
         * Otherwise, give error and redirect
         */
        if (empty($_POST['choice'])) {
            $_SESSION['message'] .= " Aborted! Expected submission of choice not found. ";
            redirect_to("/ax1/LoginForm/page");
        }


        /**
         * If we don't have $community_array yet then get it
         */
        if (empty($community_array)) {
            $db = db_connect($sessionMessage);
            $community_array = Community::find_all($db, $sessionMessage);
            $_SESSION['community_array'] = $community_array;
        }

        /**
         * Make sure the value of $_POST['choice'] is one of the existing community ids.
         * Otherwise, give error and redirect
         */


        /**
         * So, what would $community_array look like?
         */
        /**
         * Debug Code
         */
        echo "\n\n<p>Begin debug code output.</p>\n\n";
        echo "\n\n<p>Var_dump of \$community_array: </p>\n\n";
        echo "\n\n<pre>";
        var_dump($community_array);
        echo "</pre>\n\n";
        echo "\n\n<p>Print_r of \$community_array: </p>\n\n";
        echo "\n\n<pre>";
        print_r($community_array);
        echo "</pre>\n\n";
        die("\n\n<p>End of debug code output.</p>\n\n");


        $html_title = 'Admin Pass-Code Gen Form Processor';

        require VIEWS . DIRSEP . 'adminpasscodegenformprocessor.php';
    }
}