<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 10/21/18
 * Time: 5:37 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;

class EditMyPostEditor
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $url_of_most_recent_upload;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $chosen_post_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;

        if ($chosen_post_id == 0) {
            $sessionMessage .= " You didn't enter a choice for the post you want to edit. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
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
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if ($post_object->user_id != $user_id) {
            $sessionMessage .= " You can't edit this post. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * We will need the file names for the
         * post later so let's save them in the session.
         * (markdown_file, html_file)
         */
        $_SESSION['saved_str01'] = $post_object->markdown_file;
        $_SESSION['saved_str02'] = $post_object->html_file;

        // We may need the post id too!
        $_SESSION['saved_int02'] = $chosen_post_id;

        /**
         * Placeholder for actually retrieving the
         * markdown for $post_object from the file system.
         *
         * Don't forget to verify we succeeded in retrieving the file.
         */
        $markdown = file_get_contents($post_object->markdown_file);
        if ($markdown === false) {
            $sessionMessage .= " Unable to read source file. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_int02'] = 0;
            $_SESSION['saved_str01'] = "";
            $_SESSION['saved_str02'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Display the editor interface.
         */
        $html_title = 'Editor';

        require VIEWS . DIRSEP . 'editmyposteditor.php';
    }
}