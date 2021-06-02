<?php

namespace GoodToKnow\Models;

use Exception;
use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\order_them_from_most_recent_to_oldest;


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
     * @param $user_id
     * @return bool|mixed
     */
    public static function user_message_quantity($user_id)
    {
        global $db;
        global $app_state;

        $sql = "SELECT COUNT(*) FROM message_to_user WHERE user_id=" . $user_id;

        try {
            $result = $db->query($sql);

            $query_error = $db->error;

            if (!empty(trim($query_error))) {

                $app_state->message .= ' The count failed. The reason given by mysqli is: ' . $query_error . ' ';

                return false;

            }
        } catch (Exception $e) {

            $app_state->message .= ' GoodObject count_all() caught a thrown exception: ' . $e->getMessage() . ' ';

            return false;

        }

        if (!$result->num_rows) {

            $app_state->message .= ' count_all failed. ';

            return false;

        }

        $row = $result->fetch_row();

        return array_shift($row);
    }


    /**
     * @param int $message_id
     * @return bool
     */
    public static function delete_all_having_particular_message_id(int $message_id): bool
    {
        /**
         * It will return false if an error occurs while
         * trying to delete_all_having_particular_message_id
         *
         * Otherwise, it will return true (even if nothing
         * was deleted.)
         */

        global $db;
        global $app_state;

        // Formulate the sql for the delete

        $sql = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE `message_id`={$message_id}";

        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty($query_error)) {

                $app_state->message .= ' The delete failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;

            }
        } catch (Exception $e) {

            $app_state->message .= ' MessageToUser delete_all_having_particular_message_id() caught a thrown exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        return true;

    }


    /**
     * @param int $message_id
     * @param int $user_id
     * @return bool
     */
    public static function delete_all_particular(int $message_id, int $user_id): bool
    {
        /**
         * It will return false if an error occurs while trying to delete.
         * Otherwise, it will return true (even if nothing was deleted.)
         */

        global $db;
        global $app_state;

        $sql = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE `message_id`={$message_id} AND `user_id`={$user_id}";


        try {
            $db->query($sql);

            $query_error = $db->error;

            if (!empty($query_error)) {

                $app_state->message .= ' The delete failed. The reason given by mysqli is: ' . htmlspecialchars($query_error, ENT_NOQUOTES | ENT_HTML5) . ' ';

                return false;

            }
        } catch (Exception $e) {

            $app_state->message .= ' MessageToUser delete_all_particular() caught a thrown exception: ' . htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        return true;
    }


    /**
     * @param int $user_id
     * @return array|bool
     */
    public static function get_array_of_message_objects_for_a_user(int $user_id)
    {
        /**
         * Sequential ordering (by time created) will take place
         * on the array before it is returned. The first array
         * item will be the one which was created last.
         */

        global $db;
        global $app_state;

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

                $app_state->message .= ' ' . $stmt->error . ' ';

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
        } catch (Exception $e) {

            $app_state->message .= ' MessageToUser::get_array_of_message_objects_for_a_user() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;
        }

        if ($count < 1) {

            $app_state->message .= ' MessageToUser::get_array_of_message_objects_for_a_user() says: Errno 87. ';

            return false;

        }


        /**
         * Now we have all the MessageToUser objects for the user.
         * But what we want is the Message objects for the user.
         */

        $array_of_Messages = [];

        foreach ($array_of_MessageToUser as $item) {

            $array_of_Messages[] = Message::find_by_id($item->message_id);

        }

        if (empty($array_of_Messages)) {

            $app_state->message .= ' MessageToUser::get_array_of_message_objects_for_a_user() says: Errno 88. ';

            return false;

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'order_them_from_most_recent_to_oldest.php';

        order_them_from_most_recent_to_oldest($array_of_Messages, 'created');

        return $array_of_Messages;
    }


    /**
     * @param array $inbox_messages_array
     * @return bool
     */
    public static function replace_attributes(array &$inbox_messages_array): bool
    {
        global $app_state;


        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';


        /**
         * Replace (in each Message) the user_id and created with a username and a datetime.
         *
         * Assumes $inbox_messages_array is not empty.
         */

        foreach ($inbox_messages_array as $message_object) {

            $message_object->user_id = self::get_username($message_object->user_id);

            if ($message_object->user_id === false) {

                $app_state->message .= " MessageToUser::replace_attributes says: get_username failed. ";

                return false;

            }

            $message_object->created = get_readable_time($message_object->created);
        }

        return true;
    }


    /**
     * @param $user_id
     * @return false|string
     */
    public static function get_username($user_id)
    {
        $user_id = (int)$user_id;

        $user = User::find_by_id($user_id);


        // Value of $user can be false

        if ($user === false) {

            return false;

        }

        return $user->username;
    }
}