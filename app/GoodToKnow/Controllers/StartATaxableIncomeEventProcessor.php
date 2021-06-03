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


        global $db;
        global $app_state;
        global $time;


        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        $label = standard_form_field_prep('label', 3, 264);

        $year_received = integer_form_field_prep('year_received', 1992, 65535);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        $comment = standard_form_field_prep('comment', 0, 800);

        $currency = standard_form_field_prep('currency', 1, 15);

        $amount = float_form_field_prep('amount', 0.0, 999999999999999.99);


        /**
         * Create a taxable_income_event array for the record.
         */

        $array_record = ['user_id' => $app_state->user_id, 'time' => $time, 'year_received' => $year_received,
            'currency' => $currency, 'amount' => $amount, 'label' => $label, 'comment' => $comment];


        /**
         * Make the array into an in memory taxable_income_event object for the record.
         */

        $object = TaxableIncomeEvent::array_to_object($array_record);


        /**
         * Save the object.
         */

        $db = get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' The save method for TaxableIncomeEvent returned false. ');

        }

        if (!empty($app_state->message)) {

            breakout(' The save method for TaxableIncomeEvent did not return false but it did send
            back a message. Therefore, it probably did not create the TaxableIncomeEvent record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Taxable Income Event was created 👍🏿. ');
    }
}