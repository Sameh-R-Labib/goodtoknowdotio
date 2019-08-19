<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingAcctForBalances;

class AnnulABankingAcctForBalancesProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the banking_acct_for_balances record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the BankingAcctForBalances object with that id from the database.
         *    And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Determines the id of the banking_acct_for_balances record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the BankingAcctForBalances object with that id from the database.
         *    And, format its attributes for easy viewing.
         */
        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that banking_acct_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Format its attributes for easy viewing.
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $object->start_time = get_readable_time($object->start_time);
        $object->start_balance = readable_amount_of_money($object->currency, $object->start_balance);
        $object->comment = nl2br($object->comment, false);

        /**
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */
        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalancesprocessor.php';
    }
}