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
    protected static $fields = ['id', 'user_id', 'address', 'commodity', 'initial_balance', 'current_balance',
        'currency', 'price_point', 'time', 'comment'];

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
     * @var string
     */
    public $commodity;

    /**
     * @var float
     */
    public $initial_balance;

    /**
     * @var float
     */
    public $current_balance;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var float
     */
    public $price_point;

    /**
     * @var int
     */
    public $time;

    /**
     * @var string
     */
    public $comment;
}