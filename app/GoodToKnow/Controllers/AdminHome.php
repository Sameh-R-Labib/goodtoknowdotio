<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $gtk;

        kick_out_nonadmins();

        $gtk->html_title = 'Admin';

        $gtk->page = 'Admin';

        $gtk->show_poof = true;

        $gtk->message .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}