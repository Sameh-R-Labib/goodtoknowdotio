<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class QuickPostDeleteDelete
{
    function page()
    {
        /**
         * This route will simply determine which post the admin chose to delete, stores the
         * post's info in the session, and presents a form asking the user if he is sure he
         * wants to delete the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_post_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $post_object = Post::find_by_id($db, $sessionMessage, $chosen_post_id);

        if (!$post_object) {

            breakout(' EditMyPostEditor says: Error 011299. ');

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