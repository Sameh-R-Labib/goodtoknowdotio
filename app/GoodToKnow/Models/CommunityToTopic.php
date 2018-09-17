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
     * @param $community_id
     * @return array|bool
     */
    public static function get_topics_array_for_a_community(\mysqli $db, string &$error, $community_id)
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