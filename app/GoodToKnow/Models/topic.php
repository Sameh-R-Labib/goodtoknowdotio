<?php

namespace GoodToKnow\Models;

class topic extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "topics";

    /**
     * @var array
     */
    protected static $fields = ['id', 'sequence_number', 'topic_name', 'topic_description'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $sequence_number;

    /**
     * @var string
     */
    public $topic_name;

    /**
     * @var string
     */
    public $topic_description;
}