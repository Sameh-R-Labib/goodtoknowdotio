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


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);


        // + + + Get $g->last and $g->next (which are timestamps) based on submitted:
        // `timezone` `last_date` `last_hour` `last_minute` `last_second` `next_date` `next_hour` `next_minute` `next_second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_next_and_last_epochs.php';

        // + + +


        $cycle_type = standard_form_field_prep('cycle_type', 3, 60);

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * If $g->last is in the future OR $g->next is in the past then
         * redirect to a route which will inform the user that what he has
         * submitted doesn't seem to be correct. We will save the submitted
         * form data because we will also be giving the user ONE opportunity to
         * edit and re-submit the form. In other words the currently submitted
         * form data will be used to conveniently populate the redo form.
         *
         * As you see in the code there is a mechanism which causes what we are
         * doing here to happen only once for the submitted data set. In other
         * words the first time the user submits his data set we will check it
         * and give him a chance to fix it. On the subsequent submit we will
         * just let the submitted data be saved.
         */

        if ($g->is_first_attempt) {

            if ($g->last > time() or $g->next < time()) {

                /**
                 * Reset 'is_first_attempt' in the session.
                 *
                 * We are setting 'is_first_attempt' to false so that once the user submits the form,
                 * and it is being processed it will not be retested for anomalous time entries.
                 */

                $_SESSION['is_first_attempt'] = false;


                // Put form data in an array to prepare it to be stored in $_SESSION['saved_arr01'].
                $saved_arr01['label'] = $label;
                $saved_arr01['cycle_type'] = $cycle_type;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered
                $saved_arr01['last_date'] = $g->last_date;
                $saved_arr01['next_date'] = $g->next_date;
                $saved_arr01['last_hour'] = $g->last_hour;
                $saved_arr01['next_hour'] = $g->next_hour;
                $saved_arr01['last_minute'] = $g->last_minute;
                $saved_arr01['next_minute'] = $g->next_minute;
                $saved_arr01['last_second'] = $g->last_second;
                $saved_arr01['next_second'] = $g->next_second;


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/InduceATaskRedo/page");

            }

        }


        /**
         * Reset 'is_first_attempt' in the session.
         *
         * We need to set it to true so the next time the user creates a task
         * he will have the same opportunity to have his data checked.
         */

        $_SESSION['is_first_attempt'] = true;


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

        /*breakout(' A <b>task</b> record was created 👍. ');*/
        reset_feature_session_vars();


        /**
         * We want to reassure the user that the task has been saved.
         * So, we are going to hook into the "See Tasks" feature.
         */

        redirect_to("/ax1/glance_at_my_tasks/page");
    }
}