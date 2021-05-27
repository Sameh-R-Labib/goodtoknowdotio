<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class PopulateABankingAccountForBalancesSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted populateabankingaccountforbalancesprocessor.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         */


        global $db;
        global $sessionMessage;
        global $saved_int01;    // record id
        global $time;


        kick_out_loggedoutusers();


        /**
         * 1) Validate the submitted populateabankingaccountforbalancesprocessor.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $edited_acct_name = standard_form_field_prep('acct_name', 3, 30);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        $edited_start_balance = float_form_field_prep('start_balance', -999999999999999.99, 999999999999999.99);

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        $edited_comment = standard_form_field_prep('comment', 0, 800);


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = BankingAcctForBalances::find_by_id($db, $saved_int01);

        if (!$object) {

            breakout(' Unexpectedly I could not find that banking account for balances. ');

        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->acct_name = $edited_acct_name;
        $object->start_time = $time;
        $object->start_balance = $edited_start_balance;
        $object->currency = $edited_currency;
        $object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db);

        if ($result === false) {

            breakout(' I failed at saving the updated banking account for balances. ');

        }


        /**
         * Report success.
         */

        breakout(" I've updated the record for bank account <b>{$object->acct_name}</b>. ");
    }
}