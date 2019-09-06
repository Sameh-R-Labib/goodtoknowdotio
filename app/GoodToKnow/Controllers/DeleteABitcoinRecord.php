<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Bitcoin;

class DeleteABitcoinRecord
{
    function page()
    {
        /**
         * presenting a form for getting the user to tell us which Bitcoin record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */

        global $sessionMessage;
        global $user_id;            // We need this.

        kick_out_loggedoutusers();

        $db = get_db();


        /**
         * Get an array of Bitcoin objects
         * belonging to the current user.
         */

        $sql = 'SELECT * FROM `bitcoin` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_bitcoin_objects = Bitcoin::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_bitcoin_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any bitcoin records ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which bitcoin record?';

        require VIEWS . DIRSEP . 'deleteabitcoinrecord.php';
    }
}