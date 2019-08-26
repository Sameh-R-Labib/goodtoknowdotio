<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class PopulateABankingAccountForBalancesProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Present a form which is populated with data from the banking_acct_for_balances object.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }


        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            breakout(' Your choice did not pass validation. ');
        }

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         */

        $db = get_db();

        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$object) {
            breakout(' Unexpectedly I could not find that banking account for balances. ');
        }


        /**
         * 3) Present a form which is populated with data from the banking_acct_for_balances object.
         */

        $html_title = 'Edit the banking_acct_for_balances record';

        require VIEWS . DIRSEP . 'populateabankingaccountforbalancesprocessor.php';
    }
}