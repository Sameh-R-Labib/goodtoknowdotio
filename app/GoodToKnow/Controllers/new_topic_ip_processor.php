<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community_to_topic;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\before_after_form_field_prep;
use function \GoodToKnow\ControllerHelpers\get_sequence_number_in_case_before;
use function \GoodToKnow\ControllerHelpers\get_sequence_number_in_case_after;

class new_topic_ip_processor
{
    function page()
    {
        /**
         * At this point we know which community we're in, we know there exists at least one topic, we know
         * which topic the new topic goes next to, and we know on which side of that topic the new topic goes.
         * Submitted 'relate' and 'choice'.
         *
         * Now determine what the sequence number of the new topic will be. Store it in $_SESSION['saved_int01'].
         * Once that's done redirect to the next script.
         */

        global $g;


        kick_out_nonadmins();


        get_db();


        /**
         * Make sure we are NOT dealing with a community which has zero topics.
         * (Although the traditional way of arriving to this place should guarantee
         * this is not the case.)
         * Besides, we want a fresh copy of special_topic_array.
         */

        $g->special_topic_array = community_to_topic::get_topics_array_for_a_community($g->community_id);

        if (!$g->special_topic_array) {

            breakout(' new_topic_ip_processor says: Unexpected error 39684. ');

        }


        /**
         * At this point:
         *   We have a fresh copy of $g->special_topic_array.
         *   We know it's got at least one topic.
         *   We should have 'relate' and 'choice'
         */


        // relate

        require_once CONTROLLERHELPERS . DIRSEP . 'before_after_form_field_prep.php';

        $relate = before_after_form_field_prep('relate');


        // choice

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $g->chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (!array_key_exists($g->chosen_topic_id, $g->special_topic_array)) {

            breakout(' new_topic_ip_processor says: Error 124213. ');

        }


        // Determine the sequence number for the new topic

        $topic_objects_array = community_to_topic::get_array_of_topic_objects_for_a_community($g->community_id);

        if (!$topic_objects_array) {

            breakout(' new_topic_ip_processor says: Error 860138. ');

        }

        $chosen_topic_sequence_number = -1;

        foreach ($topic_objects_array as $object) {

            if ($object->id == $g->chosen_topic_id) $chosen_topic_sequence_number = $object->sequence_number;

        }

        if ($chosen_topic_sequence_number == -1) {

            breakout(' new_topic_ip_processor says: Error 426273. ');

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'get_sequence_number_in_case_after.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_sequence_number_in_case_before.php';

        if ($relate == 'after') {

            $sequence_number = get_sequence_number_in_case_after($topic_objects_array, $chosen_topic_sequence_number);

        } else {

            $sequence_number = get_sequence_number_in_case_before($topic_objects_array, $chosen_topic_sequence_number);

        }

        $_SESSION['saved_int01'] = (int)$sequence_number;

        redirect_to("/ax1/new_topic_name/page");
    }
}