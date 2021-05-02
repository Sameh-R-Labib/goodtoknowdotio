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


        global $db;
        global $sessionMessage;


        kick_out_nonadmins();


        /**
         * 1) Determine the unix time stamp for 90 days ago.
         */
        $time_90_days_ago = time() - 7776000;


        /**
         * 2) Delete the BankingTransactionForBalances which are older than 90 days.
         */

        $num_affected_rows = 0;

        $db = get_db();

        $sql = 'DELETE FROM `banking_transaction_for_balances` WHERE `time` < ';
        $sql .= $db->real_escape_string($time_90_days_ago);

        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {
                breakout(' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ');
            }

            $num_affected_rows = $db->affected_rows;
        } catch (\Exception $e) {
            $sessionMessage .= ' PurgeNinetyDayOldBTFBs delete() exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($sessionMessage)) {
            breakout('');
        }


        /**
         * 3) Set a confirmation message in the session.
         * 4) Redirect to Home page.
         */

        breakout(" The purge of BankingTransactionForBalances older than 90 days has deleted <b>" . $num_affected_rows .
            "</b> records. ");
    }
}