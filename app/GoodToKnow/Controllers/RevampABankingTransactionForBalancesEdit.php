<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\BankingAcctForBalances;
use function GoodToKnow\ControllerHelpers\get_date_h_m_s_from_a_timestamp;
use function GoodToKnow\ControllerHelpers\get_html_select_box_containing_the_bank_accounts;
use function GoodToKnow\ControllerHelpers\readable_amount_no_commas;

class RevampABankingTransactionForBalancesEdit
{
    function page()
    {
        /**
         * 1) Store the submitted banking_transaction_for_balances record id in the session.
         * 2) Retrieve the banking_transaction_for_balances object with that id from the database.
         * 3) Make sure the object belongs to the user.
         * 4) Present a form which is populated with data from the banking_transaction_for_balances object.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->html_title = 'Edit the banking_transaction_for_balances record';


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingtransactionforbalances.php';


        /**
         * 4) Present a form which is populated with data from the banking_transaction_for_balances object.
         *
         * Note: Replace bank_id with the HTML for the drop-down select box. Then use bank_id in the HTML form
         * to supply the HTML for that input field.
         */


        /**
         * Make it so that if price_point is fiat then price_point has only two decimal places.
         *
         * But first we need to discern the currency from the BankingAcctForBalances.
         */

        $g->bank = BankingAcctForBalances::find_by_id($g->object->bank_id);

        if (!$g->bank) {

            breakout(' Unexpectedly I could not find that banking account for balances. ');

        }

        require CONTROLLERHELPERS . DIRSEP . 'readable_amount_no_commas.php';

        $g->object->amount = readable_amount_no_commas($g->bank->currency, $g->object->amount);


        /**
         * Drop down select box html
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_html_select_box_containing_the_bank_accounts.php';

        $g->account_type = get_html_select_box_containing_the_bank_accounts($g->user_id, $g->object->bank_id);


        /**
         * This type of record has a field called `time`. We are not going to pre-populate a form field with it.
         * Instead, we derive an array called $g->time from it and use $g->time to pre-populate the following fields:
         * date, hour, minute, second.
         */

        require CONTROLLERHELPERS . DIRSEP . 'get_date_h_m_s_from_a_timestamp.php';

        $g->time = get_date_h_m_s_from_a_timestamp($g->object->time);


        /**
         * Aside from $g->account_type, assign values to
         * the variables which will appear in the view.
         */

        $g->saved_arr01['label'] = $g->object->label;
        $g->saved_arr01['amount'] = $g->object->amount;
        $g->saved_arr01['date'] = $g->time['date'];
        $g->saved_arr01['hour'] = $g->time['hour'];
        $g->saved_arr01['minute'] = $g->time['minute'];
        $g->saved_arr01['second'] = $g->time['second'];
        $g->saved_arr01['timezone'] = $g->timezone; // user's default timezone
        $g->saved_arr01['bank_id'] = $g->object->bank_id;  // This statement serves no programmatic purpose.
        // It's here for completeness.


        /**
         * This may be redundant, but we need to be sure (better than be sorry.)
         */

        $_SESSION['is_first_attempt'] = true;


        require VIEWS . DIRSEP . 'revampabankingtransactionforbalancesedit.php';
    }
}