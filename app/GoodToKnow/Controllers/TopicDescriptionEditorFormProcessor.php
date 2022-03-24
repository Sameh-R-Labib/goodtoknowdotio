<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Topic;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class TopicDescriptionEditorFormProcessor
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
         *  Get a copy of the Topic object.
         */

        get_db();

        $topic_object = Topic::find_by_id($g->saved_int01);

        if (!$topic_object) {

            breakout(' Unexpected failed to retrieve the topic object. ');

        }


        /**
         *  Replace some of the Topic's current values.
         */

        $topic_object->topic_name = $topic_name;

        $topic_object->topic_description = $topic_description;


        /**
         *  Update the database with this Topic object.
         */

        $result = $topic_object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated topic object (most likely because you didn\'t make any changes to it.) ');

        }


        /**
         * Report success.
         */

        breakout(" I have updated $g->saved_str01's record. ");

    }

}