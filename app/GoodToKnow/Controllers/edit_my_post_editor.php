<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_get_based_on_parameter;

class edit_my_post_editor
{
    function page(int $id = 0)
    {
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