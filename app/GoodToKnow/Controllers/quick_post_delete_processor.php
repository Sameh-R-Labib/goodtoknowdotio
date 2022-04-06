<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class quick_post_delete_processor
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $g->chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


        /**
         * Make sure $g->chosen_topic_id is among the ids of $g->special_topic_array
         */

        if (!array_key_exists($g->chosen_topic_id, $g->special_topic_array)) {

            breakout(' Unexpected error: topic id not found in topic array. ');

        }


        /**
         * Save it in the session
         */

        $_SESSION['saved_int01'] = (int)$g->chosen_topic_id;


        redirect_to("/ax1/quick_post_delete_choose_post/page");
    }
}