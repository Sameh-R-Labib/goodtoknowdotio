<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;
use function GoodToKnow\ControllerHelpers\before_after_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function \GoodToKnow\ControllerHelpers\get_sequence_number_in_case_before;
use function \GoodToKnow\ControllerHelpers\get_sequence_number_in_case_after;

class CreateNewPostIPProcessor
{
    function page()
    {
        /**
         * So far we know which topic the new post belongs in and the user just submitted a form letting us know
         * 'relate' and 'choice'.
         *
         * These two post variables signify the location where the user wants the new post to go. To understand what
         * I mean you need to know that the posts for a specified topic each have a sequence number. The sequence number
         * helps display the posts in a sequential order.
         *
         * Now determine what the sequence number of the new post will be. Store it in $_SESSION['$saved_int02'].
         * Once that's done redirect to the next script. The next script will move the needle forwards to our goal
         * of creating a new record in the posts table.
         */

        global $db;
        global $sessionMessage;
        global $special_post_array;
        global $saved_int01;


        kick_out_loggedoutusers();


        /**
         * Make sure we are NOT dealing with a topic which has zero
         * posts.
         */

        $db = get_db();

        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($saved_int01);

        if (!$special_post_array) {

            breakout(' CreateNewPostIPProcessor: Error 074346. ');

        }


        /**
         * Validate submitted values.
         */

        // choice

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (!array_key_exists($chosen_post_id, $special_post_array)) {

            breakout(' CreateNewPostIPProcessor: Error 421218. ');

        }

        // relate

        require_once CONTROLLERHELPERS . DIRSEP . 'before_after_form_field_prep.php';

        $relate = before_after_form_field_prep('relate');


        /**
         * I made a flowchart for the algorithm used to come up with the sequence number for the new
         * post. The code below implements that algorithm.
         */

        $all_posts_as_objects = TopicToPost::get_posts_array_for_a_topic($db, $saved_int01);

        if (!$all_posts_as_objects) {

            breakout(' CreateNewPostIPProcessor: Error 971249. ');

        }

        $chosen_post_sequence_number = -1;

        foreach ($all_posts_as_objects as $object) {

            if ($object->id == $chosen_post_id) $chosen_post_sequence_number = $object->sequence_number;

        }

        if ($chosen_post_sequence_number == -1) {

            breakout(' CreateNewPostIPProcessor: Error 537384. ');

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'get_sequence_number_in_case_after.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'get_sequence_number_in_case_before.php';

        if ($relate == 'after') {

            $sequence_number = get_sequence_number_in_case_after($all_posts_as_objects, $chosen_post_sequence_number);

        } else {

            $sequence_number = get_sequence_number_in_case_before($all_posts_as_objects, $chosen_post_sequence_number);

        }

        $_SESSION['saved_int02'] = $sequence_number;

        redirect_to("/ax1/CreateNewPostTitle/page");
    }
}