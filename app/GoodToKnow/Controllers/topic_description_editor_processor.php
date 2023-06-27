<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class topic_description_editor_processor
{
    function page(int $id = 0)
    {
        /**
         * Essentially what this function will do is it will process the form where Admin
         * chose the topic which he wants to edit the description of. The name of the submitted
         * selection is 'choice'. And its value is the id of the topic selected by Admin.
         *
         * So what this function will do is:
         *  1) Validate the submission.
         *  2) Save the topic id in the session.
         *  3) Save the topic name in the session (we know what that is from the $g->special_topic_array.)
         *  4) Redirect to a function which will bring up the editor for the description.
         */


        global $g;


        kick_out_nonadmins();


        $g->id = $id;


        /**
         * 1) Validate the submission.
         */


        if (!is_int($g->id) or $g->id < 1) {

            breakout(' Error 12223: Topic id is either not int or is negative int. ');

        }


        // Make sure $g->id is among the ids of $g->special_topic_array

        if (!array_key_exists($g->id, $g->special_topic_array)) {

            breakout(' I encountered an unexpected error namely the topic id was not found in topic array. ');

        }


        /**
         * 2) Save the topic id in the session.
         */

        $_SESSION['saved_int01'] = $g->id;


        /**
         * 3) Save the topic name in the session (we know what that is from the $g->special_topic_array.)
         */

        $_SESSION['saved_str01'] = $g->special_topic_array[$g->id];


        /**
         * 4) Redirect to a function which will bring up the editor for the description.
         */

        redirect_to("/ax1/topic_description_editor_form/page");
    }
}