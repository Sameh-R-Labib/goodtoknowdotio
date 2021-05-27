<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\TopicToPost;

class BalanceOutTheSequenceNumbers
{
    function page()
    {
        global $db;
        global $html_title;
        global $thing_type;
        global $thing_name;
        global $thing_id;
        global $result;
        global $fields;
        global $type_of_resource_requested;
        global $community_id;
        global $community_name;
        global $topic_id;
        global $topic_name;


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
            $result = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $community_id);
            if (!$result) {
                breakout(' The community does not contain any topics. ');
            }
        } else {
            // Get all posts for topic.
            $result = TopicToPost::get_posts_array_for_a_topic($db, $topic_id);
            if (!$result) {
                breakout(' The topic does not contain any posts. ');
            }
        }

        /**
         * Now, we have $result.
         * $result is either an array of topics or an array of posts.
         * We need to put together the HTML for the form fields.
         * Each form field row will look like this:
         *   [text input for a sequence number] [The name of the topic or post]
         * When formulating each test input field we will be using a trick to
         * make the submitted form easier to process. Usually the name of the field
         * results in a post variable of the same name. For example if we have 10
         * text input fields with 10 different names we end up with 10 post variables.
         * Instead, I want us to end up with one array variable where the key for each
         * element is the id for the topic / post.
         *
         * To start off we need separate loops for our two types records (one loop will
         * be used if we are dealing with topics and another loop will be used if we are
         * dealing with posts.
         */

        $fields = '';

        if ($thing_type === 'Community') {
            // Assemble $fields for topic records. One html line for each record.
            foreach ($result as $object) {
                // $object is current record
                $fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $fields .= "<input type=\"text\" value=\"{$object->sequence_number}\"";
                $fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"9\" required > ";
                $fields .= $object->topic_name;
                $fields .= "</p>\n";
            }
        } else {
            // Assemble $fields for post records. One html line for each record.
            foreach ($result as $object) {
                // $object is current record
                $fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $fields .= "<input type=\"text\" value=\"{$object->sequence_number}\" ";
                $fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"9\" required > ";
                $fields .= $object->title;
                $fields .= "</p>\n";
            }
        }

        $html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}