<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-02-21
 * Time: 21:05
 */

namespace GoodToKnow\Controllers;


class RemoveComsFromUserProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goal:
         *  1) Validate $_POST['username']
         *  2) Save $_POST['username']
         *  3) Redirect to a route which will present a form with checkboxes for choosing communities
         */

        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $is_username = GiveComsToUsrProcessor::is_username_in_our_system($db, $sessionMessage, $submitted_username);

        if (!$is_username) {
            $sessionMessage .= " The username is not valid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $submitted_username;

        redirect_to("/ax1/RemoveComsChoices/page");
    }
}