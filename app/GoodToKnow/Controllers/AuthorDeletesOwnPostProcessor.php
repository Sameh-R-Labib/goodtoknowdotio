<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class AuthorDeletesOwnPostProcessor
{
    function page()
    {
        global $special_topic_array;
        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * We should have a post variable called choice whose value is the topic id for the topic the user intends
         * to delete a post from.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


        /**
         * Make sure $chosen_topic_id is among the ids of $special_topic_array
         */

        if (!array_key_exists($chosen_topic_id, $special_topic_array)) {

            breakout(' Unexpected error: topic id not found in topic array. ');

        }


        /**
         * Save it in the session
         */

        $_SESSION['saved_int01'] = $chosen_topic_id;

        redirect_to("/ax1/AuthorDeletesOwnPostChoosePost/page");
    }
}