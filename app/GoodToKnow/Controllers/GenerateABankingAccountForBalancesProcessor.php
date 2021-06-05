<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class GenerateABankingAccountForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_acct_for_balances table using the submitted banking_acct_for_balances
         * data.
         */


        global $db;
        global $gtk;
        global $time;


        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $acct_name = standard_form_field_prep('acct_name', 3, 30);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        $start_balance = float_form_field_prep('start_balance', -999999999999999.99, 999999999999999.99);

        $currency = standard_form_field_prep('currency', 1, 15);

        $comment = standard_form_field_prep('comment', 0, 800);


        /**
         * Create a BankingAcctForBalances array for the record.
         */

        $array_record = ['user_id' => $gtk->user_id, 'acct_name' => $acct_name, 'start_time' => $time,
            'start_balance' => $start_balance, 'currency' => $currency, 'comment' => $comment];


        /**
         * Make the array into an in memory BankingAcctForBalances object for the record.
         */

        $object = BankingAcctForBalances::array_to_object($array_record);


        /**
         * Save the object.
         */

        $db = get_db();

        $result = $object->save();

        if (!$result) {

            breakout(' Your save for bank account failed 😟 ');

        }

        if (!empty($gtk->message)) {

            breakout(' Your save for bank account did not fail but it did send back a message.
             Therefore, it probably did not create the bank account 😟 ');

        }


        /**
         * Wrap it up.
         */

        breakout(' Your new bank account has just been created 👍🏽 ');
    }
}