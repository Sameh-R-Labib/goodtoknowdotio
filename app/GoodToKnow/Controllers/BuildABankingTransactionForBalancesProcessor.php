<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingTransactionForBalances;
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

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 3, 30);

        if (is_null($label)) {
            breakout(' The label did NOT pass validation. ');
        }

        $time = (isset($_POST['time'])) ? $_POST['time'] : '';

        if (empty(trim($time))) {
            breakout(' Something went wrong. Please try again. ');
        }

        if (strlen($time) > 22 || strlen($time) < 10) {
            breakout(' Either the time\'s string length is too long or too short. Start over. ');
        }


        // Remove this once i switch to using integer_form_field_prep()

        $time = (int)$time;

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


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