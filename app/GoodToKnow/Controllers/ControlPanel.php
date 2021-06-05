<?php

namespace GoodToKnow\Controllers;

class ControlPanel
{
    function page()
    {
        global $gtk;
        global $show_poof;


        if (!$gtk->is_logged_in or $gtk->is_admin) {

            breakout(' Hey, either your session timed out or you are an admin and do not belong here in this CP. ');

        }


        $gtk->html_title = 'Control Panel';


        $gtk->page = 'CP';


        $show_poof = true;


        $gtk->message .= " Welcome to your Control Panel. ";


        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}