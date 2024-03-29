<?php

namespace GoodToKnow\Controllers;

class quick_post_delete_delete
{
    function page(int $id = 0)
    {
        /**
         * This route will simply determine which post Admin chose to delete, stores the
         * post's info in the session, and presents a form asking the user if he is sure he
         * wants to delete the post.
         */


        global $g;


        kick_out_nonadmins();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'admin_get_post.php';


        $_SESSION['saved_str01'] = $g->post_object->markdown_file;

        $_SESSION['saved_str02'] = $g->post_object->html_file;

        $_SESSION['saved_int02'] = $g->id;


        // We need this in the view.

        $g->long_title_of_post = $g->post_object->title . " | " . $g->post_object->extensionfortitle;


        $g->html_title = 'Are you sure?';


        require VIEWS . DIRSEP . 'quickpostdeletedelete.php';
    }
}