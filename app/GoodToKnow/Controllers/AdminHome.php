<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $g;

        kick_out_nonadmins_or_if_there_is_error_msg();

        $g->html_title = 'Admin';

        $g->page = 'Admin';

        $g->show_poof = true;

        $g->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}