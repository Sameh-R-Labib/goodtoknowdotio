<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_prep;

class AuthorDeletesOwnPostDelete
{
    function page()
    {
        /**
         * This route will simply determine which post the user chose to delete, make sure the post belongs to the user,
         * stores the post's info in the session, and present a form asking the user if he is sure he wants to delete the post.
         */


        global $db;
        global $user_id;
        global $html_title;
        global $long_title_of_post;


        kick_out_loggedoutusers();


        $db = get_db();


        require_once CONTROLLERHELPERS . DIRSEP . 'post_object_for_owner_prep.php';

        $post_object = post_object_for_owner_prep('choice', $db, $user_id);


        /**
         * We may need the post id too!
         * Function post_object_for_owner_prep will have saved that to $_SESSION['saved_int02'].
         */


        /**
         * We will need the file names for the post later so let's save them in the session. (markdown_file, html_file)
         */

        $_SESSION['saved_str01'] = $post_object->markdown_file;

        $_SESSION['saved_str02'] = $post_object->html_file;


        // We need this in the view.

        $long_title_of_post = $post_object->title . " | " . $post_object->extensionfortitle;


        /**
         * Display a form which asks for confirmation.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'authordeletesownpostdelete.php';
    }
}