<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class KommunityDescriptionEditorForm
{
    function page()
    {
        global $app_state;
        global $db;
        // $app_state->saved_int01 community id
        global $community_object;


        // $app_state->saved_str01 is the community name. The view file will get it directly from global scope.


        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the Community object for the community whose description the admin wants to edit.
         *  2) Present a (pre-filled with current description) form for editing.
         */


        // 1) Retrieve the Community object for the community whose description the admin wants to edit.

        $db = get_db();

        $community_object = Community::find_by_id($app_state->saved_int01);

        if (!$community_object) {

            breakout(' I was unexpectedly unable to retrieve target community\'s object. ');

        }


        // 2) Present a (pre-filled with current description) form for editing.

        $app_state->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditorform.php';
    }
}