<?php

namespace GoodToKnow\Models;

class BankingAcctForBalances extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "banking_acct_for_balances";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'acct_name', 'start_time', 'start_balance', 'currency', 'comment'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var string
     */
    public $acct_name;

    /**
     * @var int
     */
    public $start_time;

    /**
     * @var float
     */
    public $start_balance;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $comment;
}