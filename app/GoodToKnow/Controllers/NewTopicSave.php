<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/14/18
 * Time: 4:29 PM
 */

namespace GoodToKnow\Controllers;


class NewTopicSave
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $community_id;
        global $saved_str01;                // The topic name
        global $saved_str02;                // The topic description
        global $saved_int01;                // The sequence number

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
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
    }
}