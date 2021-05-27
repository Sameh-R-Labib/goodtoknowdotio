<?php

namespace GoodToKnow\Models;

use mysqli;
use function GoodToKnow\ControllerHelpers\order_by_sequence_number;

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
     * @param mysqli $db
     * @param int $post_id
     * @return string|bool
     */
    public static function derive_topic_id(mysqli $db, int $post_id)
    {
        global $sessionMessage;

        $sql = 'SELECT * FROM `topic_to_post`
        WHERE `post_id` = "' . $db->real_escape_string($post_id) . '" LIMIT 1';

        $array_of_objects = TopicToPost::find_by_sql($db, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {

            $sessionMessage .= ' derive_topic_id says: Failed to get a TopicToPost object. ';
            return false;

        }

        $topictopost_object = array_shift($array_of_objects);

        if (!is_object($topictopost_object)) {

            $sessionMessage .= ' derive_topic_id says: Unexpectedly return value is not an object. ';
            return false;

        }

        return $topictopost_object->topic_id;
    }


    /**
     * @param mysqli $db
     * @param int $topic_id
     * @return array|bool
     */
    public static function get_posts_array_for_a_topic(mysqli $db, int $topic_id)
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


        global $sessionMessage;


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

                $sessionMessage .= ' ' . $stmt->error . ' ';

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

            $sessionMessage .= ' TopicToPost::get_posts_array_for_a_topic() caught a thrown exception: ' .
                htmlspecialchars($e->getMessage(), ENT_NOQUOTES | ENT_HTML5) . ' ';

            return false;

        }

        if ($count < 1) {

            $sessionMessage .= ' TopicToPost::get_posts_array_for_a_topic() says: Errno 15. ';

            return false;

        }


        /**
         * get (in array) all the posts listed in $array_of_TopicToPost.
         */

        $array_of_Posts = [];

        foreach ($array_of_TopicToPost as $item) {

            $array_of_Posts[] = Post::find_by_id($item->post_id);

        }

        if (empty($array_of_Posts)) {

            $sessionMessage .= ' TopicToPost::get_posts_array_for_a_topic() says: Errno 16. ';

            return false;

        }

        require_once CONTROLLERHELPERS . DIRSEP . 'order_by_sequence_number.php';

        order_by_sequence_number($array_of_Posts);

        return $array_of_Posts;
    }


    /**
     * @param mysqli $db
     * @param array $array_of_post_objects
     * @return array|bool
     */
    public static function get_author_usernames(mysqli $db, array $array_of_post_objects)
    {
        /**
         * Generate an array of author usernames.
         * Each array element's value is a username which
         * is the username corresponding to the user_id
         * of the corresponding element in the
         * $array_of_post_objects.
         */

        global $sessionMessage;

        $author_usernames_array = [];

        foreach ($array_of_post_objects as $key => $array_of_post_object) {

            $author_user_object = User::find_by_id($array_of_post_object->user_id);

            if (!$author_user_object) {

                $sessionMessage .= " TopicToPost::get_author_usernames() says: find_by_id failed to find the user object. ";

                return false;

            }

            $author_usernames_array[$key] = $author_user_object->username;

        }

        if (empty($author_usernames_array)) return false;

        return $author_usernames_array;
    }


    /**
     * @param mysqli $db
     * @param int $topic_id
     * @return array|bool
     */
    public static function special_get_posts_array_for_a_topic(mysqli $db, int $topic_id)
    {
        /**
         * This function is like (and uses) get_posts_array_for_a_topic
         * but it is different in that:
         *   the array structure it returns is different
         * Here is the array structure:
         *  - Each item key is a post id
         *  - Each item value is the post title for that post id
         */

        $posts_array = TopicToPost::get_posts_array_for_a_topic($db, $topic_id);

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
     * @param mysqli $db
     * @param int $user_id
     * @param int $topic_id
     * @return array|bool
     */
    public static function special_posts_array_for_user_and_topic(mysqli $db, int $user_id, int $topic_id)
    {
        $posts_array = TopicToPost::get_posts_array_for_a_topic($db, $topic_id);

        if (empty($posts_array) || $posts_array === false) {

            return false;

        }

        $special_posts_array = [];

        foreach ($posts_array as $item) {

            if ($item->user_id == $user_id) $special_posts_array[$item->id] = $item->title;

        }

        return $special_posts_array;
    }
}