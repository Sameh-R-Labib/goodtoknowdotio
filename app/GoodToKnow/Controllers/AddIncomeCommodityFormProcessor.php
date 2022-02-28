<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Commodity;
use GoodToKnow\Models\TaxableIncomeEvent;
use function GoodToKnow\ControllerHelpers\commodity_address_form_field_prep;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class AddIncomeCommodityFormProcessor
{
    function page()
    {
        /**
         * Create two (2) database records. One in the taxable_income_event table and another in
         * the Commodity table.
         *
         * Also, there is a redo feature.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'commodity_address_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $label = commodity_address_form_field_prep('label');

        $year = integer_form_field_prep('year', 1992, 965535);

        $commodity = standard_form_field_prep('commodity', 1, 15);

        $amount = float_form_field_prep('amount', -0.0000000000000001, 99999999999999.99);

        $currency = standard_form_field_prep('currency', 1, 15);

        $price = float_form_field_prep('price', -0.0000000000000001, 99999999999999.99);

        $comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * Redirect to give the user one chance to fix their time entry.
         * A correct time entry for a commodity and taxable_income_event record would be in the past.
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
                $saved_arr01['year'] = $year;
                $saved_arr01['commodity'] = $commodity;
                $saved_arr01['amount'] = $amount;
                $saved_arr01['currency'] = $currency;
                $saved_arr01['price'] = $price;
                $saved_arr01['comment'] = $comment;
                $saved_arr01['date'] = $g->date;
                $saved_arr01['hour'] = $g->hour;
                $saved_arr01['minute'] = $g->minute;
                $saved_arr01['second'] = $g->second;
                $saved_arr01['timezone'] = $g->timezone; // this is the actual timezone the user had entered


                // make form data survive the redirect
                $_SESSION['saved_arr01'] = $saved_arr01;


                redirect_to("/ax1/AddIncomeCommodityRedo/page");

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
         * Create a Commodity array for the record.
         */

        $array_commodity_record = ['user_id' => $g->user_id, 'address' => $label, 'commodity' => $commodity,
            'initial_balance' => $amount, 'current_balance' => $amount, 'currency' => $currency,
            'price_point' => $price, 'time' => $g->time, 'comment' => $comment];


        /**
         * Make the array into an in memory Commodity object for the record.
         */

        $commodity_object = Commodity::array_to_object($array_commodity_record);


        /**
         * Save the object.
         */

        get_db();

        $result = $commodity_object->save();

        if (!$result) {

            breakout(' The save method for Commodity returned false. ');

        }

        if (!empty($g->message)) {

            breakout(' The save method for Commodity did not return false but it did send back a message.
             Therefore, it probably did not create the Commodity record. ');

        }


        /**
         * Create a taxable_income_event array for the record.
         */

        $array_record = ['user_id' => $g->user_id, 'time' => $g->time, 'year_received' => $year,
            'currency' => $commodity, 'amount' => $amount, 'price' => $price, 'fiat' => $currency, 'label' => $label,
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

        breakout(' A new commodity record and a new taxable_income_event record were created 👏. ');
    }
}