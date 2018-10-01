<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/30/18
 * Time: 3:22 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;


class CreateNewPostIPProcessor
{
    public function page()
    {
        /**
         * So far we know which topic the new post belongs in
         * and the user just submitted a form letting us know
         * $_POST[relate] and $_POST[choice].
         *
         * These two post variables signify the location where
         * the user wants the new post to go. To understand what
         * I mean you need to know that the posts for a specified
         * topic each have a sequence number. The sequence number
         * helps display the posts in a sequential order.
         *
         * Now determine what the sequence number of the new post
         * will be. Store it in $_SESSION['$saved_int02'].
         * Once that's done redirect to the next script. The next
         * script will move the needle forwards to our goal
         * of creating a new record in the posts table.
         */
        global $is_logged_in;
        global $sessionMessage;
        global $special_post_array;
        global $saved_int01;

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
         * Make sure we are NOT dealing with a topic which has zero
         * posts.
         */
        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);
        if (!$special_post_array) {
            $sessionMessage .= " CreateNewPostIPProcessor: Error 074346. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * I can't assume these post variables exist so I do the following.
         */
        $relate = (isset($_POST['relate'])) ? $_POST['relate'] : null;
        $chosen_post_id = (isset($_POST['choice'])) ? $_POST['choice'] : null;

        // Handle bad submit.
        if (empty($relate) || empty($chosen_post_id)) {
            $sessionMessage .= " Either you did not fill out all the fields or the session expired. Try again. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($relate !== 'before' && $relate !== 'after') {
            $sessionMessage .= " CreateNewPostIPProcessor: Error 034455. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!array_key_exists($chosen_post_id, $special_post_array)) {
            $sessionMessage .= " CreateNewPostIPProcessor: Error 421218. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * I made a flowchart for the algorithm used to
         * come up with the sequence number for the new
         * post. The code below implements that algorithm.
         */

        /**
         * Figure out the sequence number of chosen post.
         * Chosen post is the post the user chose in the form.
         * We know its id but we need its sequence number.
         */
        $all_posts_as_objects = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);
        if (!$all_posts_as_objects) {
            $sessionMessage .= " CreateNewPostIPProcessor: Error 971249. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $chosen_post_sequence_number = -1;
        foreach ($all_posts_as_objects as $key => $object) {
            if ($object->id == $chosen_post_id) $chosen_post_sequence_number = $object->sequence_number;
        }
        if ($chosen_post_sequence_number == -1) {
            $sessionMessage .= " CreateNewPostIPProcessor: Error 537384. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($relate == 'after') {
            $sequence_number = self::get_sequence_number_in_case_after($all_posts_as_objects, $chosen_post_sequence_number);
        } else {
            $sequence_number = self::get_sequence_number_in_case_before();
        }
    }


    public static function get_sequence_number_in_case_after(array $all_posts_as_objects, int $chosen_post_sequence_number)
    {
        /**
         * If there are no posts which have a sequence number higher
         * than the sequence number of the chosen post then we will
         * assign $following_post_sequence_number the value 1000000.
         */
        $found_a_post_with_higher_sequence_number = false;
        foreach ($all_posts_as_objects as $key => $object) {
            if ($object->sequence_number > $chosen_post_sequence_number) {
                $found_a_post_with_higher_sequence_number = true;
            }
        }
        if (!$found_a_post_with_higher_sequence_number) {
            $following_post_sequence_number = 1000000;
        }

        /**
         * I need to order the posts by sequence number.
         */
        TopicToPost::order_posts_by_sequence_number($all_posts_as_objects);

    }
}