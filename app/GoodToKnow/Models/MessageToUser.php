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
                        $array_of_CommunityToTopic[] = $x;
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
            $array_of_Messages = Message::find_by_id($db, $error, $item->message_id);
        }
        if (empty($array_of_Messages)) {
            $error .= ' MessageToUser::get_array_of_message_objects_for_a_user() says: Errno 88. ';
            return false;
        }

        self::order_messages_by_time($array_of_Messages);

        return $array_of_Messages;
    }
}