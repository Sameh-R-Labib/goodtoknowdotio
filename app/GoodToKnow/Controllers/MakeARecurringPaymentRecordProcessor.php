<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class MakeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the recurring_payment table using the submitted
         * recurring_payment data.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 264);

        $currency = standard_form_field_prep('currency', 1, 15);

        $amount_paid = float_form_field_prep('amount_paid', 0.0, 999999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $comment = standard_form_field_prep('comment', 0, 800);


        /**
         * Redirect to give the user one chance to fix their time entry.
         * A correct time entry for a Recurring Payment record would be in the past.
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
                $saved_arr01['currency'] = $currency;
                $saved_arr01['amount_paid'] = $amount_paid;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/InitializeABitcoinRecordRedo/page");

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
         * Create a RecurringPayment array for the record.
         */


        $array_recurring_payment_record = ['user_id' => $g->user_id, 'label' => $label, 'currency' => $currency,
            'amount_paid' => $amount_paid, 'time' => $g->time, 'comment' => $comment];


        /**
         * Make the array into an in memory RecurringPayment object for the record.
         */

        $recurring_payment_object = RecurringPayment::array_to_object($array_recurring_payment_record);


        /**
         * Save the object.
         */

        get_db();

        $result = $recurring_payment_object->save();

        if (!$result) {

            breakout(' The save method for RecurringPayment returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for RecurringPayment did not return false but it did send back a message.
             Therefore, it probably did not create the RecurringPayment record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A recurring payment record was created 👍. ');

    }
}