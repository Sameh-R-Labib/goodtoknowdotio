<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class CreateNewPostIPProcessor
{
    function page()
    {
        /**
         * So far we know which topic the new post belongs in and the user just submitted a form letting us know
         * $_POST[relate] and $_POST[choice].
         *
         * These two post variables signify the location where the user wants the new post to go. To understand what
         * I mean you need to know that the posts for a specified topic each have a sequence number. The sequence number
         * helps display the posts in a sequential order.
         *
         * Now determine what the sequence number of the new post will be. Store it in $_SESSION['$saved_int02'].
         * Once that's done redirect to the next script. The next script will move the needle forwards to our goal
         * of creating a new record in the posts table.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $special_post_array;
        global $saved_int01;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * Make sure we are NOT dealing with a topic which has zero
         * posts.
         */

        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);

        if (!$special_post_array) {
            breakout(' CreateNewPostIPProcessor: Error 074346. ');
        }


        /**
         * Validate submitted values.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_post_id)) {
            breakout(' Your choice did not pass validation. ');
        }

        $relate = (isset($_POST['relate'])) ? $_POST['relate'] : null;

        if (empty($relate)) {
            breakout(' Try again because something went wrong. ');
        }

        if ($relate !== 'before' && $relate !== 'after') {
            breakout(' CreateNewPostIPProcessor: Error 034455. ');
        }

        if (!array_key_exists($chosen_post_id, $special_post_array)) {
            breakout(' CreateNewPostIPProcessor: Error 421218. ');
        }


        /**
         * I made a flowchart for the algorithm used to come up with the sequence number for the new
         * post. The code below implements that algorithm.
         */

        $all_posts_as_objects = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);

        if (!$all_posts_as_objects) {
            breakout(' CreateNewPostIPProcessor: Error 971249. ');
        }

        $chosen_post_sequence_number = -1;

        foreach ($all_posts_as_objects as $key => $object) {
            if ($object->id == $chosen_post_id) $chosen_post_sequence_number = $object->sequence_number;
        }

        if ($chosen_post_sequence_number == -1) {
            breakout(' CreateNewPostIPProcessor: Error 537384. ');
        }

        if ($relate == 'after') {
            $sequence_number = self::get_sequence_number_in_case_after($all_posts_as_objects, $chosen_post_sequence_number);
        } else {
            $sequence_number = self::get_sequence_number_in_case_before($all_posts_as_objects, $chosen_post_sequence_number);
        }

        $_SESSION['saved_int02'] = $sequence_number;

        redirect_to("/ax1/CreateNewPostTitle/page");
    }


    /**
     * @param array $all_posts_as_objects
     * @param int $chosen_post_sequence_number
     * @return int
     */

    public static function get_sequence_number_in_case_after(array $all_posts_as_objects, int $chosen_post_sequence_number)
    {
        if ($chosen_post_sequence_number == 21000000) {
            breakout(' Please choose another place to put the post. ');
        }


        /**
         * What it does:
         *  It takes an array of posts belonging to a single topic.
         *  It takes the sequence number from the chosen post.
         *  It assumes the user wants to put the new post after the chosen post.
         *  It returns the sequence number which the new post should have.
         */

        /**
         * If there are no posts which have a sequence number higher than the sequence number of the chosen post then we
         * will return 21000000 as the sequence number.
         */

        $found_a_post_with_higher_sequence_number = false;

        foreach ($all_posts_as_objects as $key => $object) {
            if ($object->sequence_number > $chosen_post_sequence_number) {
                $found_a_post_with_higher_sequence_number = true;
                break;
            }
        }

        if (!$found_a_post_with_higher_sequence_number) {
            $following_post_sequence_number = 21000000;
        } else {
            foreach ($all_posts_as_objects as $key => $object) {

                if ($object->sequence_number > $chosen_post_sequence_number) {

                    $following_post_sequence_number = $object->sequence_number;
                    break;
                }
            }
        }

        if (empty($following_post_sequence_number)) {
            breakout(' CreateNewPostIPProcessor::get_sequence_number_in_case_after says Error 764516. ');
        }

        $difference = $following_post_sequence_number - $chosen_post_sequence_number;

        if (($difference) < 2) {
            breakout(' Please choose another place to put the post. ');
        }

        $increase = intdiv($difference, 2);

        return $chosen_post_sequence_number + $increase;
    }


    /**
     * @param array $all_posts_as_objects
     * @param int $chosen_post_sequence_number
     * @return int
     */
    public static function get_sequence_number_in_case_before(array $all_posts_as_objects, int $chosen_post_sequence_number)
    {
        if ($chosen_post_sequence_number == 0) {
            breakout(' Please choose another place to put the post. ');
        }

        $found_a_post_with_lower_sequence_number = false;

        foreach ($all_posts_as_objects as $key => $object) {

            if ($object->sequence_number < $chosen_post_sequence_number) {

                $found_a_post_with_lower_sequence_number = true;
                break;

            }

        }

        if (!$found_a_post_with_lower_sequence_number) {
            $leading_post_sequence_number = 0;
        } else {
            $reversed = array_reverse($all_posts_as_objects);

            foreach ($reversed as $key => $object) {

                if ($object->sequence_number < $chosen_post_sequence_number) {

                    $leading_post_sequence_number = $object->sequence_number;
                    break;

                }

            }
        }

        $difference = $chosen_post_sequence_number - $leading_post_sequence_number;

        if (($difference) < 2) {
            breakout(' Please choose another place to put the post. ');
        }

        $decrease = intdiv($difference, 2);

        return $chosen_post_sequence_number - $decrease;
    }
}