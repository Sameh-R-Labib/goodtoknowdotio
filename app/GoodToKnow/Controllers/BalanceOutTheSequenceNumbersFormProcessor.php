<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\TopicToPost;

class BalanceOutTheSequenceNumbersFormProcessor
{
    function page()
    {
        /**
         * 1) Make sure array element $_POST["animal"] is itself an array (aka. "that array".)
         *    That array must have keys which correspond to record id fields.
         *    The value field of each element of that array must contain the submitted sequence_number value.
         *    String is the type of value of all form submits.
         * 2) Retrieve the same $result set which was retrieved in the previous route.
         * 3) Replace the sequence_number of each record in $result with its corresponding one from $_POST["animal"].
         * 4) Save $result to the session.
         * 5) Present the relevant parts of $result in a view of the type with round corners.
         * 6) Present a Save button and a Abort button.
         *    **These buttons will be link buttons instead of form submit buttons.**
         */

        global $g;


        /**
         * Preliminary things to take care of.
         */

        kick_out_nonadmins_or_if_there_is_error_msg();

        $g->thing_type = ucfirst($g->type_of_resource_requested);


        /**
         * 1) Make sure array element $_POST["animal"] is itself an array (aka. "that array".)
         *    That array must have keys which correspond to record id fields.
         *    The value field of each element of that array must contain the submitted sequence_number value.
         *    String is the type of value of all form submits.
         */

        // √s ok
        $animal_arr = $_POST["animal"];

        /**
         * 2) Retrieve the same $result set which was retrieved in the previous route.
         */

        get_db();

        if ($g->thing_type === 'Community') {

            // Get all topics for community.

            $result = CommunityToTopic::get_array_of_topic_objects_for_a_community($g->community_id);

            if (!$result) {

                breakout(' The community does not contain any topics. ');

            }

        } else {

            // Get all posts for topic.

            $result = TopicToPost::get_posts_array_for_a_topic($g->topic_id);

            if (!$result) {

                breakout(' The topic does not contain any posts. ');

            }

        }


        /**
         * 3) Replace the sequence_number of each record in $result with its corresponding one from $_POST["animal"].
         */

        foreach ($result as $object) {

            // Set the $object->sequence_number to the sequence_number found in
            // the $animal_arr element whose key is the same as the id of the object.
            $object->sequence_number = $animal_arr[$object->id];

        }


        /**
         * 4) Save $result to the session.
         */
        $_SESSION['saved_arr01'] = $result;


        /**
         * 5) Present the relevant parts of $result in a view of the type with round corners.
         */

        foreach ($result as $object) {

            if ($g->thing_type === 'Community') {

                $short = substr($object->topic_name, 0, 38);

            } else {

                $short = substr($object->title, 0, 38);

            }
            $g->present .= "<p>$object->sequence_number ↔ $short</p>\n";

        }


        /**
         * 6) Present a Save button and a Abort button.
         *    **These buttons will be link buttons instead of form submit buttons.**
         */

        $g->html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbersformprocessor.php';
    }
}