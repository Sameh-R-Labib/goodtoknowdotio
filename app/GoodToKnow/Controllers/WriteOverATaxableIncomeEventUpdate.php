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
         * 1) Validate the submitted writeoverataxableincomeeventedit.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $sessionMessage;
        global $saved_int01;    // record id

        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted writeoverataxableincomeeventedit.php form data.
         *      (and apply htmlspecialchars)
         */


        // label

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);


        // year_received

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_year_received = integer_form_field_prep('year_received', 1992, 65535);


        // comment

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        // currency

        $edited_currency = standard_form_field_prep('currency', 1, 15);


        // amount

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $edited_amount = float_form_field_prep('amount', 0.0, 999999999999999.99);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = TaxableIncomeEvent::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->label = $edited_label;
        $object->year_received = $edited_year_received;
        $object->comment = $edited_comment;
        $object->amount = $edited_amount;
        $object->currency = $edited_currency;

        /** @noinspection PhpUndefinedVariableInspection */
        $object->time = $time;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db, $sessionMessage);

        if ($result === false) {

            breakout(' I failed at saving the object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated <b>{$object->label}</b>. ");
    }
}