<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class BlotOutSomeInboxMessagesProcessor
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        if (!isset($_POST) || empty($_POST) || !is_array($_POST)) {

            breakout(' Unexpected deficiencies in the POST array. ');

        }


        $submitted_message_ids_array = [];

        foreach ($_POST as $item) {

            if (is_numeric($item)) {

                $submitted_message_ids_array[] = $item;

            }
        }

        if (empty($submitted_message_ids_array)) {

            breakout(' You did not submit any message ids. ');

        }


        /**
         * Delete each of the chosen messages.
         */

        $g->db = get_db();

        foreach ($submitted_message_ids_array as $id) {

            // Only delete the MessageToUser record. Do Not delete the Message record since it may be needed by another user.

            $return = MessageToUser::delete_all_particular($id, $g->user_id);

            if ($return === false) {

                breakout(' Message deletion failed. ');

            }

        }


        /**
         * Declare success.
         */

        breakout(" Message deletion completed. ");
    }
}