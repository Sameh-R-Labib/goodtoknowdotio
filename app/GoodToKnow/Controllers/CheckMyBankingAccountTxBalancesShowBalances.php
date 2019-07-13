<?php


namespace GoodToKnow\Controllers;


class CheckMyBankingAccountTxBalancesShowBalances
{
    public function page()
    {
        /**
         * This function will:
         * 1) Get (from the database) the BankingAcctForBalances object.
         * 2) Get (from the database) all the BankingTransactionForBalances which
         * have a time stamp greater than the start time for the account. Note:
         * it can't be equal to the start time. Also: make sure the transactions
         * are ordered by time increasing. Obviously, these transactions must be
         * for the user who is requesting this stuff.
         * 3) Augment our data set with a running total in each BankingTransactionForBalances
         * object. This gets assigned to each BankingTransactionForBalances object's balance field.
         * 4) Display our data set as a ledger. Note: Inform the user that the balances
         * will be wrong if admin has deleted transactions older than 90 days and the start
         * time for the BankingAcctForBalances is set to a time older than 90 days.
         */
    }
}