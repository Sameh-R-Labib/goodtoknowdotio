<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;

class PopulateABankingAccountForBalancesProcessor
{
    public function page()
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Present a form which is populated with data from the banking_acct_for_balances object.
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
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         */
        $chosen_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;
        if ($chosen_id == 0) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
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


        /**
         * Debug Code
         */
        echo "\n<p>Begin debug</p>\n";
        echo "<br><p>Var_dump \$object: </p>\n<pre>";
        var_dump($object);
        echo "</pre>\n";
        die("<br><p>End debug</p>\n");



        /**
         * 3) Present a form which is populated with data from the banking_acct_for_balances object.
         */
        $html_title = 'Edit the banking_acct_for_balances record';

        require VIEWS . DIRSEP . 'populateabankingaccountforbalancesprocessor.php';
    }
}