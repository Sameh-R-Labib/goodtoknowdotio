<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\TopicToPost;

class BalanceOutTheSequenceNumbers
{
    function page()
    {
        global $html_title;
        global $thing_type;
        global $thing_name;
        global $thing_id;
        global $result;
        global $is_admin;
        global $is_logged_in;
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;
        global $special_topic_array;
        global $special_post_array;

        kick_out_nonadmins();

        /**
         * The "thing" whose sequence numbers will be getting balanced.
         * In the bigger picture "thing" will be determined by what's current for user's session.
         * Thing can be a 'community', 'topic' or 'post'.
         *
         * Here we establish the "thing".
         * Error out if the thing is a post.
         */

        if ($type_of_resource_requested === 'post') {
            breakout(' It is not possible to run this operation on a post. ');
        }

        $thing_type = ucfirst($type_of_resource_requested);

        if ($thing_type === 'Community') {
            $thing_name = $community_name;
            $thing_id = $community_id;
        } else {
            $thing_name = $topic_name;
            $thing_id = $topic_id;
        }

        /**
         * Retrieve all records which "thing" holds.
         * If thing is a community then it holds topic records.
         * If thing is a topic then it holds post records.
         */

        $db = get_db();

        if ($thing_type === 'Community') {
            // Get all topics for community.
            $result = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $sessionMessage, $community_id);
            if (!$result) {
                breakout(' The community does not contain any topics. ');
            }
        } else {
            // Get all posts for topic.
            $result = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);
            if (!$result) {
                breakout(' The topic does not contain any posts. ');
            }
        }

        /**
         * foreach ($result as $key => $object) {
         * if ($object->id == $chosen_topic_id) $chosen_topic_sequence_number = $object->sequence_number;
         * } **/

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}