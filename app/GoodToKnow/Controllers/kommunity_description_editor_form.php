<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\community;

class kommunity_description_editor_form
{
    function page()
    {
        global $g;
        // $g->saved_int01 community id
        // $g->saved_str01 is the community name. The view file will get it directly from global scope.


        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the community object for the community. I'm talking about the community
         *     whose description the admin wants to edit.
         *  2) Present a (pre-filled with current description) form for editing.
         */


        // 1) Retrieve the community object for the community whose description Admin wants to edit.

        get_db();

        $g->community_object = community::find_by_id($g->saved_int01);

        if (!$g->community_object) {

            breakout(' I was unexpectedly unable to retrieve target community\'s object. ');

        }


        // 2) Present a (pre-filled with current description) form for editing.

        $g->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditorform.php';
    }
}