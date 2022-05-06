<?php

namespace GoodToKnow\Models;

class status extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "status";

    /**
     * @var array
     */
    protected static $fields = ['id', 'name', 'message'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $message;
}