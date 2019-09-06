<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class CreateNewPost
{
    function page()
    {
        /**
         * This is the first of a series of routes aimed at creating a new post.
         *
         * The first task is that of presenting a form for getting the user to tell us
         * which topic the post belongs in.
         */

        global $sessionMessage;
        global $community_id;

        kick_out_loggedoutusers();


        /**
         * Refresh special_topic_array
         */

        $db = get_db();

        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

        if ($special_topic_array == false) $special_topic_array = [];

        $_SESSION['special_topic_array'] = $special_topic_array;

        $_SESSION['last_refresh_topics'] = time();

        // Abort if the community doesn't have any topics yet

        if (empty($special_topic_array)) {
            breakout(' Aborted because you can\'t create a new post in a community which has no topics. ');
        }

        $html_title = 'Which topic?';

        require VIEWS . DIRSEP . 'createnewpost.php';
    }
}