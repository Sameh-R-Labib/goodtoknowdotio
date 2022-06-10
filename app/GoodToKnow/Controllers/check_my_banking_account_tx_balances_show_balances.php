<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\banking_acct_for_balances;
use GoodToKnow\Models\banking_transaction_for_balances;

class check_my_banking_account_tx_balances_show_balances
{
    function page()
    {
        /**
         * This function will:
         * 1) Get (from the database) the banking_acct_for_balances object.
         * 1b) Verify that the account belongs to the user. This is redundant for
         *     the "See Transactions" feature but is needed when Create or Edit use
         *     this route handler.
         * 2) Get (from the database) all the banking_transaction_for_balances which
         *    have a time stamp greater than the start time for the account. Note:
         *    it can't be equal to the start time. Also: make sure the transactions
         *    are ordered by time increasing. Obviously, these transactions must be
         *    for the user who is requesting this stuff. Also, these transactions must
         *    be for the currently chosen banking_acct_for_balances.
         * 3) Augment our data set with a running total in each banking_transaction_for_balances
         *    object. This gets assigned to each banking_transaction_for_balances object's balance field.
         * 3b) reset_feature_session_vars()
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         *    will be wrong if Admin has deleted transactions older than 90 days and the start
         *    time for the banking_acct_for_balances is set to a time older than 90 days.
         *    Also, show the account name for banking_acct_for_balances at the top of the ledger.
         *    Also, transform field data to a more human friendly format.
         *
         *    Reverse the order of the transactions before displaying them.
         */


        global $g;
        // $g->saved_int01 id of banking_acct_for_balances record


        kick_out_loggedoutusers();


        $g->db = get_db();


        /**
         * 1) Get (from the database) the banking_acct_for_balances object.
         */

        $g->account = banking_acct_for_balances::find_by_id($g->saved_int01);

        if (!$g->account) {

            breakout(' Unexpectedly I could not find that banking account for balances. ');

        }


        /**
         * 1b) Verify that the account belongs to the user. This is redundant for
         *     the "See Transactions" feature but is needed when Create or Edit use
         *     this route handler.
         */

        if ($g->account->user_id != $g->user_id) {

            breakout(' Error 68804576. ');

        }


        /**
         * 2) Get (from the database) all the banking_transaction_for_balances which
         * have a time stamp greater than the start time for the account. Note:
         * it can't be equal to the start time. Also: make sure the transactions
         * are ordered by time increasing. Obviously, these transactions must be
         * for the user who is requesting this stuff. Also, these transactions must
         * be for the currently chosen banking_acct_for_balances.
         */

        $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = ' . $g->db->real_escape_string((string)$g->user_id);
        $sql .= ' AND `bank_id` = ' . $g->db->real_escape_string((string)$g->account->id);
        $sql .= ' AND `time` > ' . $g->db->real_escape_string((string)$g->account->start_time);
        $sql .= ' ORDER BY `time` ASC';

        $g->array = banking_transaction_for_balances::find_by_sql($sql);

        if (!$g->array) {

            $g->message .= " I could NOT find any bank account transactions ¯\_(ツ)_/¯. ";

            // We need this to not error out.
            $g->array = [];

        }


        /**
         * 3) Augment our data set with a running total in each banking_transaction_for_balances
         * object. This gets assigned to each banking_transaction_for_balances object's balance field.
         */

        $running_total = (float)$g->account->start_balance;

        foreach ($g->array as $transaction) {

            $running_total += (float)$transaction->amount;

            if (abs($running_total) >= 0.0000000000000001) {

                $transaction->balance = $running_total;

            } else {

                $transaction->balance = 0.0;

            }

        }


        /**
         * 3b) reset_feature_session_vars()
         */

        reset_feature_session_vars();


        /**
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         * will be wrong if Admin has deleted transactions older than 90 days and the start
         * time for the banking_acct_for_balances is set to a time older than 90 days.
         * Also, show the account name for banking_acct_for_balances at the top of the ledger.
         * Also, transform field data to a more human friendly format.
         *
         * banking_transaction_for_balances fields in need of transforming:
         * - amount [comma separator for thousands]
         * - time [human-readable time]
         * - balance [comma separator for thousands]
         *
         * banking_acct_for_balances fields in need of transformation.
         * - start_time [human-readable time]
         * - start_balance [comma separator for thousands]
         *
         * Reverse the order of the transactions before displaying them.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';


        foreach ($g->array as $transaction) {

            $transaction->amount = readable_amount_of_money($g->account->currency, $transaction->amount);
            $transaction->balance = readable_amount_of_money($g->account->currency, (string)$transaction->balance);

            $transaction->time = get_readable_time($transaction->time);

        }


        $g->account->start_time = get_readable_time($g->account->start_time);
        $g->account->start_balance = readable_amount_of_money($g->account->currency, $g->account->start_balance);


        // Reverse the order

        $g->array = array_reverse($g->array);


        $g->html_title = 'Transactions';


        $g->page = 'check_my_banking_account_tx_balances';


        $g->show_poof = true;


        $g->message .= ' Here are your transactions and their balances. ';


        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalancesshowbalances.php';
    }
}