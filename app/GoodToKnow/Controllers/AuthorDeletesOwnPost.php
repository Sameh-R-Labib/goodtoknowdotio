<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;


class AuthorDeletesOwnPost
{
    public function page()
    {
        /**
         * This is the first in a series of routes
         * aimed at deleting a preexisting author's
         * post (where the logged in user is the author.)
         */

        /**
         * This route will present a form which asks
         * which topic does the post exist in. Remember
         * first we need to have the user identify
         * the post. So this first step will help.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $community_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Refresh special_topic_array
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
        if ($special_topic_array == false) $special_topic_array = [];
        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        // Abort if the community doesn't have any topics yet
        if (empty($special_topic_array)) {
            $sessionMessage .= " Aborted because this community has no topics. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which topic is your post in?';

        require VIEWS . DIRSEP . 'authordeletesownpost.php';
    }
}