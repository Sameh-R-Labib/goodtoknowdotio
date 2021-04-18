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
         * 5) Present all the contents of $result in the view (which will be the type of view with round corners.)
         *    The records should and will be in order by sequence_number.
         * 6) Present a Save button and a Cancel button.
         *    **These buttons will be link buttons instead of form submit buttons.**
         */

        global $thing_type;
        global $html_title;
        global $is_admin;
        global $is_logged_in;;
        global $sessionMessage;
        global $type_of_resource_requested;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;

        /**
         * Preliminary things to take care of.
         */

        kick_out_nonadmins();

        $thing_type = ucfirst($type_of_resource_requested);

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
         * 3) Replace the sequence_number of each record in $result with its corresponding one from $_POST["animal"].
         */

        /**
         * Debug Code
         */
        echo "\n<p>Before</p>\n";
        echo "<p>Var_dump \$animal_arr: </p>\n<pre>";
        var_dump($animal_arr);
        echo "</pre>\n";
        echo "<p>Print_r \$result: </p>\n<pre>";
        print_r($result);
        echo "</pre>\n";

        foreach ($result as $object) {
            // Set the $object->sequence_number to the sequence_number found in
            // the $animal_arr element whose key is the same as the id of the object.
            $object->sequence_number = $animal_arr[$object->id];
        }

        /**
         * Debug Code
         */
        echo "\n<p>After</p>\n";
        echo "<p>Var_dump \$animal_arr: </p>\n<pre>";
        var_dump($animal_arr);
        echo "</pre>\n";
        echo "<p>Print_r \$result: </p>\n<pre>";
        print_r($result);
        echo "</pre>\n";
        die("<p>End debug</p>\n");

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbersformprocessor.php';
    }
}