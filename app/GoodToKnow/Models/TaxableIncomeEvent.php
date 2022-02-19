<?php

namespace GoodToKnow\Models;

class TaxableIncomeEvent extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "taxable_income_event";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'time', 'year_received', 'currency', 'amount', 'price', 'fiat', 'label', 'comment'];

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
    public $time;

    /**
     * @var int
     */
    public $year_received;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var float
     */
    public $price;

    /**
     * @var string
     */
    public $fiat;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $comment;
}