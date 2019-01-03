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

    public static function purge_all_messages_older_than_date(\mysqli $db, string &$error, int $timestamp)
    {
        /**
         * Actually it will delete both the message records
         * and their corresponding MessageToUser records.
         *   1) Find all old messages.
         *   2) Delete all MessageToUser records which correspond to found messages.
         *   3) Delete the old messages.
         *   4) Return true or false.
         */

        /**
         * 1) Find all old messages.
         */

        // Compose the sql.
        $sql = "SELECT * FROM " . self::$table_name . " WHERE `created`<" . $db->real_escape_string($timestamp);

        $array_of_found_messages = self::find_by_sql($db, $error, $sql);

        // Handling the case where an unexpected error occured
        if ($array_of_found_messages === false) {
            $error .= " An error occured while trying to find messages. ";
            return false;
        }

        // Handling the case where NO old messages exist
        if (empty($array_of_found_messages)) {
            return true;
        }

        /**
         * 2) Delete all MessageToUser records which correspond to found messages.
         */
        foreach ($array_of_found_messages as $found_message) {

        }
    }
}