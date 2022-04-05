<?php

namespace GoodToKnow\Models;

use function GoodToKnow\ControllerHelpers\order_by_sequence_number;

class community_to_topic extends good_object
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
     * @param int $topic_id
     * @return string|bool
     */
    public static function derive_community_id(int $topic_id)
    {
        global $g;

        $sql = 'SELECT * FROM `community_to_topic`
        WHERE `topic_id` = "' . $g->db->real_escape_string((string)$topic_id) . '" LIMIT 1';

        $array_of_objects = community_to_topic::find_by_sql($sql);

        if (!$array_of_objects) {

            $g->message .= ' derive_community_id says: Failed to get a community_to_topic object. ';

            return false;

        }

        $communitytotopic_object = array_shift($array_of_objects);

        if (!is_object($communitytotopic_object)) {

            $g->message .= ' derive_community_id says: Unexpectedly return value is not an object. ';

            return false;
        }

        return $communitytotopic_object->community_id;
    }


    /**
     * @param int $community_id
     * @return array|bool
     */
    public static function get_array_of_topic_objects_for_a_community(int $community_id)
    {
        /**
         * This method gets all the topic objects for a community when given a community id.
         */

        global $g;

        // get (in array) all the community_to_topic objects with a particular $community_id.
        $array_of_community_to_topic = [];

        $count = 0;

        $x = null;

        $sql = 'SELECT *
                FROM `community_to_topic`
                WHERE `community_id` = ?';

        try {
            $stmt = $g->db->stmt_init();

            if (!$stmt->prepare($sql)) {

                $g->message .= ' ' . $stmt->error . ' ';

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

                    while ($x = $result->fetch_object('\GoodToKnow\Models\community_to_topic')) {

                        $array_of_community_to_topic[] = $x;

                        $count += 1;
                    }

                    $stmt->close();

                    $result->close();

                }
            }
        } catch (\Exception $e) {

            $g->message .= ' community_to_topic::get_array_of_topic_objects_for_a_community() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        if ($count < 1) {

            $g->message .= ' community_to_topic::get_array_of_topic_objects_for_a_community() says: Errno 17. ';

            return false;

        }


        // get (in array) all the topics listed in $array_of_community_to_topic.

        $array_of_topics = [];

        foreach ($array_of_community_to_topic as $item) {

            $array_of_topics[] = topic::find_by_id($item->topic_id);

        }

        if (empty($array_of_topics)) {

            $g->message .= ' community_to_topic::get_array_of_topic_objects_for_a_community()() says: Errno 18. ';

            return false;

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'order_by_sequence_number.php';

        order_by_sequence_number($array_of_topics);

        return $array_of_topics;
    }


    /**
     * @param int $community_id
     * @return array|bool
     */
    public static function get_topics_array_for_a_community(int $community_id)
    {
        /**
         * This method gets a $special_topics_array (if you know what I mean.)
         */

        $topics_array = community_to_topic::get_array_of_topic_objects_for_a_community($community_id);

        if (empty($topics_array)) {

            return false;

        }

        $special_topics_array = [];

        foreach ($topics_array as $item) {

            $special_topics_array[$item->id] = $item->topic_name;

        }

        return $special_topics_array;
    }
}