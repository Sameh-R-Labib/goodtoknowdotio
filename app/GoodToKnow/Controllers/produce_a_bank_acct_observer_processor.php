<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\is_username_syntactandexists;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class produce_a_bank_acct_observer_processor
{
    function page()
    {
        /**
         * The user submitted a form containing observer_username.
         *
         * Basically what needs to be accomplished here is to validate the submitted observer_username and present
         * the next form (which is for entering the bank account id.) We MUST also save (in the session) the user id
         * (namely observer_id) which corresponds to observer_username.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Read the username.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $observer_username = standard_form_field_prep('observer_username', 7, 12);


        /**
         * Make sure $observer_username is valid.
         */

        get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'is_username_syntactandexists.php';

        $is_username = is_username_syntactandexists($observer_username);

        if (!$is_username) {

            breakout(' The username is not valid. ');

        }

        $_SESSION['saved_str01'] = $observer_username;


        /**
         * Compose the banking objects view.
         * The user will be presented with (to choose from) buttons for his / her bank accounts
         */


        get_db();


        // This flag helps with avoid a premature breakout() in get_bankingaccountsforbalances.php
        // when used in check_my_banking_account_tx_balances.
        $g->is_show_bank_account_transactions = false;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        /**
         * Summon the view.
         */


        $g->html_title = "Choose Bank Account";

        require VIEWS . DIRSEP . 'produceabankacctobserverprocessor.php';
    }
}