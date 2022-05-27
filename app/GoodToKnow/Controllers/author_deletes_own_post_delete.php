<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_get_based_on_parameter;

class author_deletes_own_post_delete
{
    function page(int $id = 0)
    {
        /**
         * This route will simply determine which post the user chose to delete, make sure the post belongs to the user,
         * stores the post's info in the session, and present a form asking the user if he is sure he wants to delete the post.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        /**
         * $g->post_object will be gotten when post_object_for_owner_get_based_on_parameter()
         * is called.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'post_object_for_owner_get_based_on_parameter.php';

        post_object_for_owner_get_based_on_parameter();


        /**
         * We may need the post id too!
         * Function post_object_for_owner_get_based_on_parameter will have saved that to $_SESSION['saved_int02'].
         */


        /**
         * We will need the file names for the post later so let's save them in the session. (markdown_file, html_file)
         */

        $_SESSION['saved_str01'] = $g->post_object->markdown_file;

        $_SESSION['saved_str02'] = $g->post_object->html_file;


        // We need this in the view.

        $g->long_title_of_post = $g->post_object->title . " | " . $g->post_object->extensionfortitle;


        /**
         * Display a form which asks for confirmation.
         */

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'authordeletesownpostdelete.php';
    }
}