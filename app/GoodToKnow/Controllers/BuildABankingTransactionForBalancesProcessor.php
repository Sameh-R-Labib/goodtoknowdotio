<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class BuildABankingTransactionForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_transaction_for_balances
         * table using the submitted banking_transaction_for_balances
         * label and time. The remaining field values will be set to default values.
         *
         * $_POST['label'] $_POST['time']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';


        // label

        $label = standard_form_field_prep('label', 3, 30);


        // time

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if (is_null($time)) {

            breakout(' The time you entered did not pass validation. ');

        }

        if ($time === 0) $time = 1560190617;


        /**
         * Create a BankingTransactionForBalances array for the record.
         */

        $array_record = ['user_id' => $user_id, 'bank_id' => 0, 'label' => $label, 'amount' => 0, 'time' => $time];


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