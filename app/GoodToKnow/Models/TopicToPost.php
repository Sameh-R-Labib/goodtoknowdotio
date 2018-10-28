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
    public static function get_posts_array_for_a_topic(\mysqli $db, string &$error, int $topic_id)
    {
        /**
         * Note: I've modified this method to return
         * the array of posts ordered by their sequential number
         *
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
        $x = null;
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
                    while ($x = $result->fetch_object('\GoodToKnow\Models\TopicToPost')) {
                        $array_of_TopicToPost[] = $x;
                        $count += 1;
                    }
                    $stmt->close();
                    $result->close();
                }
            }
        } catch (\Exception $e) {
            $error .= ' TopicToPost::get_posts_array_for_a_topic() caught a thrown exception: ' .
                htmlentities($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';
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

        self::order_posts_by_sequence_number($array_of_Posts);

        return $array_of_Posts;
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $topic_id
     * @return array|bool
     */
    public static function special_get_posts_array_for_a_topic(\mysqli $db, string &$error, int $topic_id)
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

    /**
     * @param \mysqli $db
     * @param string $error
     * @param int $user_id
     * @param int $topic_id
     * @return array|bool
     */
    public static function special_posts_array_for_user_and_topic(\mysqli $db, string &$error, int $user_id, int $topic_id)
    {
        $posts_array = TopicToPost::get_posts_array_for_a_topic($db, $error, $topic_id);
        if (empty($posts_array) || $posts_array === false) {
            return false;
        }

        $special_posts_array = [];
        foreach ($posts_array as $item) {
            if ($item->user_id == $user_id) $special_posts_array[$item->id] = $item->title;
        }

        return $special_posts_array;
    }

    /**
     * @param array $post_objects
     */
    public static function order_posts_by_sequence_number(array &$post_objects)
    {
        /**
         * Here's how we're going to do this.
         * We're going to build a new array called $sorted
         * We are going to keep iterating over the $original array until it becomes empty.
         * During each iteration we are going to take away the element with the lowest sequence
         * number and put it at the end of $sorted. Finally we assign $post_objects the
         * value of $sorted.
         *
         * Note: It is possible for two posts to have the same sequence number.
         *
         * Note: This function will kill your script if $post_objects is an empty array.
         */

        if (empty($post_objects)) {
            $_SESSION['message'] = " TopicToPost::order_posts_by_sequence_number says: Do not pass Go. Do not collect 200 dollars. ";
            redirect_to("/ax1/Home/page");
        }

        $sorted = [];

        $count = count($post_objects);

        $temp = $post_objects;

        while ($count > 0) {
            $sorted[] = self::post_having_lowest_sequence_number($temp);
            $count -= 1;
        }

        $post_objects = $sorted;
    }

    /**
     * @param array $temp
     * @return mixed
     */
    public static function post_having_lowest_sequence_number(array &$temp)
    {
        /**
         * This function removes and returns the post which has the
         * lowest sequence number.
         */
        if (empty($temp)) {
            $_SESSION['message'] = " TopicToPost::post_having_lowest_sequence_number says: Do not pass Go. Do not collect 200 dollars. ";
            redirect_to("/ax1/Home/page");
        }

        $key_of_lowest = -1;
        $lowest_sequence_number = 1000001;

        foreach ($temp as $key => $object) {
            if ($object->sequence_number <= $lowest_sequence_number) {
                $key_of_lowest = $key;
                $lowest_sequence_number = $object->sequence_number;
            }
        }

        if ($key_of_lowest == -1) {
            $_SESSION['message'] = " TopicToPost::post_having_lowest_sequence_number says: Error 624312. ";
            redirect_to("/ax1/Home/page");
        }

        /**
         * At this point $key_of_lowest has the key of the element
         * we want to remove and return.
         */
        $post_with_lowest_sequence_number = $temp[$key_of_lowest];

        unset($temp[$key_of_lowest]);

        return $post_with_lowest_sequence_number;
    }
}