<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/16/18
 * Time: 4:24 PM
 */

namespace GoodToKnow\Models;


class Post extends GoodObject
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
     * @var string
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