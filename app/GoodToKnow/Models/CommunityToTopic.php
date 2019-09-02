<?php

namespace GoodToKnow\Models;

use mysqli;

class CommunityToTopic extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "community_to_topic";

    /**
     * @var array
     */
    protected static $fields = ['id', 'community_id', 'topic_id'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $community_id;

    /**
     * @var int
     */
    public $topic_id;


    /**
     * @param mysqli $db
     * @param string $error
     * @param int $topic_id
     * @return bool
     */
    public static function derive_community_id(mysqli $db, string &$error, int $topic_id)
    {
        $sql = 'SELECT * FROM `community_to_topic`
        WHERE `topic_id` = "' . $db->real_escape_string($topic_id) . '" LIMIT 1';

        $array_of_objects = CommunityToTopic::find_by_sql($db, $error, $sql);

        if (!$array_of_objects || !empty($error)) {

            $error .= ' derive_community_id says: Failed to get a CommunityToTopic object. ';

            return false;

        }

        $communitytotopic_object = array_shift($array_of_objects);

        if (!is_object($communitytotopic_object)) {

            $error .= ' derive_community_id says: Unexpectedly return value is not an object. ';

            return false;
        }

        return $communitytotopic_object->community_id;
    }


    /**
     * @param mysqli $db
     * @param string $error
     * @param int $community_id
     * @return array|bool
     */
    public static function get_array_of_topic_objects_for_a_community(mysqli $db, string &$error, int $community_id)
    {
        // get (in array) all the CommunityToTopic objects with a particular $community_id.
        $array_of_CommunityToTopic = [];

        $count = 0;

        $x = null;

        $sql = 'SELECT *
                FROM `community_to_topic`
                WHERE `community_id` = ?';

        try {
            $stmt = $db->stmt_init();

            if (!$stmt->prepare($sql)) {

                $error .= ' ' . $stmt->error . ' ';

                return false;

            } else {

                $stmt->bind_param('i', $community_id);

                $stmt->execute();

                $result = $stmt->get_result();

                $numrows = $result->num_rows;

                if (!$numrows) {

                    $stmt->close();

                    return false;

                } else {

                    while ($x = $result->fetch_object('\GoodToKnow\Models\CommunityToTopic')) {

                        $array_of_CommunityToTopic[] = $x;

                        $count += 1;
                    }

                    $stmt->close();

                    $result->close();

                }
            }
        } catch (\Exception $e) {

            $error .= ' CommunityToTopic::get_array_of_topic_objects_for_a_community() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        if ($count < 1) {

            $error .= ' CommunityToTopic::get_array_of_topic_objects_for_a_community() says: Errno 17. ';

            return false;

        }


        // get (in array) all the topics listed in $array_of_CommunityToTopic.

        $array_of_Topics = [];

        foreach ($array_of_CommunityToTopic as $item) {

            $array_of_Topics[] = Topic::find_by_id($db, $error, $item->topic_id);

        }

        if (empty($array_of_Topics)) {

            $error .= ' CommunityToTopic::get_array_of_topic_objects_for_a_community()() says: Errno 18. ';

            return false;

        }

        self::order_topics_by_sequence_number($array_of_Topics);

        return $array_of_Topics;
    }


    /**
     * @param mysqli $db
     * @param string $error
     * @param int $community_id
     * @return array|bool
     */
    public static function get_topics_array_for_a_community(mysqli $db, string &$error, int $community_id)
    {
        $topics_array = CommunityToTopic::get_array_of_topic_objects_for_a_community($db, $error, $community_id);

        if (empty($topics_array) || $topics_array === false) {

            return false;

        }

        $special_topics_array = [];

        foreach ($topics_array as $item) {

            $special_topics_array[$item->id] = $item->topic_name;

        }

        return $special_topics_array;
    }


    /**
     * @param array $topic_objects
     */
    public static function order_topics_by_sequence_number(array &$topic_objects)
    {
        if (empty($topic_objects)) {

            breakout(' CommunityToTopic::order_topics_by_sequence_number says: Do not pass Go. Do not collect 200 dollars. ');

        }

        $sorted = [];

        $count = count($topic_objects);

        $temp = $topic_objects;

        while ($count > 0) {

            $sorted[] = self::topic_having_lowest_sequence_number($temp);

            $count -= 1;

        }

        $topic_objects = $sorted;
    }


    /**
     * @param array $temp
     * @return mixed
     */
    public static function topic_having_lowest_sequence_number(array &$temp)
    {
        if (empty($temp)) {

            breakout(' CommunityToTopic::topic_having_lowest_sequence_number says: Do not pass Go. Do not collect 200 dollars. ');

        }

        $key_of_lowest = -1;

        $lowest_sequence_number = 21000001;

        foreach ($temp as $key => $object) {

            if ($object->sequence_number <= $lowest_sequence_number) {

                $key_of_lowest = $key;

                $lowest_sequence_number = $object->sequence_number;

            }
        }

        if ($key_of_lowest == -1) {

            breakout(' CommunityToTopic::topic_having_lowest_sequence_number says: Error 124212. ');

        }

        $topic_with_lowest_sequence_number = $temp[$key_of_lowest];

        unset($temp[$key_of_lowest]);

        return $topic_with_lowest_sequence_number;
    }
}