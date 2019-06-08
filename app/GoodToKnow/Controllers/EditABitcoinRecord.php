<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;


class EditABitcoinRecord
{
    public function page()
    {
        /**
         * This feature is for editing/updating
         * a Bitcoin record.
         *
         * This route is for presenting a
         * form for getting the user to tell us
         * which Bitcoin record he wants to edit.
         * It will present a series of radio
         * buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Get an array of Bitcoin objects
         * belonging to the current user.
         */
        $sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_bitcoin_objects = Bitcoin::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_bitcoin_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any bitcoin records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which bitcoin record?';

        require VIEWS . DIRSEP . 'editabitcoinrecord.php';
    }
}