<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class RevampABankingTransactionForBalancesUpdate
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted revampabankingtransactionforbalancesedit.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // record id

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Validate the submitted revampabankingtransactionforbalancesedit.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // amount

        $edited_amount = float_form_field_prep('amount', 0.0, 21000000000.0);


        // time

        $edited_time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if ($edited_time === 0) $edited_time = 1560190617;


        // bank_id

        $edited_bank_id = integer_form_field_prep('bank_id', 1, PHP_INT_MAX);


        // label

        $edited_label = standard_form_field_prep('label', 3, 30);


        // Deal with null

        if (is_null($edited_time) || is_null($edited_bank_id) || is_null($edited_amount)) {

            breakout(' One or more values did NOT pass validation. ');

        }


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = BankingTransactionForBalances::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->bank_id = $edited_bank_id;
        $object->label = $edited_label;
        $object->amount = $edited_amount;
        $object->time = $edited_time;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db, $sessionMessage);

        if ($result === false) {

            breakout(' I failed at saving the updated object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated the <b>{$object->label}</b> record. ");
    }
}