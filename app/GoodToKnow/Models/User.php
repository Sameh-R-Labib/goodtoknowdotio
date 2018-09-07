<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/6/18
 * Time: 12:07 AM
 */

namespace GoodToKnow\Models;


class User extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "users";

    /**
     * @var array
     */
    protected static $fields = ['id', 'username', 'password', 'id_of_default_community', 'title', 'role',
        'race', 'is_suspended', 'date', 'comment'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var int
     */
    public $id_of_default_community;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $race;

    /**
     * @var int
     */
    public $is_suspended;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $comment;

    /**
     * @param \mysqli $db
     * @param string $error
     * @param string $username
     * @return bool
     */
    public static function is_taken_username(\mysqli $db, string &$error, string $username)
    {
        $sql = 'SELECT username FROM `users`
                WHERE `username` = "' . $username . '" LIMIT 1';

        $array_of_User_objects = parent::find_by_sql($db, $error, $sql);

        if (!$array_of_User_objects) {
            return false;
        }

        return true;
    }
}