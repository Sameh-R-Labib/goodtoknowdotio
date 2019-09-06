<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class EditMyPost
{
    function page()
    {
        /**
         * This is the first in a series of routes aimed at editing a preexisting user's post.
         */

        /**
         * This route will present a form which asks which topic does the post exist in. Remember
         * first we need to have the user identify the post. So this first step will help.
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
            breakout(' Aborted because this community has no topics. ');
        }

        $html_title = 'Which topic is your post in?';

        require VIEWS . DIRSEP . 'editmypost.php';
    }
}