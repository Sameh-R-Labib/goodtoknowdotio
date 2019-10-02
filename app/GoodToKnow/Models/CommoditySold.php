<?php

namespace GoodToKnow\Models;

class CommoditySold extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "commodities_sold";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'time_bought', 'time_sold', 'price_bought', 'price_sold',
        'currency_transacted', 'commodity_amount', 'commodity_type', 'commodity_label', 'tax_year', 'profit'];

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
    public $time_bought;

    /**
     * @var int
     */
    public $time_sold;

    /**
     * @var float
     */
    public $price_bought;

    /**
     * @var float
     */
    public $price_sold;

    /**
     * @var string
     */
    public $currency_transacted;

    /**
     * @var float
     */
    public $commodity_amount;

    /**
     * @var string
     */
    public $commodity_type;

    /**
     * @var string
     */
    public $commodity_label;

    /**
     * @var int
     */
    public $tax_year;

    /**
     * @var float
     */
    public $profit;
}