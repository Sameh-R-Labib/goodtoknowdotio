<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class Inbox
{
    function page()
    {
        global $db;
        global $gtk;
        global $inbox_messages_array;


        kick_out_loggedoutusers();


        $gtk->html_title = 'Inbox';


        $gtk->page = 'Inbox';


        $gtk->show_poof = true;


        $db = get_db();


        $inbox_messages_array = MessageToUser::get_array_of_message_objects_for_a_user($gtk->user_id);


        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         */

        if (!empty($inbox_messages_array)) {

            $return = MessageToUser::replace_attributes($inbox_messages_array);

            if ($return === false) {

                breakout(' Unexpected error 01551. ');

            }

        }


        $gtk->message .= ' 90 day old messages will be deleted by admin. ';


        require VIEWS . DIRSEP . 'inbox.php';
    }
}