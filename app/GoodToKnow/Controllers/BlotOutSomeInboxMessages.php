<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class BlotOutSomeInboxMessages
{
    function page()
    {
        /**
         * Presents checkbox choices of the user's inbox messages.
         * The ones chosen will be deleted in the subsequent route.
         */


        global $g;
        global $db;


        kick_out_loggedoutusers();


        $db = get_db();

        $g->inbox_messages_array = MessageToUser::get_array_of_message_objects_for_a_user($g->user_id);

        if ($g->inbox_messages_array === false) {

            breakout(' Your inbox is empty 📭 ');

        }


        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         */

        $return = MessageToUser::replace_attributes($g->inbox_messages_array);

        if ($return === false) {

            breakout(' Unexpected error 01551. ');

        }


        $g->html_title = 'Choose Messages';

        require VIEWS . DIRSEP . 'blotoutsomeinboxmessages.php';
    }
}