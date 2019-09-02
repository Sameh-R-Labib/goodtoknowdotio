<?php

namespace GoodToKnow\Models;

class PossibleTaxDeduction extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "possible_tax_deduction";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'label', 'year_paid', 'comment'];

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
     * @var int
     */
    public $year_paid;

    /**
     * @var string
     */
    public $comment;
}