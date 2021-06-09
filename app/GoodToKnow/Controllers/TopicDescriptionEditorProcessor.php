<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class TopicDescriptionEditorProcessor
{
    function page()
    {
        /**
         * Essentially what this function will do is it will process the form where the admin
         * chose the topic which he wants to edit the description of. The name of the submitted
         * selection is 'choice'. And its value is the id of the topic selected by the admin.
         *
         * So what this function will do is:
         *  1) Validate the submission.
         *  2) Save the topic id in the session.
         *  3) Save the topic name in the session (we know what that is from the $g->special_topic_array.)
         *  4) Redirect to a function which will bring up the editor for the description.
         */


        global $g;


        kick_out_nonadmins();


        /**
         * 1) Validate the submission.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $g->chosen_topic_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);


        // Make sure $g->chosen_topic_id is among the ids of $g->special_topic_array

        if (!array_key_exists($g->chosen_topic_id, $g->special_topic_array)) {

            breakout(' I\'ve encountered an unexpected error namely the topic id was not found in topic array. ');

        }


        /**
         * 2) Save the topic id in the session.
         */

        $_SESSION['saved_int01'] = $g->chosen_topic_id;


        /**
         * 3) Save the topic name in the session (we know what that is from the $g->special_topic_array.)
         */

        $_SESSION['saved_str01'] = $g->special_topic_array[$g->chosen_topic_id];


        /**
         * 4) Redirect to a function which will bring up the editor for the description.
         */

        redirect_to("/ax1/TopicDescriptionEditorForm/page");
    }
}