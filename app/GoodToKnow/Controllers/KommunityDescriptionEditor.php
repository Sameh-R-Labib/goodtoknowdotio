<?php

namespace GoodToKnow\Controllers;

class KommunityDescriptionEditor
{
    function page()
    {
        global $gtk;


        kick_out_nonadmins();


        /**
         * Present a form which collects the community's name.
         */

        $gtk->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}