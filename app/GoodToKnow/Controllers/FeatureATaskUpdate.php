<?php

namespace GoodToKnow\Controllers;

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

        global $db;
        global $sessionMessage;
        global $saved_int01;    // task id
        global $last;
        global $next;
        global $timezone;   // just to reaffirm that "timezone" mean the script's PHP runtime timezone.

        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted featureataskedit.php form data.
         *      (and apply htmlspecialchars)
         */


        // label

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);


        // Time related fields

        // + + + Get $last and $next (which are timestamps) based on submitted:
        // `timezone` `lastdate` `lasthour` `lastminute` `lastsecond` `nextdate` `nexthour` `nextminute` `nextsecond`


        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_next_and_last_epochs.php';

        // + + +


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
        $object->last = $last;
        $object->next = $next;
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