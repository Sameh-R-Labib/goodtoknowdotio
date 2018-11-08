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

        if (!$is_logged_in || !empty($sessionMessage)) {
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
        $chosen_topic_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : null;

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

        $topic_objects_array = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $sessionMessage, $community_id);

        if (!$topic_objects_array) {
            $sessionMessage .= " NewTopicIPProcessor::page says: Error 860138. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $chosen_topic_sequence_number = -1;
        foreach ($topic_objects_array as $key => $object) {
            if ($object->id == $chosen_topic_id) $chosen_topic_sequence_number = $object->sequence_number;
        }
        if ($chosen_topic_sequence_number == -1) {
            $sessionMessage .= " NewTopicIPProcessor::page says: Error 426273. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($relate == 'after') {
            $sequence_number = self::get_sequence_number_in_case_after($topic_objects_array, $chosen_topic_sequence_number);
        } else {
            $sequence_number = self::get_sequence_number_in_case_before($topic_objects_array, $chosen_topic_sequence_number);
        }

        $_SESSION['saved_int01'] = $sequence_number;
        redirect_to("/ax1/NewTopicName/page");
    }

    /**
     * @param array $topic_objects_array
     * @param int $chosen_topic_sequence_number
     * @return int
     */
    public static function get_sequence_number_in_case_after(array $topic_objects_array, int $chosen_topic_sequence_number)
    {
        if ($chosen_topic_sequence_number == 1000000) {
            $_SESSION['message'] = " Choose another place to put the topic. ";
            redirect_to("/ax1/Home/page");
        }

        $found_a_topic_with_higher_sequence_number = false;
        foreach ($topic_objects_array as $key => $object) {
            if ($object->sequence_number > $chosen_topic_sequence_number) {
                $found_a_topic_with_higher_sequence_number = true;
                break;
            }
        }
        if (!$found_a_topic_with_higher_sequence_number) {
            return 1000000;
        }

        foreach ($topic_objects_array as $key => $object) {
            if ($object->sequence_number > $chosen_topic_sequence_number) {
                $following_topic_sequence_number = $object->sequence_number;
                break;
            }
        }

        if (empty($following_topic_sequence_number)) {
            $_SESSION['message'] = " NewTopicIPProcessor::get_sequence_number_in_case_after says Error 563506. ";
            redirect_to("/ax1/Home/page");
        }

        $difference = $following_topic_sequence_number - $chosen_topic_sequence_number;

        if (($difference) < 2) {
            $_SESSION['message'] = " Please choose another place to put the topic. ";
            redirect_to("/ax1/Home/page");
        }

        $increase = intdiv($difference, 2);

        return $chosen_topic_sequence_number + $increase;
    }

    /**
     * @param array $topic_objects_array
     * @param int $chosen_topic_sequence_number
     * @return int
     */
    public static function get_sequence_number_in_case_before(array $topic_objects_array, int $chosen_topic_sequence_number)
    {
        if ($chosen_topic_sequence_number == 0) {
            $_SESSION['message'] = " Please choose another place to put the topic. ";
            redirect_to("/ax1/Home/page");
        }

        $found_a_topic_with_lower_sequence_number = false;
        foreach ($topic_objects_array as $key => $object) {
            if ($object->sequence_number < $chosen_topic_sequence_number) {
                $found_a_topic_with_lower_sequence_number = true;
                break;
            }
        }
        if (!$found_a_topic_with_lower_sequence_number) {
            return 0;
        }

        $reversed = array_reverse($topic_objects_array);

        foreach ($reversed as $key => $object) {
            if ($object->sequence_number < $chosen_topic_sequence_number) {
                $leading_topic_sequence_number = $object->sequence_number;
                break;
            }
        }

        $difference = $chosen_topic_sequence_number - $leading_topic_sequence_number;

        if (($difference) < 2) {
            $_SESSION['message'] = " Please choose another place to put the topic. ";
            redirect_to("/ax1/Home/page");
        }

        $decrease = intdiv($difference, 2);

        return $chosen_topic_sequence_number - $decrease;
    }
}