<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class NewTopicInsertPoint
{
    function page()
    {
        /**
         * The goal is to present a form for specifying the location for inserting the new topic.
         *
         * The user answers two questions:
         *  1) Before or After?
         *  2) Which topic?
         *
         * Note: Here it is assumed there is at least one topic in the community.
         * Otherwise, this route will have had been skipped.
         */

        global $community_id;
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Refresh special_topic_array
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

        if ($special_topic_array == false) $special_topic_array = [];

        $_SESSION['special_topic_array'] = $special_topic_array;

        $_SESSION['last_refresh_topics'] = time();

        $html_title = 'Where will the new topic go?';

        require VIEWS . DIRSEP . 'newtopicinsertpoint.php';
    }
}