<?php

namespace GoodToKnow\Controllers;

class ControlPanel
{
    function page()
    {
        global $app_state;
        global $show_poof;


        if (!$app_state->is_logged_in or $app_state->is_admin) {

            breakout(' Hey, either your session timed out or you are an admin and do not belong here in this CP. ');

        }


        $app_state->html_title = 'Control Panel';


        $app_state->page = 'CP';


        $show_poof = true;


        $app_state->message .= " Welcome to your Control Panel. ";


        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}