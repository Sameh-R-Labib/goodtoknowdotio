<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/30/18
 * Time: 6:28 PM
 */

namespace GoodToKnow\Controllers;


class Inbox
{
    public function page()
    {
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

        $html_title = 'Inbox';

        $show_poof = true;

        $sessionMessage .= " Older messages are automatically purged over time. Just
        focus on dealing with your messages. And, if you need to say something to a user
        who messaged you use the <em>Username Message A User</em> button above. ";

        require VIEWS . DIRSEP . 'inbox.php';
    }
}