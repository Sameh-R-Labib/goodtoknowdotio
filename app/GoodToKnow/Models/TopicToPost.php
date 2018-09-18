<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/16/18
 * Time: 4:42 PM
 */

namespace GoodToKnow\Models;


class TopicToPost extends GoodObject
{
    /**
     * @var string
     */
    protected static $table_name = "topic_to_post";

    /**
     * @var array
     */
    protected static $fields = ['id', 'topic_id', 'post_id'];

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $topic_id;

    /**
     * @var int
     */
    public $post_id;


    /**
     * @param \mysqli $db
     * @param string $error
     * @param $topic_id
     * @return array|bool
     */
    public static function get_posts_array_for_a_topic(\mysqli $db, string &$error, $topic_id)
    {
        /**
         * This time the array will be an array of objects
         *
         * What I'm getting is an array of Post objects.
         * The objects I'm getting are the ones which belong
         * to a particular topic.
         *
         * First I will get (in array) all the TopicToPost objects with
         * a particular $topic_id.
         *
         * Then I will get (in array) all the posts listed in the first array.
         */


        // get (in array) all the TopicToPost objects with a particular $topic_id.
        $array_of_TopicToPost = [];
        $count = 0;
        $sql = 'SELECT *
                FROM `topic_to_post`
                WHERE `topic_id` = ?';
        try {
            $stmt = $db->stmt_init();
            if (!$stmt->prepare($sql)) {
                $error .= ' ' . $stmt->error . ' ';
                return false;
            } else {
                $stmt->bind_param('i', $topic_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $numrows = $result->num_rows;
                if (!$numrows) {
                    $stmt->close();
                    return false;
                } else {
                    while ($array_of_TopicToPost[] = $result->fetch_object('\GoodToKnow\Models\TopicToPost')) {
                        $count += 1;
                    }
                    $stmt->close();
                    $result->close();
                }
            }
        } catch (\Exception $e) {
            $error .= ' TopicToPost::get_posts_array_for_a_topic() caught a thrown exception: ' .
                htmlentities($e->getMessage(), ENT_QUOTES | ENT_HTML5) . ' ';
        }
        if (!empty($error)) {
            return false;
        }
        if ($count < 1) {
            $error .= ' TopicToPost::get_posts_array_for_a_topic() says: Errno 15. ';
            return false;
        }

        /**
         * get (in array) all the posts listed in $array_of_TopicToPost.
         */
        $array_of_Posts = [];
        foreach ($array_of_TopicToPost as $item) {
            $array_of_Posts[] = Post::find_by_id($db, $error, $item->post_id);
        }
        if (empty($array_of_Posts)) {
            $error .= ' TopicToPost::get_posts_array_for_a_topic() says: Errno 16. ';
            return false;
        }

        return $array_of_Posts;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $topic_id
     * @return array|bool
     */
    public static function special_get_posts_array_for_a_topic(\mysqli $db, string &$error, $topic_id)
    {
        /**
         * This function is like (and uses) get_posts_array_for_a_topic
         * but it is different in that:
         *   the array structure it returns is different
         * Here is the array structure:
         *  - Each item key is a post id
         *  - Each item value is the post title for that post id
         */

        $posts_array = TopicToPost::get_posts_array_for_a_topic($db, $error, $topic_id);
        if (empty($posts_array) || $posts_array === false) {
            return false;
        }

        $special_posts_array = [];
        foreach ($posts_array as $item) {
            $special_posts_array[$item->id] = $item->title;
        }

        return $special_posts_array;
    }
}