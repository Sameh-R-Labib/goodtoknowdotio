<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;

class EditPostTitleDirect
{
    function page()
    {
        /**
         * The main goal in this route is to present view editposttitleeditor.php.
         * But before we do that we must:
         *   - Store the Post id in $_SESSION['saved_int02'].
         *   - Acquire $g->post_object.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Sanity check.
         */

        if ($g->type_of_resource_requested != 'post') {

            breakout(' Error: The type of resource MUST be post. ');

        }


        get_db();


        /**
         * Store the Post id in $_SESSION['saved_int02'].
         */

        $_SESSION['saved_int02'] = $g->post_id;


        /**
         * Acquire $g->post_object.
         */
        $g->post_object = Post::find_by_id($g->post_id);

        if (!$g->post_object) {

            breakout(' Error 013999. ');

        }

        if ($g->post_object->user_id != $g->user_id) {

            breakout(' You can\'t edit or delete this post. ');

        }


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Edit Title of Post';

        require VIEWS . DIRSEP . 'editposttitleeditor.php';

    }
}