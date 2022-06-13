<?php

namespace GoodToKnow\Models;

class bank_account_observer extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "bank_account_observer";

    /**
     * @var array
     */
    protected static $fields = ['id', 'observer_id', 'owner_id', 'account_id'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $observer_id;

    /**
     * @var int
     */
    public $owner_id;

    /**
     * @var int
     */
    public $account_id;
}