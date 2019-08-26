<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TaxableIncomeEvent;
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

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // record id

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * 1) Validate the submitted writeoverataxableincomeeventedit.php form data.
         *      (and apply htmlspecialchars)
         */


        // label

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_label = standard_form_field_prep('label', 3, 264);

        if (is_null($edited_label)) {
            breakout(' The label you entered did not pass validation. ');
        }


        // year_received

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_year_received = integer_form_field_prep('year_received', 1992, 65535);

        if (is_null($edited_year_received)) {
            breakout(' The year received you entered did not pass validation. ');
        }


        // comment

        $edited_comment = standard_form_field_prep('comment', 0, 800);

        if (is_null($edited_comment)) {
            breakout(' The comment you entered did not pass validation. ');
        }


        // time

        $edited_time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if (is_null($edited_time)) {
            breakout(' The time you entered did not pass validation. ');
        }


        // currency

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        if (is_null($edited_currency)) {
            breakout(' The currency you entered did not pass validation. ');
        }


        // amount

        $edited_amount = (isset($_POST['amount'])) ? (float)$_POST['amount'] : 0.0;


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }

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
        $object->time = $edited_time;


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