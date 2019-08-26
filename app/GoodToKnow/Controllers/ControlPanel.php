<?php

namespace GoodToKnow\Controllers;

class ControlPanel
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;

        if (!$is_logged_in OR $is_admin) {
            breakout('');
        }

        $html_title = 'Control Panel';

        $page = 'CP';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Control Panel. ";

        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}