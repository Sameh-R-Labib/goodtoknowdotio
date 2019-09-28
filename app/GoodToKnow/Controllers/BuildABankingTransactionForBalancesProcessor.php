<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class BuildABankingTransactionForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_transaction_for_balances
         * table using the submitted banking_transaction_for_balances data.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';


        $label = standard_form_field_prep('label', 3, 30);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`

        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';

        // - - -


        $amount = float_form_field_prep('amount', -21000000000.0, 21000000000.0);

        $bank_id = integer_form_field_prep('bank_id', 1, PHP_INT_MAX);


        /**
         * Create a BankingTransactionForBalances array for the record.
         */

        /** @noinspection PhpUndefinedVariableInspection */

        $array_record = ['user_id' => $user_id, 'bank_id' => $bank_id, 'label' => $label, 'amount' => $amount, 'time' => $time];


        /**
         * Make the array into an in memory BankingTransactionForBalances object for the record.
         */

        $object = BankingTransactionForBalances::array_to_object($array_record);


        /**
         * Save the object.
         */

        $db = get_db();

        $result = $object->save($db, $sessionMessage);

        if (!$result) {

            breakout(' I was unable to save the transaction. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The save method for BankingTransactionForBalances did not return false but it did send
            back a message. Therefore, it probably did not create the BankingTransactionForBalances record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A Banking Transaction For Balances was created! ');
    }
}