<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class QuickPostDeleteDelete
{
    function page()
    {
        /**
         * This route will simply determine
         * which post the admin chose to delete,
         * stores the post's info in the session, and
         * presents a form asking the user if he
         * is sure he wants to delete the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
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

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_post_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

        if (!$post_object) {
            $sessionMessage .= " EditMyPostEditor::page says: Error 011299. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $post_object->markdown_file;
        $_SESSION['saved_str02'] = $post_object->html_file;
        $_SESSION['saved_int02'] = $chosen_post_id;

        // We need this in the view.
        $long_title_of_post = $post_object->title . " | " . $post_object->extensionfortitle;

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'quickpostdeletedelete.php';
    }
}