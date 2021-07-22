<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Post;

class EditMyPostDirect
{
    function page()
    {

        /**
         * This method is similar to EditMyPostEditor::page().
         *
         * The only difference is that th id of the post comes from $g->post_id
         * instead of from the submitted form.
         */

        global $g;


        kick_out_loggedoutusers();


        get_db();


        /**
         * We know $g->post_id is the id of the post the user wants to edit.
         * But, must make sure that post belongs to the user because we
         * do not allow a user to edit someone else's post.
         */


        // Get the post's object

        $g->post_object = Post::find_by_id($g->post_id);

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
         * Since the subsequent routes are counting on it we will store
         * the id of the post in the session.
         */

        $_SESSION['saved_int02'] = $g->post_id;

        // Let's do the same for the topic
        $_SESSION['saved_int01'] = $g->topic_id;


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