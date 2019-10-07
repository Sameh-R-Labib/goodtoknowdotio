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

        global $sessionMessage;

        global $user_id;

        kick_out_loggedoutusers();

        $db = get_db();

        $inbox_messages_array = MessageToUser::get_array_of_message_objects_for_a_user($db, $sessionMessage, $user_id);


        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         */

        if (!empty($inbox_messages_array)) {

            $return = MessageToUser::replace_attributes($db, $sessionMessage, $inbox_messages_array);

            if ($return === false) {

                breakout(' Unexpected error 01551. ');

            }
        }

        $html_title = 'Choose Messages';

        require VIEWS . DIRSEP . 'blotoutsomeinboxmessages.php';
    }
}