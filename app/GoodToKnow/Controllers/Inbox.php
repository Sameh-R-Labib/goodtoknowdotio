<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\message_to_user;

class inbox
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'inbox';


        $g->page = 'inbox';


        $g->show_poof = true;


        get_db();


        $g->inbox_messages_array = message_to_user::get_array_of_message_objects_for_a_user($g->user_id);


        /**
         * Replace (in each message) the user_id and created with a username and a datetime.
         */

        if (!empty($g->inbox_messages_array)) {

            $return = message_to_user::replace_attributes($g->inbox_messages_array);

            if ($return === false) {

                breakout(' Unexpected error 01551. ');

            }

        }


        $g->message .= ' 90 day old messages will be deleted by admin. ';


        require VIEWS . DIRSEP . 'inbox.php';
    }
}