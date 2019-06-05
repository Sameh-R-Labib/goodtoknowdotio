<?php


namespace GoodToKnow\Models;


class Bitcoin extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "bitcoin";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'address', 'initial_balance', 'current_balance', 'price_point',
        'unix_time_at_purchase', 'comment'];

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
    public $address;

    /**
     * @var float
     */
    public $initial_balance;

    /**
     * @var float
     */
    public $current_balance;

    /**
     * @var float
     */
    public $price_point;

    /**
     * @var int
     */
    public $unix_time_at_purchase;

    /**
     * @var string
     */
    public $comment;
}