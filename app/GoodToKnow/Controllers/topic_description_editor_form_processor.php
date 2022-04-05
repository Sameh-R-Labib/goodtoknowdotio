<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class topic_description_editor_form_processor
{
    function page()
    {
        global $g;
        // $g->saved_str01 the topic's name
        // $g->saved_int01 the topic's id


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         *  Read submitted data.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $topic_name = standard_form_field_prep('topic_name', 1, 200);

        $topic_description = standard_form_field_prep('topic_description', 1, 230);


        /**
         *  Get a copy of the topic object.
         */

        get_db();

        $topic_object = topic::find_by_id($g->saved_int01);

        if (!$topic_object) {

            breakout(' Unexpected failed to retrieve the topic object. ');

        }


        /**
         *  Replace some of the topic's current values.
         */

        $topic_object->topic_name = $topic_name;

        $topic_object->topic_description = $topic_description;


        /**
         *  Update the database with this topic object.
         */

        $result = $topic_object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated topic object (most likely because you didn\'t make any changes to it.) ');

        }


        /**
         * Report success.
         */

        breakout(" I updated <b>$g->saved_str01</b>'s record. ");

    }

}