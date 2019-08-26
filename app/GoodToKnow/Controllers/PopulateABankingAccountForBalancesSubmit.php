<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
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

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // record id

        kick_out_loggedoutusers();

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * 1) Validate the submitted populateabankingaccountforbalancesprocessor.php form data.
         *      (and apply htmlspecialchars)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $edited_acct_name = standard_form_field_prep('acct_name', 3, 30);

        $edited_start_time = integer_form_field_prep('start_time', 0, PHP_INT_MAX);

        if ($edited_start_time === 0) {
            $edited_start_time = 1560190617;
        }

        $edited_start_balance = (isset($_POST['start_balance'])) ? (float)$_POST['start_balance'] : 0.0;

        $edited_currency = standard_form_field_prep('currency', 1, 15);

        $edited_comment = standard_form_field_prep('comment', 0, 800);

        if (is_null($edited_comment) || is_null($edited_acct_name) || is_null($edited_currency) || is_null($edited_start_time)) {
            breakout(' One or more values you entered did not pass validation. ');
        }


        /**
         * 2) Retrieve the existing record from the database.
         */

        $db = get_db();

        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$object) {
            $sessionMessage .= "";
            breakout(' Unexpectedly I could not find that banking account for balances. ');
        }


        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */

        $object->acct_name = $edited_acct_name;
        $object->start_time = $edited_start_time;
        $object->start_balance = $edited_start_balance;
        $object->currency = $edited_currency;
        $object->comment = $edited_comment;


        /**
         * 4) Update/save the updated record in the database.
         */

        $result = $object->save($db, $sessionMessage);

        if ($result === false) {
            breakout(' I failed at saving the updated banking account for balances. ');
        }


        /**
         * Report success.
         */

        breakout(" I've updated the BankingAcctForBalances <b>{$object->acct_name}</b> record. ");
    }
}