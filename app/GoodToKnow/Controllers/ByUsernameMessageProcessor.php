<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/8/18
 * Time: 2:38 PM
 */

namespace GoodToKnow\Controllers;


class ByUsernameMessageProcessor
{
    public function page()
    {
        /**
         * Basically what needs to get accomplished here is
         * to validate the submitted username and present
         * the next form (which is for entering the text of
         * the message.)
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * The submitted form field is $_POST['username']
         */
        $submitted_username = (isset($_POST['username'])) ? $_POST['username'] : '';

        /**
         * Now we know that $submitted_username is of type string and is set to a particular value.
         */

        /**
         * Make sure $submitted_username is valid.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }

    // Helpers for the page() method

    public static function is_username_in_our_system(\mysqli $db, string &$message, string &$username)
    {
        /**
         * Returns true or false.
         *
         * First makes sure it fits the pattern of a username.
         * Then, makes sure the username exists in the database.
         */

        $username = trim($username);

        if (empty($username)) {
            $message .= " The username field was empty. ";
            return false;
        }

        $words = explode('_', $username);

        if (count($words) != 2) {
            $message .= " The username must have two parts separated by an underscore character. ";
            return false;
        }


    }
}