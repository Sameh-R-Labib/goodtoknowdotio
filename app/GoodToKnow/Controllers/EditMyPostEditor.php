<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_prep;

class EditMyPostEditor
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers();


        get_db();


        require_once CONTROLLERHELPERS . DIRSEP . 'post_object_for_owner_prep.php';

        post_object_for_owner_prep('choice');


        /**
         * We may need the post id too!
         * Function post_object_for_owner_prep will have saved that to $_SESSION['saved_int02'].
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