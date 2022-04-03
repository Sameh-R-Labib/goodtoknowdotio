<?php

namespace GoodToKnow\Models;

class recurring_payment extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "recurring_payment";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'label', 'currency', 'amount_paid', 'time', 'comment'];

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
    public $label;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var float
     */
    public $amount_paid;

    /**
     * @var int
     */
    public $time;

    /**
     * @var string
     */
    public $comment;
}