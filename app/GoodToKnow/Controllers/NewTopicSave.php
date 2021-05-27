<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Topic;

class NewTopicSave
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $community_id;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description
        global $saved_int01;                // The sequence number


        kick_out_nonadmins();


        /**
         * Create some variables and their values which will be needed for the two objects
         * we'll be saving. Those two objects are Topic and CommunityToTopic.
         *
         * Topic $fields = ['id', 'sequence_number', 'topic_name', 'topic_description']
         * CommunityToTopic $fields = ['id', 'community_id', 'topic_id']
         */

        $topic_as_array = ['sequence_number' => $saved_int01, 'topic_name' => $saved_str01,
            'topic_description' => $saved_str02];

        $topic = Topic::array_to_object($topic_as_array);


        // Verify that our sequence number hasn't been taken.

        /**
         * Get all the topics in out community.
         */

        $db = get_db();

        $result = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $community_id);

        $sequence_number_already_exists_in_db = false;

        if ($result != false) {

            foreach ($result as $object) {

                $a = (int)$object->sequence_number;

                if ($a == (int)$saved_int01) {

                    $sequence_number_already_exists_in_db = true;
                    break;

                }
            }
        }

        if ($sequence_number_already_exists_in_db) {

            breakout(' Unfortunately someone was putting a topic in the same spot while you were
            trying to do the same and they beat you to the punch. Please start over. ');

        }


        // Save the new Topic

        $result = $topic->save($db);

        if (!$result) {

            breakout(' NewTopicSave says: Unexpected save was unable to save the new topic. ');

        }


        // Assemble the CommunityToTopic object

        $communitytotopic_as_array = ['community_id' => $community_id, 'topic_id' => $topic->id];

        $communitytotopic = CommunityToTopic::array_to_object($communitytotopic_as_array);

        $result = $communitytotopic->save($db);

        if (!$result) {

            breakout(' NewTopicSave says: Unexpected save was unable to save the CommunityToTopic. ');

        }


        /**
         * Save a fresh copy of special_topic_array
         */

        $_SESSION['special_topic_array'] = CommunityToTopic::get_topics_array_for_a_community($db, $community_id);

        $_SESSION['last_refresh_topics'] = time();


        // Redirect

        breakout(' Your new topic has been created 💫✨. ');
    }
}