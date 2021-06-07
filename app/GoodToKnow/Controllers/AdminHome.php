<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $g;

        kick_out_nonadmins();

        $g->html_title = 'Admin';

        $g->page = 'Admin';

        $g->show_poof = true;

        $g->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}