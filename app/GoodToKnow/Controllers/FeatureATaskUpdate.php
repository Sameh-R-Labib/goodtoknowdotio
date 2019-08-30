<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\Task;

class FeatureATaskUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted featureataskedit.php form data. (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // task id

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Validate the submitted featureataskedit.php form data.
         *      (and apply htmlspecialchars)
         */


        // label

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);


        // last - a timestamp

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_last = integer_form_field_prep('last', 0, PHP_INT_MAX);


        // next - a timestamp

        $edited_next = integer_form_field_prep('next', 0, PHP_INT_MAX);


        // cycle_type - a string which is between 3 to 6 characters long

        $edited_cycle_type = standard_form_field_prep('cycle_type', 3, 60);


        // comment

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = Task::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            breakout(' Unexpectedly I could not find that record. ');
        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->label = $edited_label;
        $object->last = $edited_last;
        $object->next = $edited_next;
        $object->cycle_type = $edited_cycle_type;
        $object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db, $sessionMessage);

        if ($result === false) {
            breakout(' I failed at saving the updated object. ');
        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->label}</b>. ");
    }
}