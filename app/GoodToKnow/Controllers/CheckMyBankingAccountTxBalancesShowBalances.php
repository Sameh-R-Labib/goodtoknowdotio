<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\is_crypto;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingAcctForBalances;
use GoodToKnow\Models\BankingTransactionForBalances;

class CheckMyBankingAccountTxBalancesShowBalances
{
    function page()
    {
        /**
         * This function will:
         * 1) Get (from the database) the BankingAcctForBalances object.
         * 2) Get (from the database) all the BankingTransactionForBalances which
         *    have a time stamp greater than the start time for the account. Note:
         *    it can't be equal to the start time. Also: make sure the transactions
         *    are ordered by time increasing. Obviously, these transactions must be
         *    for the user who is requesting this stuff. Also, these transactions must
         *    be for the currently chosen BankingAcctForBalances.
         * 3) Augment our data set with a running total in each BankingTransactionForBalances
         *    object. This gets assigned to each BankingTransactionForBalances object's balance field.
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         *    will be wrong if admin has deleted transactions older than 90 days and the start
         *    time for the BankingAcctForBalances is set to a time older than 90 days.
         *    Also, show the account name for BankingAcctForBalances at the top of the ledger.
         *    Also, transform field data to a more human friendly format.
         *
         *    Reverse the order of the transactions before displaying them.
         */


        global $g;
        // $g->saved_int01 id of BankingAcctForBalances record


        kick_out_loggedoutusers();


        $g->db = get_db();


        /**
         * 1) Get (from the database) the BankingAcctForBalances object.
         */

        $g->account = BankingAcctForBalances::find_by_id($g->saved_int01);

        if (!$g->account) {

            breakout(' Unexpectedly I could not find that banking account for balances. ');

        }


        /**
         * 2) Get (from the database) all the BankingTransactionForBalances which
         * have a time stamp greater than the start time for the account. Note:
         * it can't be equal to the start time. Also: make sure the transactions
         * are ordered by time increasing. Obviously, these transactions must be
         * for the user who is requesting this stuff. Also, these transactions must
         * be for the currently chosen BankingAcctForBalances.
         */

        $sql = 'SELECT * FROM `banking_transaction_for_balances` WHERE `user_id` = ' . $g->db->real_escape_string($g->user_id);
        $sql .= ' AND `bank_id` = ' . $g->db->real_escape_string($g->account->id);
        $sql .= ' AND `time` > ' . $g->db->real_escape_string($g->account->start_time);
        $sql .= ' ORDER BY `time` ASC';

        $g->array = BankingTransactionForBalances::find_by_sql($sql);

        if (!$g->array || !empty($g->message)) {

            breakout(' I could NOT find any bank account transactions ¯\_(ツ)_/¯ ');

        }


        /**
         * 3) Augment our data set with a running total in each BankingTransactionForBalances
         * object. This gets assigned to each BankingTransactionForBalances object's balance field.
         */

        $running_total = $g->account->start_balance;

        foreach ($g->array as $transaction) {

            $running_total += $transaction->amount;

            if (abs($running_total) >= abs(0.00000000001)) {

                $transaction->balance = $running_total;

            } else {

                $transaction->balance = 0.0;

            }

        }


        /**
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         * will be wrong if admin has deleted transactions older than 90 days and the start
         * time for the BankingAcctForBalances is set to a time older than 90 days.
         * Also, show the account name for BankingAcctForBalances at the top of the ledger.
         * Also, transform field data to a more human friendly format.
         *
         * BankingTransactionForBalances fields in need of transforming:
         * - amount [comma separator for thousands]
         * - time [human readable time]
         * - balance [comma separator for thousands]
         *
         * BankingAcctForBalances fields in need of transformation.
         * - start_time [human readable time]
         * - start_balance [comma separator for thousands]
         *
         * Reverse the order of the transactions before displaying them.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'is_crypto.php';


        foreach ($g->array as $transaction) {

            if (is_crypto($g->account->currency)) {

                $transaction->amount = number_format($transaction->amount, 8);
                $transaction->balance = number_format($transaction->balance, 8);

            } else {

                $transaction->amount = number_format($transaction->amount, 2);
                $transaction->balance = number_format($transaction->balance, 2);

            }

            $transaction->time = get_readable_time($transaction->time);

        }


        $g->account->start_time = get_readable_time($g->account->start_time);
        $g->account->start_balance = readable_amount_of_money($g->account->currency, $g->account->start_balance);


        // Reverse the order

        $g->array = array_reverse($g->array);


        $g->html_title = 'Transactions';


        $g->page = 'CheckMyBankingAccountTxBalances';


        $g->show_poof = true;


        $g->message .= ' Here are your transactions and their balances. ';


        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalancesshowbalances.php';
    }
}