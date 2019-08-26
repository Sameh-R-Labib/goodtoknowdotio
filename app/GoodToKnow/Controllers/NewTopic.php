<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class NewTopic
{
    function page()
    {
        /**
         * We need to determine whether or not the community has any topics.
         * If it has no topics then we assign the sequence number for the new topic
         * a value of 10500000 and redirect to where we ask for the name of the topic.
         * If the community has one or more topics then we redirect to where we as for the
         * insertion point.
         */

        global $community_id;
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        $db = get_db();

        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);

        if ($special_topic_array == false) $special_topic_array = [];

        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        if (sizeof($special_topic_array) > 0) {
            $is_empty = false;
        } else {
            $is_empty = true;
        }

        if ($is_empty) {
            $_SESSION['saved_int01'] = 10500000;
            redirect_to("/ax1/NewTopicName/page");
        } else {
            redirect_to("/ax1/NewTopicInsertPoint/page");
        }
    }
}