<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community_to_topic;
use GoodToKnow\Models\topic;

class new_topic_save
{
    function page()
    {
        global $g;
        // $g->saved_str01 the topic name
        // $g->saved_str02 the topic description
        // $g->saved_int01 the sequence number


        kick_out_nonadmins();


        /**
         * Create some variables and their values which will be needed for the two objects
         * we'll be saving. Those two objects are topic and community_to_topic.
         *
         * topic $fields = ['id', 'sequence_number', 'topic_name', 'topic_description']
         * community_to_topic $fields = ['id', 'community_id', 'topic_id']
         */

        $topic_as_array = ['sequence_number' => $g->saved_int01, 'topic_name' => $g->saved_str01,
            'topic_description' => $g->saved_str02];

        $topic = topic::array_to_object($topic_as_array);


        // Verify that our sequence number hasn't been taken.

        /**
         * Get all the topics in out community.
         */

        get_db();

        $result = community_to_topic::get_array_of_topic_objects_for_a_community($g->community_id);

        $sequence_number_already_exists_in_db = false;

        if ($result != false) {

            foreach ($result as $object) {

                $a = (int)$object->sequence_number;

                if ($a == (int)$g->saved_int01) {

                    $sequence_number_already_exists_in_db = true;
                    break;

                }
            }
        }

        if ($sequence_number_already_exists_in_db) {

            breakout(' Unfortunately someone was putting a topic in the same spot while you were
            trying to do the same and they beat you to the punch. Please start over. ');

        }


        // Save the new topic

        $result = $topic->save();

        if (!$result) {

            breakout(' new_topic_save says: Unexpected save was unable to save the new topic. ');

        }


        // Assemble the community_to_topic object

        $communitytotopic_as_array = ['community_id' => $g->community_id, 'topic_id' => $topic->id];

        $communitytotopic = community_to_topic::array_to_object($communitytotopic_as_array);

        $result = $communitytotopic->save();

        if (!$result) {

            breakout(' new_topic_save says: Unexpected save was unable to save the community_to_topic. ');

        }


        /**
         * Save a fresh copy of special_topic_array
         */

        $_SESSION['special_topic_array'] = community_to_topic::get_topics_array_for_a_community($g->community_id);

        $_SESSION['last_refresh_topics'] = time();


        // Redirect

        breakout(' Your new topic has been created 💫✨. ');
    }
}