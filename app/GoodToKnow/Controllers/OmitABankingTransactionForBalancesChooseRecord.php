<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingTransactionForBalances;
use function GoodToKnow\ControllerHelpers\get_readable_time;


class OmitABankingTransactionForBalancesChooseRecord
{
    function page()
    {
        /**
         * This function will:
         *  1) Retrieve the user's BankingTransactionForBalances within the time range.
         *  2) Present them as choices.
         *
         * The ultimate goal is to present a BankingTransactionForBalances for deletion.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $saved_int01;     // min time
        global $saved_int02;     // max time

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Get an array of BankingTransactionForBalances objects belonging to the user
         * and falling within the prescribed time range.
         */
        $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $sql .= ' AND `time` BETWEEN "' . $db->real_escape_string($saved_int01) . '" AND "' . $db->real_escape_string($saved_int02) . '"';
        $sql .= ' ORDER BY `time`';

        $array = BankingTransactionForBalances::find_by_sql($db, $sessionMessage, $sql);

        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= ' I could NOT find any banking transaction for balances records ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Replace time with a human readable time.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array as $object) {
            $object->time = get_readable_time($object->time);
        }

        $html_title = 'Which banking_transaction_for_balances record?';

        require VIEWS . DIRSEP . 'omitabankingtransactionforbalanceschooserecord.php';
    }
}