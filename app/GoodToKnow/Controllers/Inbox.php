<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/30/18
 * Time: 6:28 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\MessageToUser;


class Inbox
{
    public function page()
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
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Inbox';

        $show_poof = true;

        $inbox_messages_array = MessageToUser::get_array_of_message_objects_for_a_user($db, $sessionMessage, $user_id);

        $sessionMessage .= " Old messages self-purge. Use \"U/N 📧 👲\" to respond to messages. ";

        require VIEWS . DIRSEP . 'inbox.php';
    }
}