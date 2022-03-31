<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_prep;

class edit_post_title_editor
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require_once CONTROLLERHELPERS . DIRSEP . 'post_object_for_owner_prep.php';

        post_object_for_owner_prep('choice');


        /**
         * We may need the post id too!
         * Function post_object_for_owner_prep will have saved that to $_SESSION['saved_int02'].
         */


        /**
         * Display the editor interface.
         */

        $g->html_title = 'Edit Title of Post';

        require VIEWS . DIRSEP . 'editposttitleeditor.php';

    }
    
}