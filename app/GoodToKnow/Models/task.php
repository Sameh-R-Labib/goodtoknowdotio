<?php

namespace GoodToKnow\Models;

class task extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "task";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'label', 'last', 'next', 'cycle_type', 'comment'];

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
    public $last;

    /**
     * @var int
     */
    public $next;

    /**
     * @var string
     */
    public $cycle_type;

    /**
     * @var string
     */
    public $comment;
}