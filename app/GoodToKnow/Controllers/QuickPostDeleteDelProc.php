<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use GoodToKnow\Models\TopicToPost;


class QuickPostDeleteDelProc
{
    public function page()
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
            redirect_to("/ax1/Home/page");
        }

        $choice = (isset($_POST['choice'])) ? $_POST['choice'] : "";

        if ($choice != "yes" && $choice != "no") {
            $sessionMessage .= " You didn't enter a choice. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($choice == "no") {
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $sessionMessage .= " You changed your mind about deleting the post. So, none was deleted. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Delete the db record for the post.
        $post = Post::find_by_id($db, $sessionMessage, $saved_int02);
        if (!$post) {
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Could not find post by id. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $result = $post->delete($db, $sessionMessage);
        if (!$result) {
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $sessionMessage .= " AuthorDeletesOwnPostDelProc::page says: Unexpectedly could not delete post. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}