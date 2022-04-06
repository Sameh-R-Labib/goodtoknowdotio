<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\post;

class edit_my_post_direct
{
    function page()
    {

        /**
         * This method is similar to edit_my_post_editor::page().
         *
         * The only two differences are:
         * - The id of the post comes from $g->post_id instead of from the submitted form.
         * - $g->type_of_resource_requested must be 'post'.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        if ($g->type_of_resource_requested != 'post') {

            breakout(' Error: The type of resource MUST be post. ');

        }


        get_db();


        /**
         * We know $g->post_id is the id of the post the user wants to edit.
         * But, must make sure that post belongs to the user because we
         * do not allow a user to edit someone else's post.
         */


        // Get the post's object

        $g->post_object = post::find_by_id($g->post_id);

        if (!$g->post_object) {

            breakout(' Error 016299. ');

        }


        // Make sure the user of the post is the current user

        if ($g->post_object->user_id != $g->user_id) {

            breakout(' You can\'t edit or delete this post. ');

        }


        /**
         * At this point:
         * - We know the user is allowed to edit the post.
         * - We have the post object ($g->post_object).
         *
         * Since the subsequent routes are counting on it, we will store
         * the id of the post in the session.
         */

        $_SESSION['saved_int02'] = (int)$g->post_id;

        // Let's do the same for the topic
        $_SESSION['saved_int01'] = (int)$g->topic_id;


        /**
         * We will need the file names for the post later so let's save them in the session.
         * (markdown_file, html_file)
         */

        $_SESSION['saved_str01'] = $g->post_object->markdown_file;
        $_SESSION['saved_str02'] = $g->post_object->html_file;


        /**
         * Retrieve the markdown for $g->post_object from the file system.
         */

        $g->markdown = file_get_contents($g->post_object->markdown_file);

        if ($g->markdown === false) {

            breakout(' Unable to read source file. ');

        }


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Editor';

        require VIEWS . DIRSEP . 'editmyposteditor.php';
    }
}