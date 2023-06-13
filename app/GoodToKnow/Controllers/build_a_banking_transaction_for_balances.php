<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_html_select_box_containing_the_bank_accounts;

class build_a_banking_transaction_for_balances
{
    function page(int $default_bank_id = 0)
    {
        /**
         * This feature enables the user to create a database record in the
         * banking_transaction_for_balances table.
         *
         * The significance of $default_bank_id is that (when specified) it
         * causes the $preselected_option_value to be the id of a bank which
         * is to be pre-selected within the drop-down box.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Create a Bank Transaction For Balances';


        /**
         * Get the html for form's select box.
         * It comes with one of the select options marked as selected.
         * When the 2nd argument (banking_id) of get_html_select_box_containing_the_bank_accounts
         * is 0 then none of the choices are marked as selected.
         */

        get_db(); // Is needed for get_html_select_box_containing_the_bank_accounts()

        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $g->account_type = get_html_select_box_containing_the_bank_accounts($g->user_id, $default_bank_id);


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
        $g->saved_arr01['bank_id'] = 0; // This statement serves no programmatic purpose. It's here for completeness.
        // 0 means no choice being selected.
        // A choice is a choice of which bank account.

        // Not Necessary:
        //   Update the session variable
        //   $_SESSION['saved_arr01'] = $g->saved_arr01;


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;

        $g->action = '/ax1/build_a_banking_transaction_for_balances_processor/page';
        $g->heading_one = 'Create Transaction';
        require VIEWSDUPLICATESINCLUDES . DIRSEP . 'banking_transaction_form.php';
    }
}