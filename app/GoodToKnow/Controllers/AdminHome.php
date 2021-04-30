<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $page;
        global $show_poof;
        global $sessionMessage;
        global $html_title;

        kick_out_nonadmins();

        $html_title = 'Admin';

        $page = 'Admin';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}