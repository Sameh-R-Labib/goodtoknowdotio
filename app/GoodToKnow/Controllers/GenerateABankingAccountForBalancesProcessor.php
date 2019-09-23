<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class GenerateABankingAccountForBalancesProcessor
{
    function page()
    {
        /**
         * Create a database record in the banking_acct_for_balances table using the submitted banking_acct_for_balances
         * data.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $acct_name = standard_form_field_prep('acct_name', 3, 30);

        $start_time = integer_form_field_prep('start_time', 0, PHP_INT_MAX);

        if ($start_time === 0) $start_time = 1560190617;

        $start_balance = float_form_field_prep('start_balance', -21000000000.0, 21000000000.0);

        $currency = standard_form_field_prep('currency', 1, 15);

        $comment = standard_form_field_prep('comment', 0, 800);

        $db = get_db();


        /**
         * Create a BankingAcctForBalances array for the record.
         */

        $array_record = ['user_id' => $user_id, 'acct_name' => $acct_name, 'start_time' => $start_time,
            'start_balance' => $start_balance, 'currency' => $currency, 'comment' => $comment];


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