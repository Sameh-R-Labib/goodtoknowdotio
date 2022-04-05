<?php

namespace GoodToKnow\Controllers;

class purge_ninety_day_old_btfb_s
{
    function page()
    {
        /**
         * This is for deleting the banking_transaction_for_balances which are older
         * than 90 days.
         *
         * Here is exactly what it will do:
         * 1) Determine the unix time stamp for 90 days ago.
         * 2) Delete the banking_transaction_for_balances which are older than 90 days.
         * 3) Set a confirmation message in the session.
         * 4) Redirect to home page.
         */


        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * 1) Determine the unix time stamp for 90 days ago.
         */
        $time_90_days_ago = time() - 7776000;


        /**
         * 2) Delete the banking_transaction_for_balances which are older than 90 days.
         */

        $num_affected_rows = 0;

        get_db();

        $sql = 'DELETE FROM `banking_transaction_for_balances` WHERE `time` < ';
        $sql .= $g->db->real_escape_string((string)$time_90_days_ago);

        try {
            $g->db->query($sql);

            $query_error = $g->db->error;

            if (!empty(trim($query_error))) {
                breakout(' The delete failed because: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ');
            }

            $num_affected_rows = $g->db->affected_rows;
        } catch (\Exception $e) {
            $g->message .= ' purge_ninety_day_old_btfb_s delete() exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
        }

        if (!empty($g->message)) {
            breakout('');
        }


        /**
         * 3) Set a confirmation message in the session.
         * 4) Redirect to home page.
         */

        breakout(" The purge of banking_transaction_for_balances older than 90 days has deleted <b>" . $num_affected_rows .
            "</b> records. ");
    }
}