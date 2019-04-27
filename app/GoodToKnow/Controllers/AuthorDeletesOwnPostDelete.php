<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;


class AuthorDeletesOwnPostDelete
{
    public function page()
    {
        /**
         * This route will simply determine
         * which post the user chose to delete,
         * make sure the post belongs to the user,
         * stores the post's info in the session, and
         * present a form asking the user if he
         * is sure he wants to delete the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $chosen_post_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;

        if ($chosen_post_id == 0) {
            $sessionMessage .= " You didn't enter a choice for the post you want to edit. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the chosen post is one
         * which this user is allowed to edit.
         *
         * To accomplish this we need to get
         * the Post object.
         */
        $post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

        if (!$post_object) {
            $sessionMessage .= " EditMyPostEditor::page says: Error 011299. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if ($post_object->user_id != $user_id) {
            $sessionMessage .= " You can't edit this post. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}