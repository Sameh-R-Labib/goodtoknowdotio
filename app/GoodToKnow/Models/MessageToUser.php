<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/30/18
 * Time: 9:01 PM
 */

namespace GoodToKnow\Models;


class MessageToUser extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "message_to_user";

    /**
     * @var array
     */
    protected static $fields = ['id', 'message_id', 'user_id'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $message_id;

    /**
     * @var int
     */
    public $user_id;
}