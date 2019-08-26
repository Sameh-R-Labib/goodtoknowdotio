<?php

namespace GoodToKnow\Controllers;

class KommunityDescriptionEditor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Present a form which collects
         * the community's name.
         */

        $html_title = "Community's Description Editor";

        require VIEWS . DIRSEP . 'kommunitydescriptioneditor.php';
    }
}