<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/30/18
 * Time: 3:19 PM
 */

namespace GoodToKnow\Models;


class Message extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "messages";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'created', 'content'];

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
    public $created;

    /**
     * @var string
     */
    public $content;
}