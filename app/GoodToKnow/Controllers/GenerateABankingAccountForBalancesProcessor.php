<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class GenerateABankingAccountForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_acct_for_balances table using the submitted banking_acct_for_balances
         * acct_name. The remaining field values will be set to default values.
         *
         * $_POST['acct_name']
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

        $acct_name = standard_form_field_prep('acct_name', 3, 30);

        if (is_null($acct_name)) {
            breakout(' The acct name you entered did not pass validation. ');
        }

        $db = get_db();


        /**
         * Create a BankingAcctForBalances array for the record.
         */

        $array_record = ['user_id' => $user_id, 'acct_name' => $acct_name, 'start_time' => 0, 'start_balance' => 0,
            'currency' => '', 'comment' => ''];


        /**
         * Make the array into an in memory BankingAcctForBalances object for the record.
         */

        $object = BankingAcctForBalances::array_to_object($array_record);


        /**
         * Save the object.
         */

        $result = $object->save($db, $sessionMessage);

        if (!$result) {
            breakout(' The save for Banking Acct For Balances failed. ');
        }

        if (!empty($sessionMessage)) {
            breakout(' The save for Banking Acct For Balances did not fail but it did send back a message.
             Therefore, it probably did not create the Banking Acct For Balances. ');
        }


        /**
         * Wrap it up.
         */

        breakout(' A Banking Account For Balances was created 😊. ');
    }
}