<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/14/18
 * Time: 4:29 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;
use GoodToKnow\Models\Topic;

class NewTopicSave
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $community_id;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description
        global $saved_int01;                // The sequence number

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Create some variables and their values
         * which will be needed for the two objects
         * we'll be saving. Those two objects are
         * Topic and CommunityToTopic.
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
        $result = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $sessionMessage, $community_id);
        $sequence_number_already_exists_in_db = false;
        if ($result != false) {
            foreach ($result as $object) {
                if ($object->sequence_number == $saved_int01) {
                    $sequence_number_already_exists_in_db = true;
                    break;
                }
            }
        }

        if ($sequence_number_already_exists_in_db) {
            $sessionMessage .= " Unfortunately someone was putting a topic in the same spot while you were
            trying to do the same and they beat you to the punch. Please start over. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        // Save the new Topic
        $result = $topic->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " NewTopicSave::page says: Unexpected save was unable to save the new topic. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        // Assemble the CommunityToTopic object
        $communitytotopic_as_array = ['community_id' => $community_id, 'topic_id' => $topic->id];
        $communitytotopic = CommunityToTopic::array_to_object($communitytotopic_as_array);

        $result = $communitytotopic->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " NewTopicSave::page says: Unexpected save was unable to save the CommunityToTopic. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Save a fresh copy of special_topic_array
         */
        $_SESSION['special_topic_array'] = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
        $_SESSION['last_refresh_topics'] = time();

        // Redirect
        $sessionMessage .= " 😃 Your new topic has been created. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_str01'] = "";
        $_SESSION['saved_str02'] = "";
        redirect_to("/ax1/Home/page");
    }
}