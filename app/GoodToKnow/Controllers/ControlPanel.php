<?php

namespace GoodToKnow\Controllers;

class ControlPanel
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $app_state;
        global $html_title;
        global $page;
        global $show_poof;


        if (!$is_logged_in or $is_admin) {

            breakout(' Hey, either your session timed out or you are an admin and do not belong here in this CP. ');

        }


        $html_title = 'Control Panel';


        $page = 'CP';


        $show_poof = true;


        $app_state->message .= " Welcome to your Control Panel. ";


        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}