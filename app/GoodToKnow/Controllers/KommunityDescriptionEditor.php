<?php

namespace GoodToKnow\Controllers;

class KommunityDescriptionEditor
{
    function page()
    {
        global $g;


        kick_out_nonadmins();


        /**
         * Present a form which collects the community's name.
         */

        $g->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}