<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/9/18
 * Time: 2:53 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;

class NewTopicIPProcessor
{
    public function page()
    {
        /**
         * At this point we know which community we're in,
         * we know there exists at least one topic, we know
         * which topic the new topic goes next to, and we know
         * on which side of that topic the new topic goes.
         * $_POST[relate] and $_POST[choice]
         *
         * Now determine what the sequence number of the new topic
         * will be. Store it in $_SESSION['$saved_int01'].
         * Once that's done redirect to the next script.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $community_id;

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
         * Make sure we are NOT dealing with a community which has zero topics.
         * (Although the traditional way of arriving to this place should guarantee
         * this is not the case.)
         * Besides, we want a fresh copy of special_topic_array.
         */
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
        if (!$special_topic_array) {
            $sessionMessage .= " NewTopicIPProcessor::page says: Unexpected error 39684. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * At this point:
         *   We have a fresh copy of $special_topic_array.
         *   We know it's got at least one topic.
         *   We should have $_POST[relate] and $_POST[choice]
         */

        /**
         * I can't assume these post variables exist so I do the following.
         */
        $relate = (isset($_POST['relate'])) ? $_POST['relate'] : null;
        $chosen_topic_id = (isset($_POST['choice'])) ? $_POST['choice'] : null;

        // Handle bad submit.
        if (empty($relate) || empty($chosen_topic_id)) {
            $sessionMessage .= " Either you did not fill out all the fields or the session expired. Try again. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($relate !== 'before' && $relate !== 'after') {
            $sessionMessage .= " NewTopicIPProcessor::page says: Error 99885. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!array_key_exists($chosen_topic_id, $special_topic_array)) {
            $sessionMessage .= " NewTopicIPProcessor::page says: Error 124213. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Determine the sequence number for the new topic

//        $topic_objects_array = ;
    }
}