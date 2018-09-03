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
         * Do something with the submitted post data $_POST['choice']
         */

        /**
         * Make sure we got a value for $_POST['choice']
         * (Is it set? Is it empty?)
         * Otherwise, give error and redirect
         */

        /**
         * Make sure the value of $_POST[''] is numeric
         * (Is it a numeric string? Is it it an integer?)
         * Otherwise, give error and redirect
         */

        /**
         * We need it to be stored as a string because of
         * the way we are going to do comparison in the next step.
         */

        /**
         * Make sure the value of $_POST[''] is one of the existing community ids.
         * Otherwise, give error and redirect
         */
    }
}