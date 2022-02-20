<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class StartATaxableIncomeEventProcessor
{
    function page()
    {
        /**
         * Create a database record in the taxable_income_event table using the submitted taxable_income_event data.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        $label = standard_form_field_prep('label', 3, 264);

        $g->tax_year = integer_form_field_prep('year_received', 1992, 965535);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $comment = standard_form_field_prep('comment', 0, 1800);

        $currency = standard_form_field_prep('currency', 1, 15);

        $amount = float_form_field_prep('amount', -0.0000000000000001, 99999999999999.99);

        $price = float_form_field_prep('price', -0.0000000000000001, 99999999999999.99);

        $fiat = standard_form_field_prep('fiat', 1, 15);


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
                $saved_arr01['price'] = $price;
                $saved_arr01['fiat'] = $fiat;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/StartATaxableIncomeEventRedo/page");

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
         * Create a taxable_income_event array for the record.
         */

        $array_record = ['user_id' => $g->user_id, 'time' => $g->time, 'year_received' => $g->tax_year,
            'currency' => $currency, 'amount' => $amount, 'price' => $price, 'fiat' => $fiat, 'label' => $label,
            'comment' => $comment];


        /**
         * Make the array into an in memory taxable_income_event object for the record.
         */

        $object = TaxableIncomeEvent::array_to_object($array_record);


        /**
         * Save the object.
         */

        get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' The save method for TaxableIncomeEvent returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for TaxableIncomeEvent did not return false but it did send
            back a message. Therefore, it probably did not create the TaxableIncomeEvent record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Taxable Income Event was created 👍🏿. ');
    }
}