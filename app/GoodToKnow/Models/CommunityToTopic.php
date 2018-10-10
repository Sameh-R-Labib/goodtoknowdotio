<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/14/18
 * Time: 9:31 PM
 */

namespace GoodToKnow\Models;


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
     * @param \mysqli $db
     * @param string $error
     * @param int $community_id
     * @return array|bool
     */
    public static function get_array_of_topic_objects_for_a_community(\mysqli $db, string &$error, int $community_id)
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
                htmlentities($e->getMessage(), ENT_QUOTES | ENT_HTML5) . ' ';
        }
        if (!empty($error)) {
            return false;
        }
        if ($count < 1) {
            $error .= ' CommunityToTopic::get_array_of_topic_objects_for_a_community() says: Errno 17. ';
            return false;
        }

        // get (in array) all the posts listed in $array_of_CommunityToTopic.
        $array_of_Topics = [];
        foreach ($array_of_CommunityToTopic as $item) {
            $array_of_Topics[] = Topic::find_by_id($db, $error, $item->topic_id);
        }
        if (empty($array_of_Topics)) {
            $error .= ' CommunityToTopic::get_array_of_topic_objects_for_a_community()() says: Errno 18. ';
            return false;
        }

        return $array_of_Topics;
    }


    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $community_id
     * @return array|bool
     */
    public static function get_topics_array_for_a_community(\mysqli $db, string &$error, int $community_id)
    {
        /**
         * Gets an associative array where the key is the topic_id
         * and the value is the topic name for all the topics which
         * belong to a particular community.
         *
         * I'm using this static method in SetHomePageCommunityTopicPost.
         * But, it will be useful in other places. That is why I'm making it
         * broad in scope.
         */

        /**
         * First we need all the CommunityToTopic objects for $community_id
         * In other words we need an array of CommunityToTopic objects for $community_id
         */
        $sql = 'SELECT * FROM community_to_topic WHERE `community_id`=' . $community_id;
        $community_to_topic_array = CommunityToTopic::find_by_sql($db, $error, $sql);

        if (!$community_to_topic_array) {
            return false;
        }

        /**
         * Build the array I'm looking for (the one for return.)
         */
        $topics_for_this_community = [];
        foreach ($community_to_topic_array as $value) {
            // Talking about the right side of the assignment statement
            // First we're getting a Community object
            $topics_for_this_community[$value->topic_id] = Topic::find_by_id($db, $error, $value->topic_id);
            if (!$topics_for_this_community[$value->topic_id]) {
                $error .= " CommunityToTopic get_topics_array_for_a_community() says err_no 70737. ";
                return false;
            }
            // Then we're getting the community_name from that object
            $topics_for_this_community[$value->topic_id] = $topics_for_this_community[$value->topic_id]->topic_name;
        }

        return $topics_for_this_community;
    }
}