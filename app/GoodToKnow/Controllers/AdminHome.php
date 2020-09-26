<?php

namespace GoodToKnow\Controllers;

class AdminHome
{
    function page()
    {
        global $is_admin;
        global $is_guest;
        global $show_poof;
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;

        kick_out_nonadmins();

        $html_title = 'Admin';

        $page = 'Admin';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}