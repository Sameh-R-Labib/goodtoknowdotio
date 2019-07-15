<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingAcctForBalances;
use GoodToKnow\Models\BankingTransactionForBalances;


class CheckMyBankingAccountTxBalancesShowBalances
{
    public function page()
    {
        /**
         * This function will:
         * 1) Get (from the database) the BankingAcctForBalances object.
         * 2) Get (from the database) all the BankingTransactionForBalances which
         * have a time stamp greater than the start time for the account. Note:
         * it can't be equal to the start time. Also: make sure the transactions
         * are ordered by time increasing. Obviously, these transactions must be
         * for the user who is requesting this stuff. Also, these transactions must
         * be for the currently chosen BankingAcctForBalances.
         * 3) Augment our data set with a running total in each BankingTransactionForBalances
         * object. This gets assigned to each BankingTransactionForBalances object's balance field.
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         * will be wrong if admin has deleted transactions older than 90 days and the start
         * time for the BankingAcctForBalances is set to a time older than 90 days.
         * Also, show the account name for BankingAcctForBalances at the top of the ledger.
         * Also, transform field data to a more human friendly format.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $saved_int01;    // id of BankingAcctForBalances record

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Get (from the database) the BankingAcctForBalances object.
         */
        $account = BankingAcctForBalances::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$account) {
            $sessionMessage .= " Unexpectedly I could not find that banking_acct_for_balances record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Get (from the database) all the BankingTransactionForBalances which
         * have a time stamp greater than the start time for the account. Note:
         * it can't be equal to the start time. Also: make sure the transactions
         * are ordered by time increasing. Obviously, these transactions must be
         * for the user who is requesting this stuff. Also, these transactions must
         * be for the currently chosen BankingAcctForBalances.
         */
        $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = ' . $db->real_escape_string($user_id);
        $sql .= ' AND `bank_id` = ' . $db->real_escape_string($account->id);
        $sql .= ' AND `time` > ' . $db->real_escape_string($account->start_time);
        $sql .= ' ORDER BY `time` ASC';
        $array = BankingTransactionForBalances::find_by_sql($db, $sessionMessage, $sql);
        if (!$array || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any banking_transaction_for_balances records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Augment our data set with a running total in each BankingTransactionForBalances
         * object. This gets assigned to each BankingTransactionForBalances object's balance field.
         */
        $running_total = $account->start_balance;
        foreach ($array as $transaction) {
            $running_total += $transaction->amount;
            $transaction->balance = $running_total;
        }

        /**
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         * will be wrong if admin has deleted transactions older than 90 days and the start
         * time for the BankingAcctForBalances is set to a time older than 90 days.
         * Also, show the account name for BankingAcctForBalances at the top of the ledger.
         * Also, transform field data to a more human friendly format.
         *
         * BankingTransactionForBalances fields in need of transforming:
         * - amount [comma separator for thousands]
         * - time [human readable time]
         * - balance [comma separator for thousands]
         *
         * BankingAcctForBalances fields in need of transformation.
         * - start_time [human readable time]
         * - start_balance [comma separator for thousands]
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$array: </p>\n<pre>";
        var_dump($array);
        echo "</pre>\n";



        foreach ($array as $transaction) {
            $transaction->amount = readable_amount_of_money($transaction->amount);
            $transaction->balance = readable_amount_of_money($transaction->balance);
            $transaction->time = self::get_readable_time($transaction->time);
        }


        /**
         * Debug Code
         */
        echo "\n<hr>\n";
        echo "\n<p>Begin debug</p>\n";
        echo "<p>Var_dump \$array: </p>\n<pre>";
        var_dump($array);
        echo "</pre>\n";
        die("<p>End debug</p>\n");


        $account->start_time = self::get_readable_time($account->start_time);
        $account->start_balance = readable_amount_of_money($account->start_balance);

        $html_title = 'Transactions';

        $page = 'CheckMyBankingAccountTxBalances';

        $show_poof = true;

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your 🏦ing 📋 ⚖️s. ';

        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalancesshowbalances.php';
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