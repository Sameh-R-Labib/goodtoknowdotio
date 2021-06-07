<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;
use GoodToKnow\Models\Task;

class InduceATaskCreate
{
    function page()
    {
        /**
         * Create a database record in the task table using the submitted data.
         */


        global $g;
        global $db;


        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);


        // + + + Get $g->last and $g->next (which are timestamps) based on submitted:
        // `timezone` `lastdate` `lasthour` `lastminute` `lastsecond` `nextdate` `nexthour` `nextminute` `nextsecond`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_next_and_last_epochs.php';
        // + + +


        $cycle_type = standard_form_field_prep('cycle_type', 3, 60);

        $comment = standard_form_field_prep('comment', 0, 800);


        /**
         * Use the submitted data to add a record to the database.
         */

        $array_record = ['user_id' => $g->user_id, 'label' => $label, 'last' => $g->last, 'next' => $g->next,
            'cycle_type' => $cycle_type, 'comment' => $comment];


        // In memory object.

        $object = Task::array_to_object($array_record);

        $db = get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' The object\'s save method returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The object\'s save method did not return false but it did send
            back a message. Therefore, it probably did not create a new record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A <b>task</b> record was created 👍. ');
    }
}