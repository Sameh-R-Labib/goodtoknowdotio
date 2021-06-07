<?php

namespace GoodToKnow\Controllers;

class QuickPostDeleteDelete
{
    function page()
    {
        /**
         * This route will simply determine which post the admin chose to delete, stores the
         * post's info in the session, and presents a form asking the user if he is sure he
         * wants to delete the post.
         */


        global $g;
        global $post_object;
        global $chosen_post_id;


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_post.php';


        $_SESSION['saved_str01'] = $post_object->markdown_file;

        $_SESSION['saved_str02'] = $post_object->html_file;

        $_SESSION['saved_int02'] = $chosen_post_id;


        // We need this in the view.

        $g->long_title_of_post = $post_object->title . " | " . $post_object->extensionfortitle;


        $g->html_title = 'Are you sure?';


        require VIEWS . DIRSEP . 'quickpostdeletedelete.php';
    }
}