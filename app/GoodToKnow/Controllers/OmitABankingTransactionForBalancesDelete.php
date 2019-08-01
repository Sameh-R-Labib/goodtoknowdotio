<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingTransactionForBalances;


class OmitABankingTransactionForBalancesDelete
{
    function page()
    {
        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         * 3) Present a form which is populated with data from the banking_transaction_for_balances object
         *    and asks for approval for deletion to proceed.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         */
        $chosen_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;
        if ($chosen_id == 0) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $object = BankingTransactionForBalances::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$object) {
            $sessionMessage .= " Unexpectedly I could not find that banking_transaction_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form (populated with data from the object)
         *    which asks for approval for deletion to proceed.
         *
         * Note: As usual we will pretty up the fields prior to showing them in the view.
         *       We will only show the following fields' values:
         *         - label
         *         - amount
         *         - time
         */
        $object->time = self::get_readable_time($object->time);
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        $object->amount = readable_amount_of_money($object->amount);

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'omitabankingtransactionforbalancesdelete.php';
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