<?php

namespace GoodToKnow\Controllers;

class kommunity_description_editor
{
    function page()
    {
        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Present a form which collects the community's name.
         */

        $g->html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}