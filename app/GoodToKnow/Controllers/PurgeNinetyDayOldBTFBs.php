<?php


namespace GoodToKnow\Controllers;


class PurgeNinetyDayOldBTFBs
{
    function page()
    {
        /**
         * This is for deleting the BankingTransactionForBalances which are older
         * than 90 days.
         *
         * Here is exactly what it will do:
         * 1) Determine the unix time stamp for 90 days ago.
         * 2) Delete the BankingTransactionForBalances which are older than 90 days.
         * 3) Set a confirmation message in the session.
         * 4) Redirect to Home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
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
         * 1) Determine the unix time stamp for 90 days ago.
         */
        $time_90_days_ago = time() - 7776000;

        /**
         * 2) Delete the BankingTransactionForBalances which are older than 90 days.
         */
        $num_affected_rows = 0;
        $sql = 'DELETE FROM `banking_transaction_for_balances` WHERE `time` < ';
        $sql .= $db->real_escape_string($time_90_days_ago);

        try {
            $db->query($sql);
            $query_error = $db->error;
            if (!empty(trim($query_error))) {
                $sessionMessage .= ' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
                $_SESSION['message'] = $sessionMessage;
                redirect_to("/ax1/Home/page");
            }
            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $sessionMessage .= ' PurgeNinetyDayOldBTFBs delete() exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Set a confirmation message in the session.
         * 4) Redirect to Home page.
         */
        $sessionMessage .= " The purge of BankingTransactionForBalances older than 90 days has deleted <b>";
        $sessionMessage .= $num_affected_rows . "</b> records. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}