<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\MessageToUser;

class Inbox
{
    function page()
    {
        global $user_id;
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $special_community_array;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;
        global $post_id;
        global $post_name;
        global $type_of_resource_requested;
        global $author_username;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $html_title = 'Inbox';

        $page = 'Inbox';

        $show_poof = true;

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

        $sessionMessage .= ' Old messages self-purge. Use "U/N 📧 👲" to respond to messages. ';

        require VIEWS . DIRSEP . 'inbox.php';
    }
}