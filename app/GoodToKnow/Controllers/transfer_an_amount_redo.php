<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use function GoodToKnow\ControllerHelpers\get_html_select_box;

class transfer_an_amount_redo
{
    function page()
    {
        /**
         * This is similar to build_a_banking_transaction_for_balances_redo
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'One chance to redo';


        /**
         * Get the html for two (2) form's select boxes.
         * One is for sending_account.
         * Another is for receiving_account.
         * To understand how this works see BuildingAbanking_transaction_for_balances.
         */

        get_db();

        // $g->user_id is the id of the user.

        // First I need to get all the banking_acct_for_balances object for this user.

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $array_of_objects = banking_acct_for_balances::find_by_sql($sql);

        if (!$array_of_objects) {

            breakout(' I could NOT find any banking acct for balances ¯\_(ツ)_/¯ ');

        }


        /**
         * Use get_html_select_box to get $g->sending_account and $g->receiving_account.
         * These contain the html for the two down-downs.
         */

        // Generate the array.

        foreach ($array_of_objects as $object) {

            $assoc_array_val_to_text[$object->id] = $object->acct_name;

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'get_html_select_box.php';

        $g->sending_account = get_html_select_box((string)$g->saved_arr01['sending_account'], "sending_account",
            "Sending Account:\n", 'dropdown', $assoc_array_val_to_text);

        $g->receiving_account = get_html_select_box((string)$g->saved_arr01['receiving_account'], "receiving_account",
            "Receiving Account:\n", 'dropdown', $assoc_array_val_to_text);


        /**
         * This must be after get_db() or else it will cause a breakout.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        require VIEWS . DIRSEP . 'transferanamount.php';
    }
}