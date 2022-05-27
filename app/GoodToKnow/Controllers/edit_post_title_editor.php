<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\post_object_for_owner_get_based_on_parameter;

class edit_post_title_editor
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
         * Display the editor interface.
         */

        $g->html_title = 'Edit Title of Post';

        require VIEWS . DIRSEP . 'editposttitleeditor.php';

    }
    
}