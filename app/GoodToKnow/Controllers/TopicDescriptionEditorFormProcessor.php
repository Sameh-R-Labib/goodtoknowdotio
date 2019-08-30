<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Topic;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class TopicDescriptionEditorFormProcessor
{
    function page()
    {
        /**
         * The purpose is to:
         *  1) Read $_POST['text']
         *     (which is the edited community's description.)
         *  2 & 3) Removed source code.
         *  4) Get a copy of the Topic object.
         *  5) Makes sure the description is escaped for suitability to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *  6) Replace the Topic's current description with the new one.
         *  7) Update the database with this Topic object.
         */

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01;                // The topic's name
        global $saved_int01;                // The topic's id

        kick_out_nonadmins();

        kick_out_onabort();


        /**
         *  1) Read $_POST['text']
         *     (which is the edited topic's description.)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_description = standard_form_field_prep('text', 0, 800);


        /**
         *  4) Get a copy of the Topic object.
         */

        $db = get_db();

        $topic_object = Topic::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$topic_object) {

            breakout(' Unexpected failed to retrieve the topic object. ');

        }


        /**
         *  5) Makes sure the description is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *
         *  Yes this is t.c.o. automatically. So, don't worry about it!
         */


        /**
         *  6) Replace the Topic's current description with the new one.
         */

        $topic_object->topic_description = $edited_description;


        /**
         *  7) Update the database with this Topic object.
         */

        $result = $topic_object->save($db, $sessionMessage);

        if ($result === false) {

            breakout(' I failed at saving the updated topic object. ');

        }


        /**
         * Report success.
         */

        breakout(" I have updated {$saved_str01}'s record. ");
    }
}