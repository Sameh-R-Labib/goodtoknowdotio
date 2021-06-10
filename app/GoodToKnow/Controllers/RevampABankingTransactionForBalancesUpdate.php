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


        global $g;
        // $g->saved_int01 record id


        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted revampabankingtransactionforbalancesedit.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        // amount

        $edited_amount = float_form_field_prep('amount', -999999999999999.99, 999999999999999.99);


        // - - - Get $g->time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        // bank_id

        $edited_bank_id = integer_form_field_prep('bank_id', 1, PHP_INT_MAX);


        // label

        $edited_label = standard_form_field_prep('label', 3, 30);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $g->db = get_db();

        $object = BankingTransactionForBalances::find_by_id($g->saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that record. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->bank_id = $edited_bank_id;
        $object->label = $edited_label;
        $object->amount = $edited_amount;
        $object->time = $g->time;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save();

        if ($result === false) {

            breakout(' I failed at saving the updated object. ');

        }


        /**
         * 5) Report success.
         */

        breakout(" I've updated the <b>{$object->label}</b> record. ");
    }
}