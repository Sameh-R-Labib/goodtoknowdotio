<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class WriteOverATaxableIncomeEventUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */


        global $g;
        // $g->saved_int01 record id


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * 1) Validate the submitted form data.
         *      (and apply htmlspecialchars)
         */


        // label

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);


        // year_received

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $g->tax_year = integer_form_field_prep('year_received', 1992, 65535);


        // comment

        $comment = standard_form_field_prep('comment', 0, 800);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        // currency

        $currency = standard_form_field_prep('currency', 1, 15);


        // amount

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $amount = float_form_field_prep('amount', 0.0, 999999999999999.99);


        /**
         * Redirect to give the user one chance to fix their time entry.
         * A correct time entry for a Taxable Income Event record would be in the past.
         *
         * The currently submitted form data will be used to conveniently
         * populate the redo form.
         *
         * As you see in the code there is a mechanism which causes what we are
         * doing here to happen only once for the submitted data set. In other
         * words the first time the user submits his data set we will check it
         * and give him a chance to fix it. On the subsequent submit we will
         * just let the submitted data be saved.
         */

        if ($g->is_first_attempt) {

            if ($g->time > time()) {

                /**
                 * Reset 'is_first_attempt' in the session.
                 *
                 * We are setting 'is_first_attempt' to false so that once the user submits the form,
                 * and it is being processed it will not be retested for anomalous time entries.
                 */

                $_SESSION['is_first_attempt'] = false;


                // Put form data in an array to prepare it to be stored in $_SESSION['saved_arr01'].
                $saved_arr01['label'] = $label;
                $saved_arr01['year_received'] = $g->tax_year;
                $saved_arr01['currency'] = $currency;
                $saved_arr01['amount'] = $amount;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/WriteOverATaxableIncomeEventRedo/page");

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
         * 2) Retrieve the existing record from the database.
         */

        get_db();

        $object = TaxableIncomeEvent::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->label = $label;
        $object->year_received = $g->tax_year;
        $object->comment = $comment;
        $object->amount = $amount;
        $object->currency = $currency;
        $object->time = $g->time;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I failed at saving the object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->label}</b>. ");
    }
}