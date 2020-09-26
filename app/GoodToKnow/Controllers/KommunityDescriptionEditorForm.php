<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Community;

class KommunityDescriptionEditorForm
{
    function page()
    {
        global $sessionMessage;
        global $saved_str01; // community name
        global $saved_int01; // community id
        global $html_title;

        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the Community object for the community whose description the admin wants to edit.
         *  2) Present a (pre-filled with current description) form for editing.
         */

        $db = get_db();


        // 1) Retrieve the Community object for the community whose description the admin wants to edit.

        $community_object = Community::find_by_id($db, $sessionMessage, $saved_int01);

        if (!$community_object) {
            breakout(' I was unexpectedly unable to retrieve target community\'s object. ');
        }


        // 2) Present a (pre-filled with current description) form for editing.

        $html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditorform.php';
    }
}