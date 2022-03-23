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
         *  Read 'text'
         *     (which is the edited topic's description.)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_description = standard_form_field_prep('text', 0, 230);


        /**
         *  Get a copy of the Topic object.
         */

        get_db();

        $topic_object = Topic::find_by_id($g->saved_int01);

        if (!$topic_object) {

            breakout(' Unexpected failed to retrieve the topic object. ');

        }


        /**
         *  Replace the Topic's current description with the new one.
         */

        $topic_object->topic_description = $edited_description;


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