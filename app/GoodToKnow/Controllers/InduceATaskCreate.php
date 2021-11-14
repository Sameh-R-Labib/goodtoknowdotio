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
         * If $g->last is in the future OR $g->next is in the past then
         * redirect to a route which will inform the user that what he has
         * submitted doesn't seem to be correct. We will save the submitted
         * form data because we will also be giving the user ONE opportunity to
         * edit and re-submit the form. In other words the currently submitted
         * form data will be used to conveniently populate the redo form.
         */

        if ($g->is_first_attempt) {

            if ($g->last > time() or $g->next < time()) {

                // We have the anomalous condition, so we will do what is described above.

                $_SESSION['saved_arr01'] = ['label' => $label, 'last' => $g->last, 'next' => $g->next,
                    'cycle_type' => $cycle_type, 'comment' => $comment];

                $_SESSION['message'] = $g->message;
                redirect_to("/ax1/InduceATaskRedo/page");

            }

        }


        /**
         * Use the submitted data to add a record to the database.
         */

        $array_record = ['user_id' => $g->user_id, 'label' => $label, 'last' => $g->last, 'next' => $g->next,
            'cycle_type' => $cycle_type, 'comment' => $comment];


        // In memory object.

        $object = Task::array_to_object($array_record);

        get_db();

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