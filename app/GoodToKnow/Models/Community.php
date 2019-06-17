<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/31/18
 * Time: 9:29 PM
 */

namespace GoodToKnow\Models;


class Community extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "communities";

    /**
     * @var array
     */
    protected static $fields = ['id', 'community_name', 'community_description'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $community_name;

    /**
     * @var string
     */
    public $community_description;

    /**
     * @param string $message
     * @param string $description
     * @return bool
     */
    public static function is_community_description(string &$message, string &$description)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 230 bytes long.
         * Can't contain any html tags
         */
        $description = trim($description);

        if (empty($description)) {
            $message .= " Your description is missing. ";
            return false;
        }

        $length = strlen($description);
        if ($length > 230) {
            $message .= " Your description is too long. ";
            return false;
        }

        if ($description != strip_tags($description)) {
            $message .= " Your description includes html. We don't allow that in this field. ";
            return false;
        }

        return true;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param string $community_name
     * @return bool|mixed
     */
    public static function find_by_community_name(\mysqli $db, string &$error, string $community_name)
    {
        /**
         * You give it a username and it returns the
         * corresponding User object or false.
         */
        $sql = 'SELECT * FROM `communities`
                WHERE `community_name` = "' . $db->real_escape_string($community_name) . '" LIMIT 1';

        $array_of_Community_objects = parent::find_by_sql($db, $error, $sql);

        if (!$array_of_Community_objects || !empty($error)) {
            return false;
        }

        return array_shift($array_of_Community_objects);
    }
}