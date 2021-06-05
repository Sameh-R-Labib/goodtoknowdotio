<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $app_state;
        global $show_poof;
        global $html_title;

        kick_out_nonadmins();

        $html_title = 'Admin';

        $app_state->page = 'Admin';

        $show_poof = true;

        $app_state->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}