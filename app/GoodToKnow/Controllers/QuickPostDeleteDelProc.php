<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;


class QuickPostDeleteDelProc
{
    function page()
    {
        /**
         * Here we will read the choice of whether
         * or not to delete the post. If yes then
         * delete the post record, delete its
         * TopicToPost record, and delete its
         * html and markdown files. On the other
         * hand if no then reset some session variables
         * and redirect to the home page.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int02;
        global $saved_int01;
        global $saved_str01;
        global $saved_str02;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            $sessionMessage .= " You didn't enter a choice. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if ($choice == "no") {
            $sessionMessage .= " You've changed your mind about deleting the post. So, none was deleted. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Delete the db record for the post.
        $post = Post::find_by_id($db, $sessionMessage, $saved_int02);

        if (!$post) {
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Could not find post by id. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $result = $post->delete($db, $sessionMessage);

        if (!$result) {
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Unexpectedly could not delete post. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Delete the TopicToPost record
        $sql = 'SELECT * FROM `topic_to_post`
        WHERE `topic_id` = "' . $db->real_escape_string($saved_int01) . '" AND `post_id` = "' .
            $db->real_escape_string($saved_int02) . '" LIMIT 1';

        $array_of_objects = TopicToPost::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' AuthorDeletesOwnPostDelProc::page says: Unexpectedly failed to get a TopicToPost object to delete. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $topictopost_object = array_shift($array_of_objects);

        if (!is_object($topictopost_object)) {
            $sessionMessage .= ' AuthorDeletesOwnPostDelProc::page says: Unexpectedly return value is not an object. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $result = $topictopost_object->delete($db, $sessionMessage);

        if (!$result) {
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Unexpectedly could not delete the TopicToPost object. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Delete both its files;
        $result = unlink($saved_str01);

        if (!$result) {
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Unexpectedly failed to delete markdown file for the post. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $result = unlink($saved_str02);

        if (!$result) {
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Unexpectedly failed to delete html file for the post. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Report successful deletion of post.
        $sessionMessage .= " I have deleted the post. ";
        $_SESSION['message'] = $sessionMessage;
        reset_feature_session_vars();
        redirect_to("/ax1/Home/page");
    }
}