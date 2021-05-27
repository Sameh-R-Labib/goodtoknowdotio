<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class KommunityDescriptionEditorForm
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $saved_int01; // community id
        global $html_title;
        global $community_object;


        // $saved_str01 is the community name. The view file will get it directly from global scope.


        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the Community object for the community whose description the admin wants to edit.
         *  2) Present a (pre-filled with current description) form for editing.
         */


        // 1) Retrieve the Community object for the community whose description the admin wants to edit.

        $db = get_db();

        $community_object = Community::find_by_id($saved_int01);

        if (!$community_object) {

            breakout(' I was unexpectedly unable to retrieve target community\'s object. ');

        }


        // 2) Present a (pre-filled with current description) form for editing.

        $html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditorform.php';
    }
}