<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\BankingAcctForBalances;

class GenerateABankingAccountForBalancesProcessor
{
    public function page()
    {
        /**
         * Create a database record in the banking_acct_for_balances
         * table using the submitted banking_acct_for_balances
         * acct_name. The remaining field values
         * will be set to default values.
         *
         * $_POST['acct_name']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $acct_name = (isset($_POST['acct_name'])) ? $_POST['acct_name'] : '';
        if (empty(trim($acct_name))) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($acct_name) > 264 || strlen($acct_name) < 3) {
            $sessionMessage .= " Either the acct_name is too long or too short. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Apply htmlspecialchars to fields which
         * get rendered by the browser.
         *
         * By convention: We apply htmlspecialchars() to data at
         * the point in time before that data gets saved in
         * the database.
         */
        $acct_name = htmlspecialchars($acct_name);

        /**
         * Create a BankingAcctForBalances array for the record.
         */
        $array_record = ['user_id' => $user_id, 'acct_name' => $acct_name, 'start_time' => 0, 'start_balance' => 0, 'comment' => ''];

        /**
         * Make the array into an in memory BankingAcctForBalances object for the record.
         */
        $object = BankingAcctForBalances::array_to_object($array_record);

        /**
         * Save the object.
         */
        $result = $object->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= ' The save method for BankingAcctForBalances returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for BankingAcctForBalances did not return false but it did send back a message.
             Therefore, it probably did not create the BankingAcctForBalances record. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Wrap it up.
         */
        $sessionMessage .= " A new Banking Account For Balances was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}