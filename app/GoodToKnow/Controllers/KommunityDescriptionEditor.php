<?php

namespace GoodToKnow\Controllers;

class KommunityDescriptionEditor
{
    function page()
    {
        global $sessionMessage;
        global $html_title;

        kick_out_nonadmins();


        /**
         * Present a form which collects
         * the community's name.
         */

        $html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}