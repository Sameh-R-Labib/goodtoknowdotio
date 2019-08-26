<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class AuthorDeletesOwnPostDelete
{
    function page()
    {
        /**
         * This route will simply determine which post the user chose to delete, make sure the post belongs to the user,
         * stores the post's info in the session, and present a form asking the user if he is sure he wants to delete the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        $db = get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        if (is_null($chosen_post_id)) {
            breakout(' Your choice did not pass validation. ');
        }


        /**
         * Make sure the chosen post is one which this user is allowed to edit.
         *
         * To accomplish this we need to get the Post object.
         */

        $post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

        if (!$post_object) {
            breakout(' EditMyPostEditor says: Error 011299. ');
        }

        if ($post_object->user_id != $user_id) {
            breakout(' You can\'t delete this post. ');
        }


        /**
         * We will need the file names for the post later so let's save them in the session. (markdown_file, html_file)
         */

        $_SESSION['saved_str01'] = $post_object->markdown_file;

        $_SESSION['saved_str02'] = $post_object->html_file;

        // Other info about the post.

        $_SESSION['saved_int02'] = $chosen_post_id;

        // We need this in the view.

        $long_title_of_post = $post_object->title . " | " . $post_object->extensionfortitle;


        /**
         * Display a form which asks for confirmation.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'authordeletesownpostdelete.php';
    }
}