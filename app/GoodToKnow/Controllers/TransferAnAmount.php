<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\get_html_select_box;

class TransferAnAmount
{
    function page()
    {
        /**
         * Transfer An Amount
         * ==================
         *
         * Transfer An Amount makes it convenient to record the two transactions
         * involved when a single amount is transferred from one bank account to
         * another.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Enter Transfer Data';


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


        /**
         * Use get_html_select_box to get $g->sending_account and $g->receiving_account.
         * These contain the html for the two down-downs.
         */

        // Generate the array.

        foreach ($array_of_objects as $object) {

            $assoc_array_val_to_text[$object->id] = $object->acct_name;

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'get_html_select_box.php';

        $g->sending_account = get_html_select_box('0', "sending_account", "Sending Account:\n", 'dropdown', $assoc_array_val_to_text);

        $g->receiving_account = get_html_select_box('0', "receiving_account", "Receiving Account:\n", 'dropdown', $assoc_array_val_to_text);


        /**
         * We need to assign default values for the form field
         * variables. The reason we need these particular variable names
         * is that the form is also used by the redo.
         *
         * All the form's variables are elements of $g->saved_arr01.
         */

        $g->saved_arr01['label'] = '';
        $g->saved_arr01['amount'] = '';
        $g->saved_arr01['date'] = '';
        $g->saved_arr01['hour'] = '';
        $g->saved_arr01['minute'] = '';
        $g->saved_arr01['second'] = '';
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'transferanamount.php';
    }
}