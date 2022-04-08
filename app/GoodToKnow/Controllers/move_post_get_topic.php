<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic_to_post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class move_post_get_topic
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get submitted topic id.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (!array_key_exists($chosen_topic_id, $g->special_topic_array)) {

            breakout(' 🚷 This should never happen: Topic id not found in topic array. ');

        }


        /**
         * Make sure Admin didn't make a foolish mistake
         * by attempting to assign the same topic.
         */

        if ($g->topic_id == $chosen_topic_id) {

            breakout(' 🚷 You messed up: you tried to reassign the original topic. ');
        }


        /**
         * The database has a topic_to_post record which associates the old topic to the post.
         *   - $g->topic_id is the old topic.
         *   - $g->saved_int01 is the post id.
         * So, what needs to happen is:
         *   + Delete that record.
         *   + Create a new record using topic id $chosen_topic_id and post id $g->saved_int01.
         */

        // Firstly: Create a new record using topic id $chosen_topic_id and post id $g->saved_int01.

        $topictopost_as_array = ['topic_id' => $chosen_topic_id, 'post_id' => $g->saved_int01];

        $topictopost = topic_to_post::array_to_object($topictopost_as_array);

        $result = $topictopost->save();

        if (!$result) {

            breakout(' move_post_get_topic: Unexpected save was unable to save the topic_to_post. ');

        }

        // Secondly: Delete the old record. The old record has topic id $g->topic_id and post id $g->saved_int01.

        $sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $g->db->real_escape_string((string)$g->topic_id) . '" AND `post_id` = "' .
            $g->db->real_escape_string((string)$g->saved_int01) . '" LIMIT 1';

        $array_of_objects = topic_to_post::find_by_sql($sql);

        if (!$array_of_objects) {

            breakout(' move_post_get_topic: Unexpectedly failed to get a topic_to_post object to delete. ');

        }

        $topictopost_object = array_shift($array_of_objects);

        if (!is_object($topictopost_object)) {

            breakout(' move_post_get_topic: Unexpectedly return value is not an object. ');

        }

        $topictopost_object = array_shift($array_of_objects);

        if (!is_object($topictopost_object)) {

            breakout(' move_post_get_topic: Unexpectedly return value is not an object. ');

        }

        $result = $topictopost_object->delete();

        if (!$result) {

            breakout(' move_post_get_topic: Unexpectedly could not delete the topic_to_post object. ');

        }


        /**
         * Hooray!
         */

        breakout(' I moved the post to another topic. ');
    }
}