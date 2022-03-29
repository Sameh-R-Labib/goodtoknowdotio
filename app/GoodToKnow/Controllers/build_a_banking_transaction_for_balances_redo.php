<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_html_select_box_containing_the_bank_accounts;

class build_a_banking_transaction_for_balances_redo
{
    function page()
    {
        /**
         * This is similar to InduceATask::page().
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'One chance to redo';


        /**
         * Get the html for form's select box.
         * It comes with one of the select options marked as selected.
         */

        get_db(); // Is needed for get_html_select_box_containing_the_bank_accounts()

        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $g->account_type = get_html_select_box_containing_the_bank_accounts($g->user_id, $g->saved_arr01['bank_id']);


        /**
         * This must be after get_db() or else it will cause a breakout.
         */

        $g->message .= ' <b>We are giving you one chance to fix the time value which we think is wrong.</b> ';


        $g->action = '/ax1/build_a_banking_transaction_for_balances_processor/page';
        $g->heading_one = 'Create Transaction';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'banking_transaction_form.php';
    }
}