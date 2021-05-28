<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class Inbox
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $user_id;
        global $show_poof;
        global $html_title;
        global $page;
        global $inbox_messages_array;


        kick_out_loggedoutusers();


        $html_title = 'Inbox';


        $page = 'Inbox';


        $show_poof = true;


        $db = get_db();


        $inbox_messages_array = MessageToUser::get_array_of_message_objects_for_a_user($user_id);


        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         */

        if (!empty($inbox_messages_array)) {

            $return = MessageToUser::replace_attributes($inbox_messages_array);

            if ($return === false) {

                breakout(' Unexpected error 01551. ');

            }

        }


        $sessionMessage .= ' 90 day old messages will be deleted by admin. ';


        require VIEWS . DIRSEP . 'inbox.php';
    }
}