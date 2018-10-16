<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/4/18
 * Time: 10:35 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;

class CreateNewPostSave
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $user_id;
        global $topic_id;
        global $saved_str01;                // The main title
        global $saved_str02;                // The title extension
        global $saved_int01;                // The topic id
        global $saved_int02;                // The sequence number

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Overview
         *   Mainly we are here to store the new
         * Post and its TopicToPost record. Then
         * redirect to Home page with a confirmation
         * message.
         *
         * So far we have:
         *   - $user_id     (user_id)
         *   - $saved_str01 (title)
         *   - $saved_str02 (extesionfortitle)
         *   - $saved_int01 (topic id)
         *   - $saved_int02 (sequence_number)
         *
         * Attributes we need to find values for:
         *   o $created
         *   o $markdown_file (just the file name)
         *   o $html_file (just the file name)
         *
         * Note: Before we save we will (again) verify
         * that nobody has inserted a post in
         * our topic which has the sequence number.
         */

        $created = time();
        $markdown_file = "KjeuJHnedoOpPKidErYuUjHeWdWQrfcS.md";
        $html_file = "KjeuJHnedoOpPKidErYuUjHeWdWQrfcS.html";

        // Assemble the Post object
        $post_as_array = ['sequence_number' => $saved_int02, 'title' => $saved_str01, 'extensionfortitle' => $saved_str02,
            'user_id' => $user_id, 'created' => $created, 'markdown_file' => $markdown_file, 'html_file' => $html_file];
        $post = Post::array_to_object($post_as_array);

        // Verify that our sequence number hasn't been taken.
        /**
         * Get all the posts in out topic.
         */
        $result = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);
        $sequence_number_already_exists_in_db = false;
        if ($result != false) {
            foreach ($result as $object) {
                if ($object->sequence_number == $saved_int02) {
                    $sequence_number_already_exists_in_db = true;
                    break;
                }
            }
        }

        if ($sequence_number_already_exists_in_db) {
            $sessionMessage .= " Unfortunately someone was putting a post in the same spot while you were
            trying to do the same and they beat you to the punch. Please start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Save the new Post
        $result = $post->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " CreateNewPostSave::page says: Unexpected save was unable to save the new post. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Assemble the TopicToPost object
        $topictopost_as_array = ['topic_id' => $saved_int01, 'post_id' => $post->id];
        $topictopost = TopicToPost::array_to_object($topictopost_as_array);

        // Save the new TopicToPost
        $result = $topictopost->save($db, $sessionMessage);
        if (!$result) {
            $sessionMessage .= " CreateNewPostSave::page says: Unexpected save was unable to save the TopicToPost. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Refresh special_post_array
         */
        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $topic_id);
        $_SESSION['special_post_array'] = $special_post_array;
        $_SESSION['last_refresh_posts'] = time();

        // Redirect
        $sessionMessage .= " Congratulations! Your new post has been created. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}