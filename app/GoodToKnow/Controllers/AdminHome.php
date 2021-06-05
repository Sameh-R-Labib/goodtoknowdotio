<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $app_state;
        global $show_poof;

        kick_out_nonadmins();

        $app_state->html_title = 'Admin';

        $app_state->page = 'Admin';

        $show_poof = true;

        $app_state->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}