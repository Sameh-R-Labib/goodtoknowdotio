<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class PolishARecurringPaymentRecordSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $g;
        global $db;
        // $g->saved_int01 recurring_payment id


        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 4, 264);

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        $edited_amount_paid = float_form_field_prep('amount_paid', 0.0, 999999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = RecurringPayment::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that recurring payment record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->label = $edited_label;
        $object->currency = $edited_currency;
        $object->amount_paid = $edited_amount_paid;
        $object->time = $g->time;
        $object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated Recurring Payment. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->label}</b>. ");
    }
}