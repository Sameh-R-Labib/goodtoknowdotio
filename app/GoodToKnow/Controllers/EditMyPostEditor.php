<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class EditMyPostEditor
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $user_id;
        global $url_of_most_recent_upload;

        kick_out_loggedoutusers();

        kick_out_onabort();

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
            breakout(' You can\'t edit this post. ');
        }


        /**
         * We will need the file names for the post later so let's save them in the session.
         * (markdown_file, html_file)
         */

        $_SESSION['saved_str01'] = $post_object->markdown_file;
        $_SESSION['saved_str02'] = $post_object->html_file;


        // We may need the post id too!

        $_SESSION['saved_int02'] = $chosen_post_id;


        /**
         * Placeholder for actually retrieving the markdown for $post_object from the file system.
         *
         * Don't forget to verify we succeeded in retrieving the file.
         */

        $markdown = file_get_contents($post_object->markdown_file);

        if ($markdown === false) {
            breakout(' Unable to read source file. ');
        }


        /**
         * Display the editor interface.
         */

        $html_title = 'Editor';

        require VIEWS . DIRSEP . 'editmyposteditor.php';
    }
}