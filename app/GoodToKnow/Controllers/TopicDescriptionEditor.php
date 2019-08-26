<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;

class TopicDescriptionEditor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $community_id;

        kick_out_nonadmins();


        /**
         * Present a form which collects the topic's id. The topics presented for the user to choose from are the
         * ones found in the user's current community.
         */


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
            breakout(' Aborted because you can\'t create a post in a community which has no topics. ');
        }

        $html_title = "Topic's Description Editor";

        require VIEWS . DIRSEP . 'topicdescriptioneditor.php';
    }
}