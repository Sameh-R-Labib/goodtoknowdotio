<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $gtk;
        global $show_poof;

        kick_out_nonadmins();

        $gtk->html_title = 'Admin';

        $gtk->page = 'Admin';

        $show_poof = true;

        $gtk->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}