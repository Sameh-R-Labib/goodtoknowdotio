<?php


namespace GoodToKnow\Controllers;


class BalanceOutTheSequenceNumbers
{
    function page()
    {
        global $html_title;
        global $thing_type;
        global $thing_name;
        global $thing_id;
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

        $thing_type = $type_of_resource_requested;

        if ($thing_type === 'community') {
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

        // Already, we have a special array which contains the id and name corresponding to each record.
        // However, we're only interested in the ids of each record.
        // We'll use the ids to help us retrieve the record objects from the database.

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}