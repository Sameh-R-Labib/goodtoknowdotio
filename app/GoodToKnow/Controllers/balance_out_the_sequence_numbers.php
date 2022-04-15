<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community_to_topic;
use GoodToKnow\Models\topic_to_post;

class balance_out_the_sequence_numbers
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * The "thing" whose sequence numbers will be getting balanced.
         * In the bigger picture "thing" will be determined by what's current for user's session.
         * Thing can be a 'community', 'topic' or 'post'.
         *
         * Here we establish the "thing".
         * Error out if the thing is a post.
         */

        if ($g->type_of_resource_requested === 'post') {

            breakout(' It is not possible to run this operation on a post. ');

        }

        /*$g->thing_type = ucfirst($g->type_of_resource_requested);*/

        if ($g->thing_type === 'community') {

            $g->thing_name = $g->community_name;

        } else {

            $g->thing_name = $g->topic_name;

        }

        /**
         * Retrieve all records which "thing" holds.
         * If thing is a community then it holds topic records.
         * If thing is a topic then it holds post records.
         */

        get_db();

        if ($g->thing_type === 'community') {

            // Get all topics for community.

            $g->result = community_to_topic::get_array_of_topic_objects_for_a_community($g->community_id);

            if (!$g->result) {

                breakout(' The community does not contain any topics. ');

            }

        } else {

            // Get all posts for topic.

            $g->result = topic_to_post::get_posts_array_for_a_topic($g->topic_id);

            if (!$g->result) {

                breakout(' The topic does not contain any posts. ');

            }

        }

        /**
         * Now, we have $g->result.
         * $g->result is either an array of topics or an array of posts.
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

        if ($g->thing_type === 'community') {

            // Assemble $g->fields for topic records. One html line for each record.
            foreach ($g->result as $object) {

                // $object is current record
                $g->fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $g->fields .= "<input type=\"text\" value=\"{$object->sequence_number}\"";
                $g->fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"9\" required > ";
                $g->fields .= $object->topic_name;
                $g->fields .= "</p>\n";

            }
        } else {

            // Assemble $g->fields for post records. One html line for each record.
            foreach ($g->result as $object) {
                // $object is current record
                $g->fields .= "<p><label for=\"animal{$object->id}\"><b>⇰</b> </label>\n";
                $g->fields .= "<input type=\"text\" value=\"{$object->sequence_number}\" ";
                $g->fields .= "name=\"animal[{$object->id}]\" id=\"animal{$object->id}\" size=\"9\" required > ";
                $g->fields .= $object->title;
                $g->fields .= "</p>\n";

            }
        }

        $g->html_title = 'Balance Out The Sequence Numbers';

        require VIEWS . DIRSEP . 'balanceoutthesequencenumbers.php';
    }
}