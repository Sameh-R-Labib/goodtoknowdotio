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

    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $message_id
     * @return bool
     */
    public static function delete_all_having_particular_message_id(\mysqli $db, string &$error, int $message_id)
    {
        /**
         * It will return false if an error occurs while
         * trying to delete_all_having_particular_message_id
         *
         * Otherwise, it will return true (even if nothing
         * was deleted.)
         */

        // Formulate the sql for the delete
        $sql = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE `message_id`={$message_id}";

        try {
            $db->query($sql);
            $query_error = $db->error;
            if (!empty($query_error)) {
                $error .= ' The delete failed. The reason given by mysqli is: ' . htmlentities($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';
                return false;
            }
        } catch (\Exception $e) {
            $error .= ' MessageToUser delete_all_having_particular_message_id() caught a thrown exception: ' . htmlentities($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;
        }

        return true;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $user_id
     * @return array|bool|mixed
     */
    public static function get_array_of_message_objects_for_a_user(\mysqli $db, string &$error, int $user_id)
    {
        /**
         * Sequential ordering (by time created) will take place
         * on the array before it is returned. The first array
         * item will be the one which was created last.
         */

        // get (in array) all the MessageToUser objects with a particular $user_id.
        $array_of_MessageToUser = [];
        $count = 0;
        $x = null;
        $sql = 'SELECT *
                FROM `message_to_user`
                WHERE `user_id` = ?';
        try {
            $stmt = $db->stmt_init();
            if (!$stmt->prepare($sql)) {
                $error .= ' ' . $stmt->error . ' ';
                return false;
            } else {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $numrows = $result->num_rows;
                if (!$numrows) {
                    $stmt->close();
                    return false;
                } else {
                    while ($x = $result->fetch_object('\GoodToKnow\Models\MessageToUser')) {
                        $array_of_MessageToUser[] = $x;
                        $count += 1;
                    }
                    $stmt->close();
                    $result->close();
                }
            }
        } catch (\Exception $e) {
            $error .= ' MessageToUser::get_array_of_message_objects_for_a_user() caught a thrown exception: ' .
                htmlentities($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
            return false;
        }

        if ($count < 1) {
            $error .= ' MessageToUser::get_array_of_message_objects_for_a_user() says: Errno 87. ';
            return false;
        }

        /**
         * Now we have all the MessageToUser objects for the user.
         * But what we want is the Message objects for the user.
         */
        $array_of_Messages = [];
        foreach ($array_of_MessageToUser as $item) {
            $array_of_Messages[] = Message::find_by_id($db, $error, $item->message_id);
        }
        if (empty($array_of_Messages)) {
            $error .= ' MessageToUser::get_array_of_message_objects_for_a_user() says: Errno 88. ';
            return false;
        }

        self::order_messages_by_time($array_of_Messages);

        return $array_of_Messages;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param array $inbox_messages_array
     * @return bool
     */
    public static function replace_attributes(\mysqli $db, string &$error, array &$inbox_messages_array)
    {
        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         *
         * Assumes $inbox_messages_array is not empty.
         */
        foreach ($inbox_messages_array as $message_object) {
            $message_object->user_id = self::get_username($db, $error, $message_object->user_id);
            if ($message_object->user_id === false) {
                $error .= " MessageToUser::replace_attributes says: get_username failed. ";
                return false;
            }
            $message_object->created = self::get_readable_time($db, $error, $message_object->created);
        }
        return true;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $user_id
     * @return bool
     */
    public static function get_username(\mysqli $db, string &$error, $user_id)
    {
        $user_id = (int)$user_id;
        $user = User::find_by_id($db, $error, $user_id);
        // Value of $user can be false
        if ($user === false) {
            return false;
        }
        return $user->username;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $created
     * @return string
     */
    public static function get_readable_time(\mysqli $db, string &$error, $created)
    {
        $created = (int)$created;
        $date = date('m/d/Y h:i:s a ', $created) . date_default_timezone_get();
        return $date;
    }

    /**
     * @param array $message_objects
     */
    public static function order_messages_by_time(array &$message_objects)
    {
        /**
         * They will be ordered from most recent to oldest.
         */

        if (empty($message_objects)) {
            $_SESSION['message'] = " MessageToUser::order_messages_by_time says: Do not pass Go. Do not collect 100 dollars. ";
            redirect_to("/ax1/Home/page");
        }

        $sorted = [];

        $count = count($message_objects);

        while ($count > 0) {
            $sorted[] = self::message_which_is_most_recent($message_objects);
            $count -= 1;
        }

        $message_objects = $sorted;
    }

    /**
     * @param array $message_objects
     * @return mixed
     */
    public static function message_which_is_most_recent(array &$message_objects)
    {
        if (empty($message_objects)) {
            $_SESSION['message'] = " MessageToUser::message_which_is_most_recent says: Do not pass Go. Do not collect 300 dollars. ";
            redirect_to("/ax1/Home/page");
        }

        $key_of_most_recent = -1;
        $time_of_most_recent = 0;

        foreach ($message_objects as $key => $object) {
            if ($object->created > $time_of_most_recent) {
                $key_of_most_recent = $key;
                $time_of_most_recent = $object->created;
            }
        }

        if ($key_of_most_recent == -1) {
            $_SESSION['message'] = " MessageToUser::message_which_is_most_recent says: Error 524210. ";
            redirect_to("/ax1/Home/page");
        }

        $message_which_is_most_recent = $message_objects[$key_of_most_recent];

        unset($message_objects[$key_of_most_recent]);

        return $message_which_is_most_recent;
    }
}