<?php

namespace GoodToKnow\Controllers;

class KommunityDescriptionEditor
{
    function page()
    {
        global $app_state;


        kick_out_nonadmins();


        /**
         * Present a form which collects the community's name.
         */

        $app_state->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}