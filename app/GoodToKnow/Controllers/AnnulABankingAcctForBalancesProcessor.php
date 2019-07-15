<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingAcctForBalances;

class AnnulABankingAcctForBalancesProcessor
{
    public function page()
    {
        /**
         * 1) Determines the id of the banking_acct_for_balances record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the BankingAcctForBalances object with that id from the database.
         *    And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Determines the id of the banking_acct_for_balances record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         */
        $chosen_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;
        if ($chosen_id == 0) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
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
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $object = BankingAcctForBalances::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that banking_acct_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        // Format its attributes for easy viewing.
        $object->start_time = self::get_readable_time($object->start_time);
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        $object->start_balance = readable_amount_of_money($object->start_balance);
        $object->comment = nl2br($object->comment, false);

        /**
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */
        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalancesprocessor.php';
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $created
     * @return string
     */
    public static function get_readable_time($created)
    {
        $created = (int)$created;
        $date = date('m/d/Y h:ia ', $created) . "<small>[" . date_default_timezone_get() . "]</small>";
        return $date;
    }
}