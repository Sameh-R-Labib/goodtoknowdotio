<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class TransferPostOwnershipProcessor
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


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

        $_SESSION['saved_int01'] = $g->chosen_topic_id;


        redirect_to("/ax1/TransferPostOwnershipChoosePost/page");
    }
}