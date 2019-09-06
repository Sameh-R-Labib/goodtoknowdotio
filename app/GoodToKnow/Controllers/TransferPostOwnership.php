<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class TransferPostOwnership
{
    function page()
    {
        /**
         * This is the first route for transferring ownership of a post.
         *
         * It's goal is to be the first in a bunch of routes to determine which post is to be deleted.
         *
         * It will present radio buttons for choosing which topic the post is in. It will also describe what is being done.
         *
         * As usual the topics presented are the topics in the current community.
         */

        global $sessionMessage;
        global $community_id;

        kick_out_nonadmins();


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

        $html_title = 'Which topic is the post in?';

        require VIEWS . DIRSEP . 'transferpostownership.php';
    }
}