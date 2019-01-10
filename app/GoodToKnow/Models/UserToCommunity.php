<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/6/18
 * Time: 6:25 PM
 */

namespace GoodToKnow\Models;


class UserToCommunity extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "user_to_community";

    /**
     * @var array
     */
    protected static $fields = ['id', 'user_id', 'community_id'];

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
    public $community_id;

    public static function coms_user_belongs_to(\mysqli $db, string &$error, int $user_id)
    {

    }
}