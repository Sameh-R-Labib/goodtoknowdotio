<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;

class TransferAnAmountRedo
{
    function page()
    {
        /**
         * This is similar to BuildABankingTransactionForBalancesRedo
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'One chance to redo';


        /**
         * Get the html for two (2) form's select boxes.
         * One is for sending_account.
         * Another is for receiving_account.
         * To understand how this works see BuildingABankingTransactionForBalances.
         */

        get_db();

        // $g->user_id is the id of the user.

        // First I need to get all the BankingAcctForBalances object for this user.

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $array_of_objects = BankingAcctForBalances::find_by_sql($sql);

        if (!$array_of_objects || !empty($g->message)) {

            breakout(' I could NOT find any banking acct for balances ¯\_(ツ)_/¯ ');

        }

        // Build sending_account drop-down select box.

        $g->sending_account = "        <label for=\"sending_account\" class=\"dropdown\">Sending Account:\n";

        $g->sending_account .= "             <select id=\"sending_account\" name=\"sending_account\">\n";

        foreach ($array_of_objects as $object) {
            $g->sending_account .= "                 <option value=\"";

            $g->sending_account .= $object->id;

            if ($object->id == $g->saved_arr01['sending_account']) {
                $g->sending_account .= "\" selected>";
            } else {
                $g->sending_account .= "\">";
            }

            $g->sending_account .= $object->acct_name;

            $g->sending_account .= "</option>\n";
        }

        $g->sending_account .= "             </select>\n";

        $g->sending_account .= "        </label>\n";

        // Build receiving_account drop-down select box.

        $g->receiving_account = "        <label for=\"receiving_account\" class=\"dropdown\">Receiving Account:\n";

        $g->receiving_account .= "             <select id=\"receiving_account\" name=\"receiving_account\">\n";

        foreach ($array_of_objects as $object) {
            $g->receiving_account .= "                 <option value=\"";

            $g->receiving_account .= $object->id;

            if ($object->id == $g->saved_arr01['receiving_account']) {
                $g->receiving_account .= "\" selected>";
            } else {
                $g->receiving_account .= "\">";
            }

            $g->receiving_account .= $object->acct_name;

            $g->receiving_account .= "</option>\n";
        }

        $g->receiving_account .= "             </select>\n";

        $g->receiving_account .= "        </label>\n";


        /**
         * This must be after get_db() or else it will cause a breakout.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        require VIEWS . DIRSEP . 'transferanamount.php';
    }
}