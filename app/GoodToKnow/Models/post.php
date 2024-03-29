<?php

namespace GoodToKnow\Models;

class post extends good_object
{
    /**
     * @var string
     */
    protected static $table_name = "posts";

    /**
     * @var array
     */
    protected static $fields = ['id', 'sequence_number', 'title', 'extensionfortitle', 'user_id', 'created',
        'markdown_file', 'html_file'];

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
    public $title;

    /**
     * @var string
     */
    public $extensionfortitle;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $created;

    /**
     * @var string
     */
    public $markdown_file;

    /**
     * @var string
     */
    public $html_file;
}