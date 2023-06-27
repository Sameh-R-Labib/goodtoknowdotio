<?php

namespace GoodToKnow\Controllers;

class admin_home
{
    function page()
    {
        global $g;

        kick_out_nonadmins();

        $g->html_title = 'admin';

        $g->page = 'admin';

        $g->show_poof = true;

        $g->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}