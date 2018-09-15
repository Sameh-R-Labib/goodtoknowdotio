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


    public static function get_topics_array_for_a_community(int $community_id)
    {
        /**
         * Code a static method which:
         * Gets an associative array where the key is the topic_id
         * and the value is the topic name. And this is an array
         * for all the topics which belong to a particular community.
         *
         * I'm using this static method in SetHomePageCommunityTopicPost.
         * But, it will be useful in other places. That is why I'm making it
         * broad in scope.
         */

        /**
         * First we need all the CommunityToTopic objects for $community_id
         */

        /**
         * Second we need to get all the Topic objects corresponding
         * to the topic ids found in the CommunityToTopic objects we
         * found in our first step.
         */

        /**
         * Third we will create and return the array we desire
         * as it is described in the introduction to this function.
         */
    }
}