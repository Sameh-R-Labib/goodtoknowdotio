<?php

namespace GoodToKnow\Controllers;

class control_panel
{
    function page()
    {
        global $g;


        if (!$g->is_logged_in or $g->is_admin) {

            breakout(' Hey, either your session timed out or you are an admin and do not belong here in this CP. ');

        }


        $g->html_title = 'Control Panel';


        $g->page = 'CP';


        $g->show_poof = true;


        $g->message .= " Welcome to your Control Panel. ";


        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}