<?php

namespace GoodToKnow\Models;

class banking_transaction_for_balances extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "banking_transaction_for_balances";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'bank_id', 'label', 'amount', 'time'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $bank_id;

    /**
     * @var string
     */
    public $label;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var int
     */
    public $time;

    /**
     * Not part of the database record.
     *
     * @var float
     */
    public $balance;
}